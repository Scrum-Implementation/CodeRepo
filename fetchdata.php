<?php
include 'connection.php';

$sql = "SELECT * FROM todos";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>" . $row["name"] . "<br>" . $row["description"] ."</td>;
        <td>" . $row["due_date"] . "</td>
        <td>" . $row["status"] . "</td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='5'>No results found</td></tr>";
}
echo "</table>";

$conn->close();
?>
