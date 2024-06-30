<?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "connect";

    $conn = mysqli_connect($host, $username, $password, $dbname);

    if(!$conn){
        die("Connection failad: " .mysqli_connect_error());
    }
?>