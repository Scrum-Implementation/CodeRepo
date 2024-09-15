<?php

include 'connection.php';

$sql = "SELECT * FROM todos";
$result = $conn->query($sql);

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
        <td>" . $row["name"] . "<br>" . $row["description"] ."</td>
        <td>" . $row["due_date"] . "<br>" . $end_time . "</td>
        <td>" . $row["status"] . "</td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='5'>No results found</td></tr>";
}
echo "</table>";

$conn->close();
?>
