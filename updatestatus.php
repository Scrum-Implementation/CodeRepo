<?php

include 'connection.php';

?>

<?php
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        
        echo $id . "<br>";

        $check = $_GET['status'];

        if ($check == 'Completed') {
            $status = "Completed";
        } elseif ($check == 'In Progress') {
            $status = "In Progress";
        }else{
            $status = "Pending";
        } 


        echo $status . "<br>";

        $sql = "UPDATE todos SET status='$status' WHERE id=$id";
        $result = $conn->query($sql);

        if(!$result) {
            die("Error: " . $sql . "<br>" . $conn->error);
        }else{
            header("Location: mainpage.php?update_msg=You have successfully updated a task.");
            exit;
        }
    }
?>  