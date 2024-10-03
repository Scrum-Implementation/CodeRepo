<?php

include 'connection.php';

?>

<?php
    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "SELECT * FROM todos WHERE id = $id";
        $result = $conn->query($sql);

        $row = $result->fetch_assoc();
    }
?>

<?php
    if(isset($_POST['update'])) {

        $title = $_POST['title'];
        $description = $_POST['description'];
        $due_date = $_POST['due-date'];
        $end_time = $_POST['end-time'];

        $sql = "UPDATE todos SET name = '$title', description = '$description', due_date = '$due_date', end_time = '$end_time' WHERE id = $id";
        $result = $conn->query($sql);

        if(!$result) {
            die("Error: " . $sql . "<br>" . $conn->error);
        }else{
            header("Location: mainpage.php");
            exit;
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Document</title>
</head>
<body>
    <div class="nothing">
        <div class = "container">
            <h1>New Task</h1>
            <form action = "editdata.php?id=<?php echo $id; ?>"  method="POST" id = "contact-form">

               <div class ="extra">
                    <div class="labels">
                    <label for="title"><b>Task Title</b></label><br><br>
                    </div>
                    <div class="white-container-one">
                    <input type="text" id="title" name="title" placeholder="  Type your task name"  class="input-field" value="<?php echo $row['name']; ?>"><br><br>
                    </div><br>

               
                    <div class="labels">
                    <label for="description"><b>Task Description</b></label><br><br>
                    </div> 
                    <div class="white-container-two">         
                    <textarea class="desc-input-field" placeholder=" Type your task description"  id="description" name="description"> <?php echo $row['description']; ?></textarea><br><br><br>
                    </div><br>
                    <div class="labels">
                    <label for="date-due"><b>Due Date</b></label><br><br>

                    <div class="date-input-container"> 
                    <div class="date-label-one">
                        <input type="date" id="due_date" name="due_date" class="date-input-field" value="<?php echo $row['due_date']; ?>">
                    </div>
                    <div class="date-label-two">
                        <input type="time" id="end_time" name="end_time" class="time-input-field" value="<?php echo $row['end_time']; ?>">
                    </div>
                </div><br><br>
                </div>
              </div>

                
                <button type="submit" name="update" class="submitBtn">UPDATE</button>
            </form>
        </div>
    
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Due date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>

                    <?php  include 'displaydata.php';  ?>
                                  
                </tbody>
            </table>
        </div>

    </div>

</body>
</html>