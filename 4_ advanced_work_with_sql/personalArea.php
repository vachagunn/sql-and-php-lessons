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

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $second_name = $_POST['second_name'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $birthday = $_POST['birthday'];

        $query = "UPDATE $table SET 
            name='$name',
            second_name='$second_name',
            surname='$surname',
            email='$email',
            birthday='$birthday'
            WHERE id='$user_id'";

        mysqli_query($link, $query);
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Личный кабинет</title>
    </head>
    <body>
        <h3>Личный кабинет</h3>
        <form action="" method="POST">
            <table>
                <tr>
                    <th>Имя</th>
                    <th>Фамилия</th>
                    <th>Отчество</th>
                    <th>Дата рождения</th>
                    <th>Почта</th>
                </tr>
                <tr>
                    <td><input type="text" name="name" value="<?php echo $user['name']; ?>"></td>
                    <td><input type="text" name="second_name" value="<?php echo $user['second_name']; ?>"></td>
                    <td><input type="text" name="surname" value="<?php echo $user['surname']; ?>"></td>
                    <td><input type="email" name="email" value="<?php echo $user['email']; ?>"></td>
                    <td><input type="date" name="birthday" value="<?php echo $user['birthday']; ?>"></td>
                    <td><input type="submit" value="Сохранить"></td>
                </tr>
            </table>
        </form>
        <a href="profile.php">Профиль</a>
    </body>
</html>
