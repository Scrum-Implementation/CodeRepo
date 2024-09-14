
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
            <form action = "taskmanagement.php"  method="POST" id = "contact-form">

               <div class ="extra">
                    <div class="labels">
                    <label for="title"><b>Task Title</b></label><br><br>
                    </div>
                    <div class="white-container-one">
                    <input type="text" id="title" name="title" placeholder="  Type your task name"  class="input-field" value=""><br><br>
                    </div><br>

               
                    <div class="labels">
                    <label for="description"><b>Task Description</b></label><br><br>
                    </div> 
                    <div class="white-container-two">         
                    <textarea class="desc-input-field" placeholder=" Type your task description"  id="description" name="description"></textarea><br><br><br>
                    </div><br>
                    <div class="labels">
                    <label for="date-due"><b>Due Date</b></label><br><br>

                    <div class="date-input-container"> 
                    <div class="date-label-one">
                        <input type="date" id="date-due" name="date-due" class="date-input-field" value="">
                    </div>
                    <div class="date-label-two">
                        <input type="time" id="time-due" name="time-due" class="date-input-field" value="">
                    </div>
                </div><br><br>
                </div>
              </div>

                
                <button type="submit" name="create" class="submitBtn">CREATE</button>
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

                    <?php  include 'fetchdata.php';  ?>
                                  
                </tbody>
            </table>
        </div>
    </div>
    
   




</body>
</html>