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
    
    // Получаем данные авторизованного пользователя
    $user_id = $_SESSION['user_id'];
    $query = "SELECT * FROM users WHERE id='$user_id'";
    $result = mysqli_query($link, $query);
    $user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Профиль</title>
    </head>
    <body>
        <h1>Профиль</h1>
        <h3>Пользователь: <?php echo $user['login']; ?></h3>
        <a href="logout.php">Выйти</a>
    </body>
</html>
