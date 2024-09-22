<?php

include 'connection.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$sql = "SELECT * FROM todos";
$result = $conn->query($sql);

$edit_img = 'https://cdn-icons-png.flaticon.com/512/84/84380.png';
$delete_img ='https://icons.veryicon.com/png/o/construction-tools/coca-design/delete-189.png';

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {

        $end_time = date("H:i", strtotime($row["end_time"]));
        $due_date_and_time = new DateTime($row["due_date"] . " " . $end_time, new DateTimeZone('Asia/Manila'));
        $today = new DateTime('now', new DateTimeZone('Asia/Manila'));

        if ($due_date_and_time > $today) {
            $status = "In Progress";
        } else {
            $status = "Completed";
        }

        $sql = "UPDATE todos SET status='$status' WHERE id=".$row["id"];
        $conn->query($sql);
           
        echo "<tr>
        <td><a href='editdata.php? id=" . $row["id"] . "' class='edit-button'>
            <img src='". $edit_img ."'>
            </a>
            <strong class='stronk'>" . $row["name"] . "</strong><br>

            <a href='editdata.php? id=" . $row["id"] . "' class='delete-button'>
            <img src='". $delete_img ."'>
            </a>

            <i>" . $row["description"] . "</i><br></td>
        <td><strong>" . $row["due_date"] . "</strong><br><i>" . $end_time . "</i></td>
        <td>" . $row["status"] . "</td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='5'>No results found</td></tr>";
}
echo "</table>";

$conn->close();
?>
