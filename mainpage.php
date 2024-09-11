<?php

$task_title ="";
$task_desc ="";
$task_start_date ="";
$task_end_date ="";

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
        <div class = "container">
        <h3>New Task</h3>
            <form action = "mainpage.php">
                <input type="text" placeholder="Title"  class="input-field" value="<?php htmlspecialchars($task_title);?>"><br><br>
                <input type="text" class="desc-input-field" placeholder="Description" value="<?php htmlspecialchars($task_desc);?>"><br><br>
                <div class="date-input-container"> 
                    <input type="date" class="date-input-field" value="<?php htmlspecialchars($task_start_date);?>">
                    <input type="date" class="date-input-field" value="<?php htmlspecialchars($task_end_date);?>">
                </div>
            </form>
        </div>

</body>
</html>