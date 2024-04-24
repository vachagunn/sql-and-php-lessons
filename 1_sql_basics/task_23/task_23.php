<?php 
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $dnName = 'test';
    $table = 'workers';

    $link = new mysqli($host, $user, $password, $dnName);
    mysqli_query($link, "SET NAMES 'utf8'");

    $query = "SELECT*FROM $table WHERE id > 0";

    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
    var_dump($data);
?>
