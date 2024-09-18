<?php

include 'connection.php';

?>

<?php
    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "DELETE FROM todos WHERE id = $id";
        $result = $conn->query($sql);

        if(!$result) {
            die("Error: " . $sql . "<br>" . $conn->error);
        }else{
            header("Location: mainpage.php?delete_msg=You have successfully deleted a task.");
            exit;
        }
    }
?>