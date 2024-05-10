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
        if (password_verify($_POST['old_password'], $hash)) {
            $newPasswordHash = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
    
            $query = "UPDATE $table SET password='$newPasswordHash' WHERE id='$user_id'";
            mysqli_query($link, $query);
            header("Location: login.php");
        } else {
            echo 'Старый пароль введен неверно. ';
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Смена пароля</title>
    </head>
    <body>
        <h3>Смена пароля</h3>
        <form action="" method="POST">
            <input type="password" name="old_password" placeholder="Старый пароль">
            <input type="password" name="new_password" placeholder="Новый пароль">
            <input type="submit" value="Поменять">
        </form>
        <a href="profile.php">Профиль</a>
    </body>
</html>
