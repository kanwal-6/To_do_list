<?php include 'connection/connection_with_db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $item_id = $_POST['id'];
    // echo $item_id;

    $slq_delete = "DELETE FROM `todolist` WHERE Id = '$item_id'";

    try {
        mysqli_query($conn, $slq_delete);
    } catch (mysqli_sql_exception $e) {
        echo $e->getMessage();
    }
}

//  if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['update'])) {
//         $update_title = $_POST['title'];
//         $update_description = $_POST['description'];
//         $update_day = $_POST['day'];

//         echo $update_title;
//         echo $update_description;
//         echo $update_day;

//         if (!empty($update_title) && !empty($fetch_description) && !empty($update_day)) {

//             $update_sql = "UPDATE `todo` SET 
//                 title = '$update_title',
//                 description = '$update_description',
//                 day = '$update_day'
//                 WHERE id = $item_id";

//             try {
//                 mysqli_query($conn, $update_sql);
//                 header("location:show.php");
//             } catch (mysqli_sql_exception $e) {
//                 echo "something went wrong";
//             }
//         }
//     }


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
    <?php include 'components/navbar.html' ?>
    <table border="1">
        <thead>
            <tr>
                <th>Task</th>
                <th>Day</th>
                <th>Created at</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php

            $sql_fetch = "SELECT * FROM `todolist` ";

            try {
                $result = mysqli_query($conn, $sql_fetch);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row["Task"] . "</td>";
                        echo "<td>" . $row["Day"] . "</td>";
                        echo "<td>" . $row["Created_at"] . "</td>";
                        // echo "<td>" . $row["Id"] . "</td>";
            
                        echo "<td>";
                        echo "<form method='post'>";
                        echo "<input type='hidden' name='id' value='" . $row['Id'] . "' >";
                        echo "<input type='submit' value='delete' name='delete' class='cursor-pointer font-semibold  bg-red-700 p-1 rounded text-white'/>";
                        echo "</form>";

                        echo " <button> Edit</button>  
                             </td>";
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