<?php

include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $title = $conn->real_escape_string(trim($_POST['title']));
    $description = $conn->real_escape_string(trim($_POST['description']));
    $due_date = isset($_POST['due-date']) ? $conn->real_escape_string(trim($_POST['due-date'])) : '';
    $end_time = isset($_POST['end-time']) ? $conn->real_escape_string(trim($_POST['end-time'])) : '';

    $today = date('Y-m-d');
    
    $error_message = '';

    if (empty($title) || empty($description) || empty($due_date) || empty($end_time)) {
        $error_message = 'All fields are required.';
    } else {
        try {

            $due_date_obj = new DateTime($due_date . ' ' . $end_time);
            $today_obj = new DateTime($today);

            if ($due_date_obj < $today_obj) {
                $error_message = 'Due date and time cannot be in the past.';
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
        } catch (Exception $e) {
            $error_message = 'Invalid date and time format.';
        }
    }

    $conn->close();
    
}

?>


