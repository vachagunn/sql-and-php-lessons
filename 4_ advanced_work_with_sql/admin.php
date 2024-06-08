<?php 
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $dnName = 'test';
    $table = 'users';

    $link = new mysqli($host, $user, $password, $dnName);
    mysqli_query($link, "SET NAMES 'utf8'");

    session_start();
    if(!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Панель админа</title>
    </head>
    <body style="font-size: 32px;">
        <h3>Панель админа</h3>

        <table border="1">
            <tr>
                <th>Логин</th>
                <th>Статус</th>
            </tr>
            <?php
            $query = "SELECT * FROM $table";
            $result = mysqli_query($link, $query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['login'] . "</td>";
                    if ($row['status'] == 'admin') {
                        echo "<td style='color: red;'>" . $row['status'] . "</td>";
                    } else {
                        echo "<td style='color: green;'>" . $row['status'] . "</td>";
                    }
                }
            }
            ?>
        </table>
    </body>
</html>
