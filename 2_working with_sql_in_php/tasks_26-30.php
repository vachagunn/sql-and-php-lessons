<table>
    <tr>
        <th>id</th>
        <th>name</th>
        <th>age</th>
        <th>salary</th>
    </tr>

    <!-- Функция для генерации поля по атрибутам name и value -->
    <?php
        function input($name)
        {
            if (isset($_POST[$name])) {
                $value = $_POST[$name];
            } else {
                $value = '';
            }
                
            return '<input name="' .$name . '" value="' .$value .'">'; 
        } 
    ?>

    <?php 
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $dnName = 'test';
        $table = 'workers';

        // Подключение к БД
        $link = new mysqli($host, $user, $password, $dnName);
        mysqli_query($link, "SET NAMES 'utf8'");

        // Добавление работника по атрибутам с формы
        if (!empty($_POST)) {
            $name = $_POST['name'];
            $age = $_POST['age'];
            $salary = $_POST['salary'];

            $query = "INSERT INTO $table SET name='$name', age='$age', salary='$salary'";
            $result = mysqli_query($link, $query) or die(mysqli_error($link));
        }

        // Удаление работника по id
        if (isset($_GET['del'])) {
            $del = $_GET['del'];
            $query = "DELETE FROM $table WHERE id=$del";
            $result = mysqli_query($link, $query) or die(mysqli_error($link));
        }

        // Отображение сотрудников
        $query = "SELECT * FROM $table";
        $result = mysqli_query($link, $query) or die(mysqli_error($link));
        for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
        // var_dump($data);
        
        $result = '';
        foreach($data as $elem) {
            $result .= '<tr>';

            $result .= '<td>' . $elem['id'] . '</td>';
            $result .= '<td>' . $elem['name'] . '</td>';
            $result .= '<td>' . $elem['age'] . '</td>';
            $result .= '<td>' . $elem['salary'] . '</td>';
            $result .= '<td><a href="?del=' . $elem['id'] . '">удалить</a></td>';

            $result .= '</tr>';
        }

        echo $result;
    ?>

    <form action="" method="POST">
        <?php echo input('name'); ?>
        <?php echo input('age'); ?>
        <?php echo input('salary'); ?>
        <input type="submit" value="добавить работника">
    </form>
</table>
