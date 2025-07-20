
<?php include 'connection/connection_with_db.php'?>


<?php 

$error = "";
$success = "";

if ($_SERVER ['REQUEST_METHOD'] == "POST" &&  isset($_POST["submit"])){
    $task = $_POST['task'];
    $day = $_POST['day'] ?? "";

    if(!empty($task) && !empty($day)){

        $sql = "INSERT INTO `todolist` (Task,Day) VALUES ('$task' , '$day')";

        try {
            mysqli_query($conn , $sql)  ;
            $success = "To do has been created successfully for u!";
        } catch (mysqli_sql_exception $e) {
           echo $e->getMessage();
        }
    }else{
        $error = "Fill all the given fields!";
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'components/navbar.html'?>
    
    <div class="form">
        <form action="form.php" method="post">

        <?php echo "<p>$success</p>"?>
            <label for="task">Task:</label>
            <input type="text" name="task" placeholder="Add tasks">

            <label for="days">Select Day:</label>
            <select name="day" >
                <option value="select day" disabled selected>Select day</option>
                <option value="Monday">Monday</option>
                <option value="Tuesday">Tuesday</option>
                <option value="Wednesday">Wednesday</option>
                <option value="Thursday">Thursday</option>
                <option value="Friday">Friday</option>
                <option value="Saturday">Saturday</option>
                <option value="Sunday">Sunday</option>
            </select>

            <input type="submit" name="submit" value="Add tasks">
            
            <?php  echo "<P> $error </p>"?>
        </form>
    </div>


   

?>
   
</body>
</html>