<?php 
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $dnName = 'test';
    $table = 'users';

    $link = new mysqli($host, $user, $password, $dnName);
    mysqli_query($link, "SET NAMES 'utf8'");

    function validate($login, $password, $email, $birthday) {
        $errors = array();
        
        if (strlen($login) < 4 || strlen($login) > 10) {
            $error_text = 'Логин должен быть длиной от 4 до 10 символов. ';
            $errors['login'] = $error_text;
        }
        
        if (!preg_match('/^[a-zA-Z0-9]*$/', $login)) {
            $error_text = 'Логин может содержать только латинские буквы и цифры. ';
            $errors['login'] = $error_text;
            echo $error_text;
        }

        if (strlen($password) < 6 || strlen($password) > 12) {
            $error_text = 'Пароль должен быть длиной от 6 до 12 символов. ';
            $errors['password'] = $error_text;
            echo $error_text;
        }

        // Валидация email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error_text = 'Email не корректный. ';
            $errors['email'] = $error_text;
            echo $error_text;
        }

        // Валидация даты рождения
        $dateOfBirthObj = DateTime::createFromFormat('Y-m-d', $birthday);

        if ($dateOfBirthObj && !($dateOfBirthObj->format('Y-m-d') === $birthday)) {
            $error_text = 'Дата рождения не корректна. ';
            $errors['birthday'] = $error_text;
            echo $error_text;
        }

        return $errors;
    }

    // Если форма регистрации отправлена...
    if (!empty($_POST['login'] && !empty($_POST['password']))) {
        $login = $_POST['login'];
        $password = $_POST['password'];

        $hash = password_hash($password, PASSWORD_DEFAULT);
        
        $confirm_password = $_POST['confirm_password'];
        $email = $_POST['email'];
        $birthday = $_POST['birthday'];
        $date = date('Y-m-d'); // Получаем текущую дату

        // Валидация данных
        $errors = validate($login, $password, $email, $birthday);
        echo ' Кол-во ошибок: '. count($errors) . ' ';  

        if (count($errors) == 0) {
            // Пробуем получить юзера по логину
            $query = "SELECT * FROM $table WHERE login='$login'";
            $user = mysqli_fetch_assoc(mysqli_query($link, $query));
    
            // Если юзера с таким логином нет
            if (empty($user) || count($user) != 0) {
                // Проверка совпадения пароля
                if ($password == $confirm_password) {
                    $query = "INSERT INTO $table SET login= '$login', password='$hash', salt='$salt', email='$email', birthday='$birthday', registration_date='$date'";
                    mysqli_query($link, $query);
                    
                    // Пишем в сессию пометку об авторизации
                    $_SESSION['auth'] = true;   
                    // $_SESSION['id'] = $id;
                } else {
                    echo 'Пароли не совпадают. ';
                }
            } else {    
                echo 'Логин уже занят. ';
            }
        } else {
            echo 'Неверно введены данные. ';
        }
    } else {
        echo 'Заполните форму регистрации. ';
    }
?>

<h3>Регистрация</h3>
<form action="" method="POST">
    <div style="margin-bottom: 15px;">
        <input name="login" placeholder="Логин" required>
        <input name="password" type="password" placeholder="Пароль" required>
        <input name="confirm_password" type="password" placeholder="Повторите пароль" required>
    </div>
    <div style="margin-bottom: 5px;">
        <input name="email" type="email" placeholder="Почта">
        <input name="birthday" type="date" placeholder="Дата рождения">
    </div>
    <div>       
        <input type="submit" value="Отправить">
    </div>
</form> 