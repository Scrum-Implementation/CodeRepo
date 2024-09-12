<?php

$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "todo_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $title = $conn->real_escape_string(trim($_POST['title']));
    $description = $conn->real_escape_string(trim($_POST['description']));
    $start_date = isset($_POST['start-date']) ? $conn->real_escape_string(trim($_POST['start-date'])) : '';
    $due_date = isset($_POST['end-date']) ? $conn->real_escape_string(trim($_POST['end-date'])) : '';

    $today = date('Y-m-d');
    
    $error_message = '';

    if (empty($title) || empty($description) || empty($start_date) || empty($due_date)) {
        $error_message = 'All fields are required.';
    } else {
        try {
            $start_date_obj = new DateTime($start_date);
            $due_date_obj = new DateTime($due_date);
            $today_obj = new DateTime($today);

            if ($start_date_obj < $today_obj || $due_date_obj < $today_obj) {
                $error_message = 'Dates cannot be in the past.';
            } elseif ($start_date_obj >= $due_date_obj) {
                
                $error_message = 'Start date must be earlier than due date.';
            } else {
                
                $sql = "INSERT INTO todos (name, description, start_date, due_date) 
                        VALUES ('$title', '$description', '$start_date', '$due_date')";

                if ($conn->query($sql) === TRUE) {
                    header("Location: mainpage.php");
                    exit;
                } else {
                    $error_message = "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        } catch (Exception $e) {
            $error_message = 'Invalid date format.';
        }
    }

    $conn->close();
    
}

?>
