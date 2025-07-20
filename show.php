<?php
include 'connection/connection_with_db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])){
    $id = $_POST['id'];

    $sql_del = "DELETE FROM `todolist` WHERE id = '$id'";


    try {
        mysqli_query($conn, $sql_del);
    } catch (mysqli_sql_exception $e) {
        echo $e->getMessage();
    }
}

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="show.css">
</head>
<body>

<?php include 'components/navbar.html'?>
    <table border="1">
        <thead>
            <tr>
            <th>Task</th>
            <th>Day</th>
            <th>Created_at</th>
            <th>Action Buttons</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        
        $sql_fetch = "SELECT * FROM `todolist`";

        try {
            $result = mysqli_query($conn, $sql_fetch);
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    echo "<tr>";
                    echo "<td>". $row['Task'] . "</td>"; 
                    echo "<td>". $row['Day'] . "</td>"; 
                    echo "<td>". $row['Created_at'] . "</td>";
                    echo "<td>"; 
                    echo "<form method = 'post'>";
                    echo "<input type='hidden' name='id' value='" . $row['Id'] . "'>";
                    echo "<input type='submit' name='delete' value='delete'>";
                    echo "</form>";
                    echo "<a href= 'edit.php?task_id=" . $row['Id'] . "'>Edit</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            }
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
        
        ?>
    </tbody>
    </table>
</body>
</html>