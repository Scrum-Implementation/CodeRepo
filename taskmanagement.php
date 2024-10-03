<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $title = $_POST['title']git ;
    $description = $_POST['description'];
    $due_date = $_POST['due-date'];
    $end_time = $_POST['end-time'];

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

