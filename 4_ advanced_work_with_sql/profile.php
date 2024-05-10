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
    $query = "SELECT * FROM $table WHERE id='$user_id'";
    $result = mysqli_query($link, $query);
    $user = $result->fetch_assoc();

    // Получение возраста пользователя
    $today = date('Y-m-d');
    $diff = date_diff(date_create($user['birthday']), date_create($today));
    $age = $diff->y;
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Профиль</title>
    </head>
    <body>
        <h1>Профиль</h1>
        <div>
            <p>Пользователь: <?php echo $user['login']; ?></p>
            <p>Имя: <?php echo $user['name']; ?></p>
            <p>Фамилия: <?php echo $user['second_name']; ?></p>
            <p>Отчество: <?php echo $user['surname']; ?></p>
            <p>Возраст: <?php echo $age; ?></p>
        </div>
        <div style="display: flex; gap: 30px;">
            <a href="personalArea.php">Редактировать</a>
            <a href="changePassword.php">Сменить пароль</a>
            <a href="logout.php">Выйти</a>
        </div>
    </body>
</html>
