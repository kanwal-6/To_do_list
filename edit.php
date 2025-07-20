<?php include 'connection/connection_with_db.php';


if (isset($_GET['task_id'])) {
    $task_id = $_GET['task_id'];

    $fetch_sql_query = "SELECT * FROM `todolist` WHERE id = $task_id";

    try {
        $result = mysqli_query($conn, $fetch_sql_query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $fetch_task = $row['Task'];
            $fetch_day = $row['Day'];
        }
    } catch (mysqli_sql_exception $e) {
        echo $e->getMessage();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
        $update_task = $_POST['task'];
        $update_day = $_POST['day'];

        echo $update_task;
        echo $update_day;

        if (!empty($update_task) && !empty($update_day)) {
            $sql_update = "UPDATE `todolist` SET Task = '$update_task',
        Day = '$update_day' WHERE Id = $task_id";
        
        try {
            mysqli_query($conn, $sql_update);
        } catch (mysqli_sql_exception $e) {
            echo "something went wrong";
        }
        }
    }
}

?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<link rel="stylesheet" href="style.css">

<body>
    <?php include 'components/navbar.html' ?>

    <div class="form">
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">

            <label for="task">Task:</label>
            <input type="text" name="task" placeholder="Add tasks" value="<?php $fetch_task ?? '' ?>">

            <label for="days">Select Day:</label>
            <select name="day">
                <option value="select day" disabled selected>Select day</option>
                <option value="Monday" <?php $fetch_day ?? '' == "Monday" ? "selected" : '' ?>>Monday</option>
                <option value="Tuesday" <?php $fetch_day ?? '' == "Tuesday" ? "selected" : '' ?>>Tuesday</option>
                <option value="Wednesday" <?php $fetch_day ?? '' == "Wednesday" ? "selected" : '' ?>>Wednesday</option>
                <option value="Thursday" <?php $fetch_day ?? '' == "Thursday" ? "selected" : '' ?>>Thursday</option>
                <option value="Friday" <?php $fetch_day ?? '' == "Friday" ? "selected" : '' ?>>Friday</option>
                <option value="Saturday" <?php $fetch_day ?? '' == "Saturday" ? "selected" : '' ?>>Saturday</option>
                <option value="Sunday" <?php $fetch_day ?? '' == "Sunday" ? "selected" : '' ?>>Sunday</option>
            </select>

            <input type="submit" name="update" value="update">


        </form>
    </div>




    ?>

</body>

</html>