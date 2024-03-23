<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "game_discounts_db";
    $conn = new mysqli($servername, $username, $password);
    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
    if($conn->query($sql) === TRUE){
        echo "Database created successfully";
    }else{
        echo "Error creating database: " . $conn->error;
    }
    $conn->close();
    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql = "CREATE TABLE IF NOT EXISTS users(
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(30) NOT NULL,
        password VARCHAR(60) NOT NULL,
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    if($conn->query($sql) === TRUE){
        echo "Table users created successfully";
    }else{
        echo "Error creating table: " . $conn->error;
    }
    $conn->close();
?>