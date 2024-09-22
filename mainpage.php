
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
                    <label for="due-date"><b>Due Date</b></label><br><br>

                    <div class="date-input-container"> 
                    <div class="date-label-one">
                        <input type="date" id="due-date" name="due-date" class="date-input-field" value="">
                    </div>
                    <div class="date-label-two">
                        <input type="time" id="end-time" name="end-time" class="date-input-field" value="">
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

                    <?php  include 'displaydata.php';  ?>
                                  
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>

<script>
    document.getElementById('contact-form').addEventListener('submit', function(event) {
        event.preventDefault();
        
        const title = document.getElementById('title').value.trim();
        const description = document.getElementById('description').value.trim();
        const dueDate = document.getElementById('due-date').value.trim();
        const endTime = document.getElementById('end-time').value.trim();

        if (title === '' || description === '' || dueDate === '' || endTime === '') {
            alert('Please fill out all fields.');
            return;
        }

        const today = new Date();
        const todayManila = new Date(today.toLocaleString('en-US', {timeZone: 'Asia/Manila'}));
        const todayFormatted = todayManila.toISOString().slice(0, 10) + ' ' + todayManila.toLocaleTimeString('en-US', {hour12: false, hourCycle: 'h23'});
        
        const dueDateFormatted = new Date(dueDate + ' ' + endTime).toISOString().slice(0, 10) + ' ' + new Date(dueDate + ' ' + endTime).toLocaleTimeString('en-US', {hour12: false, hourCycle: 'h23'});

        if (new Date(dueDateFormatted) < new Date(todayFormatted)) {
            alert('Due date and time cannot be in the past.');
            return;
        }

        this.submit();
    });
</script>
