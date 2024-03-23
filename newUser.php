<?php
    require 'config.php';
    $username = "Anderson";
    $password = "B@tman1996";
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $passwordHash);
    if($stmt->execute()){
        echo "Usuário criado com sucesso!";
    }else{
        echo "Erro ao criar usuário: " . $conn->error;
    }
    $stmt->close();
    $conn->close();
?>