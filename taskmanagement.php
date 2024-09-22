<?php

include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    var_dump($_POST);
    
    $title = $_POST['name'];
    $description = $_POST['description'];
    $due_date = isset($_POST['due_date']) ? $_POST['due_date']: '';
    $end_time = isset($_POST['end_time']) ? $_POST['end_time']: '';

    if (empty($title) || empty($description) || empty($due_date) || empty($end_time)) {
        $error_message = 'All fields are required.';
    } else {
        $sql = "INSERT INTO todos (name, description, due_date, end_time) 
                VALUES ('$title', '$description', '$due_date', '$end_time')";

        if ($conn->query($sql) === TRUE) {
            header("Location: mainpage.php");
            exit;
        } else {
            $error_message = "Error: " . $sql . "<br>" . $conn->error;
        }
        
    }
}

$conn->close();
    
?>

