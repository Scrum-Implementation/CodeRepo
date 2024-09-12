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

    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);
    $start_date = isset($_POST['start-date']) ? $conn->real_escape_string($_POST['start-date']) : '';
    $due_date = isset($_POST['end-date']) ? $conn->real_escape_string($_POST['end-date']) : '';

    $sql = "INSERT INTO todos (name, description, start_date, due_date) 
            VALUES ('$title', '$description', '$start_date', '$due_date')";

    if ($conn->query($sql) === TRUE) {
        echo "New task created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
