<?php

include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $title = $conn->real_escape_string(trim($_POST['title']));
    $description = $conn->real_escape_string(trim($_POST['description']));
    $due_date = isset($_POST['due-date']) ? $conn->real_escape_string(trim($_POST['due-date'])) : '';
    $end_time = isset($_POST['end-time']) ? $conn->real_escape_string(trim($_POST['end-time'])) : '';

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

