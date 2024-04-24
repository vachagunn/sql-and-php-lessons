<?php 
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $dnName = 'test';
    $table = 'users';

    $link = new mysqli($host, $user, $password, $dnName);
    mysqli_query($link, "SET NAMES 'utf8'");

    // Если форма авторизации отправлена...
    if (!empty($_POST['login'] && !empty($_POST['password']))) {
        $login = $_POST['login'];

        $query = "SELECT * FROM $table WHERE login='$login'";
        $result = mysqli_query($link, $query);

        $user = mysqli_fetch_assoc($result);

        if (!empty($user)) {
            $salt = $user['salt'];
            $hash_password = $user['password'];

            $password = md5($salt . $_POST['password']);

            if ($password == $hash_password) {
                $_SESSION['auth'] = true;
                echo "Пользователь прошел авторизацию";
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
<a href="1.php">Страница 1</a>
<a href="register.php">Регистрация</a>
<a href="logout.php">Выйти</a>
