<?php 
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $dnName = 'test';
    $table = 'users';

    $link = new mysqli($host, $user, $password, $dnName);
    mysqli_query($link, "SET NAMES 'utf8'");

    // session_start();
    // if(isset($_SESSION['user_id'])) {
    //     header("Location: profile.php");
    //     exit();
    // }

    // Если форма авторизации отправлена...
    if (!empty($_POST['login'] && !empty($_POST['password']))) {
        $login = $_POST['login'];

        $query = "SELECT * FROM $table WHERE login='$login'";
        $result = mysqli_query($link, $query);

        $user = mysqli_fetch_assoc($result);

        if (!empty($user)) {
            $hash = $user['password'];

            // Проверяем соответствие пароля и хэша
            if (password_verify($_POST['password'], $hash)) {
                $_SESSION['auth'] = true;
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['status'] = $user['status'];
                header("Location: profile.php");
                exit();
            } else {
                echo "Пара логин-пароль неверна";
            }
        } else {
            echo "Пользователь неверно ввел логин или пароль";
        }
    }
?>

<h3>Авторизация</h3>
<form action="" method="POST">
    <input name="login">
    <input name="password" type="password">
    <input type="submit" value="Отправить">
</form>
<a href="register.php">Регистрация</a>
