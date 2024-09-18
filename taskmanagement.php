<?php

include 'connection.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    var_dump($_POST);
    
    $title = $_POST['name'];
    $description = $_POST['description'];
    $due_date = isset($_POST['due_date']) ? $_POST['due_date']: '';
    $end_time = isset($_POST['end_time']) ? $_POST['end_time']: '';

    $today = date('Y-m-d');
    
    $error_message = '';

    if (empty($title) || empty($description) || empty($due_date) || empty($end_time)) {
        $error_message = 'All fields are required.';
    } else {
        try {

            $due_date_and_time = new DateTime($due_date . " " . $end_time, new DateTimeZone('Asia/Manila'));
            $today = new DateTime('now', new DateTimeZone('Asia/Manila'));

            if ($due_date_and_time < $today) {
                $error_message = 'Due date and time cannot be in the past.';
            } else {
                
                $sql = "INSERT INTO todos (name, description, due_date, end_time) 
                        VALUES ('$title', '$description', '$due_date', '$end_time')";

                if ($conn->query($sql)== TRUE) {
                    header("Location: mainpage.php");
                    exit;
                } else {
                    exit;
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

