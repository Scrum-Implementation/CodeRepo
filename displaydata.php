<?php

include 'connection.php';

$sql = "SELECT * FROM todos";
$result = $conn->query($sql);

$edit_img = 'https://cdn-icons-png.flaticon.com/512/84/84380.png';
$delete_img = 'https://icons.veryicon.com/png/o/construction-tools/coca-design/delete-189.png';
$checkbox_checked_img = 'https://static-00.iconduck.com/assets.00/checkbox-icon-512x512-kv3qo5ui.png'; 
$checkbox_unchecked_img = 'https://cdn-icons-png.freepik.com/512/64/64571.png';

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $end_time = date("H:i", strtotime($row["end_time"]));
        $due_date_and_time = new DateTime($row["due_date"] . " " . $end_time, new DateTimeZone('Asia/Manila'));
        $today = new DateTime('now', new DateTimeZone('Asia/Manila'));

        if ($row["status"] == "Pending" && $due_date_and_time > $today) {
            $status = "In Progress";
            $sql = "UPDATE todos SET status='$status' WHERE id=".$row["id"];
            $conn->query($sql);
        }

        $check = $row["status"] === "Completed" ? "checked" : "";

        echo "<tr>
        <td>
            <a href='editdata.php?id=" . $row["id"] . "' class='edit-button'>
                <img src='". $edit_img ."'>
            </a>
            <strong class='stronk'>" . $row["name"] . "</strong><br>
            <a href='deletedata.php?id=" . $row["id"] . "' class='delete-button'>
                <img src='". $delete_img ."'>
            </a>
            <i>" . $row["description"] . "</i><br>
        </td>
        <td><strong>" . $row["due_date"] . "</strong><br><i>" . $end_time . "</i></td>
        <td>" . $row["status"] . "
            <label style='cursor:pointer;'>
                <input type='checkbox' id='task-box" . $row["id"] . "' value='1' data-id='" . $row["id"] . "' " . $check . " style='display:none;'>
                <img src='" . ($check ? $checkbox_checked_img : $checkbox_unchecked_img) . "' alt='checkbox' class='checkbox-img' data-checked-img='" . $checkbox_checked_img . "' data-unchecked-img='" . $checkbox_unchecked_img . "'>
            </label>
        </td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='5'>No results found</td></tr>";
}
echo "</table>";

$conn->close();
?>

<script>
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('click', function(event) {
            const imgElement = this.nextElementSibling;
            const result = checkbox.checked ? 
                confirm("Are you sure you want to mark this task as completed?") :
                confirm("Are you sure you want to mark this task as in progress?");
            
            if (result) {
                const id = this.getAttribute('data-id');
                const status = checkbox.checked ? 'Completed' : 'In Progress';

                imgElement.src = checkbox.checked ? 
                    this.getAttribute('data-checked-img') : 
                    this.getAttribute('data-unchecked-img');
                
                window.location.href = `updatestatus.php?id=${id}&status=${status}`;
            } else {
                checkbox.checked = false; 
                imgElement.src = this.checked ? 
                    this.getAttribute('data-checked-img') : 
                    this.getAttribute('data-unchecked-img');
            }
        });
    });
</script>

<script>
    const deleteButtons = document.querySelectorAll('.delete-button');
    
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();

            const result = confirm("Are you sure you want to delete this item?");
            
            if (result) {
                window.location.href = this.getAttribute('href');
            }
        });
    });
</script>
