<?php 
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $dnName = 'test';
    $table = 'workers';
    $pages = 'pages';

    $link = new mysqli($host, $user, $password, $dnName);
    mysqli_query($link, "SET NAMES 'utf8'");

    // LIMIT

    $query = "SELECT * FROM $table WHERE id > 0 LIMIT 6";
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
    var_dump($data);

    $query1 = "SELECT * FROM $table WHERE id > 0 LIMIT 2, 3";
    $result = mysqli_query($link, $query1) or die(mysqli_error($link));
    for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
    var_dump($data);

    // ORDER BY

    $query2 = "SELECT * FROM $table WHERE id > 0 ORDER BY salary";
    $result = mysqli_query($link, $query2) or die(mysqli_error($link));
    for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
    var_dump($data);

    $query3 = "SELECT * FROM $table WHERE id > 0 ORDER BY salary DESC";
    $result = mysqli_query($link, $query3) or die(mysqli_error($link));
    for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
    var_dump($data);

    $query4 = "SELECT * FROM $table WHERE id > 0 ORDER BY age LIMIT 1, 5";
    $result = mysqli_query($link, $query4) or die(mysqli_error($link));
    for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
    var_dump($data);

    // COUNT

    $query5 = "SELECT COUNT(*) as count FROM $table WHERE id > 0";
    $result = mysqli_query($link, $query5) or die(mysqli_error($link));
    for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
    var_dump($data);

    $query6 = "SELECT COUNT(*) as count FROM $table WHERE salary = 300";
    $result = mysqli_query($link, $query6) or die(mysqli_error($link));
    for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
    var_dump($data);

    // LIKE

    $query7 = "SELECT * FROM $pages WHERE author LIKE '%ов'";
    $result = mysqli_query($link, $query7) or die(mysqli_error($link));
    for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
    var_dump($data);

    $query8 = "SELECT * FROM $pages WHERE article LIKE '%элемент%'";
    $result = mysqli_query($link, $query8) or die(mysqli_error($link));
    for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
    var_dump($data);

    $query9 = "SELECT * FROM $table WHERE age LIKE '%3_'";
    $result = mysqli_query($link, $query9) or die(mysqli_error($link));
    for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
    var_dump($data);

    $query10 = "SELECT * FROM $table WHERE name LIKE '%я'";
    $result = mysqli_query($link, $query10) or die(mysqli_error($link));
    for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
    var_dump($data);
?>
