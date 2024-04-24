<?php 
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $dnName = 'test';
    $table = 'workers';

    $link = new mysqli($host, $user, $password, $dnName);
    mysqli_query($link, "SET NAMES 'utf8'");

    // SELECT (5 и 8)

    $query = "SELECT * FROM $table WHERE salary >= 500";
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
    var_dump($data);
    
    $query1 = "SELECT salary, age FROM $table WHERE name = 'Вася'";
    $result = mysqli_query($link, $query1) or die(mysqli_error($link));
    for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
    var_dump($data);

    // AND OR (9 и 13)

    $query2 = "SELECT * FROM $table WHERE age > 25 AND age <= 28";
    $result = mysqli_query($link, $query2) or die(mysqli_error($link));
    for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
    var_dump($data);

    $query3 = "SELECT * FROM $table WHERE age = 27 OR salary = 1000";
    $result = mysqli_query($link, $query3) or die(mysqli_error($link));
    for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
    var_dump($data);

    // INSERT (18)

    $query4 = "INSERT INTO $table (name, salary) VALUES ('Светлана', 1200)";
    $result = mysqli_query($link, $query4) or die(mysqli_error($link));
    for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
    var_dump($data);

    // DELETE (21)

    $query5 = "DELETE FROM $table WHERE name = 'Коля'";
    $result = mysqli_query($link, $query5) or die(mysqli_error($link));
    for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
    var_dump($data);

    // UPDATE (25)

    $query6 = "UPDATE $table SET salary = 700 WHERE salary = 500";
    $result = mysqli_query($link, $query6) or die(mysqli_error($link));
    for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
    var_dump($data);
?>
