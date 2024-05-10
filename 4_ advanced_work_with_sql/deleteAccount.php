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

    $user_id = $_SESSION['user_id'];
    $query = "SELECT * FROM $table WHERE id='$user_id'";
    $result = mysqli_query($link, $query);
    $user = $result->fetch_assoc();

    $hash = $user['password'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (password_verify($_POST['password'], $hash)) {    
            $query = "DELETE FROM $table WHERE id='$user_id'";
            mysqli_query($link, $query);
            header("Location: login.php");
        } else {
            echo 'Пароль введен неверно. ';
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Удаление аккаунта</title>
    </head>
    <body>
        <h3>Удаление аккаунта</h3>
        <form action="" method="POST">
            <input type="password" name="old_password" placeholder="Введите пароль">
            <input type="submit" value="Удалить">
        </form>
        <div style="margin-top: 15px;">
            <a href="profile.php">Профиль</a>
        </div>
    </body>
</html>
