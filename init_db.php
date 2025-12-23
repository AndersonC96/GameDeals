<?php
mysqli_report(MYSQLI_REPORT_STRICT);

$servername = "localhost";
$username = "root";
$password = "";

try {
    // 1. Connect to MySQL Server (no DB selected)
    $conn = new mysqli($servername, $username, $password);
    echo "Conectado ao MySQL com sucesso.\n";

    // 2. Create Database
    $sql = "CREATE DATABASE IF NOT EXISTS game_discounts_db";
    if ($conn->query($sql) === TRUE) {
        echo "Banco de dados 'game_discounts_db' verificado/criado.\n";
    }

    // 3. Select Database
    $conn->select_db("game_discounts_db");

    // 4. Create Users Table
    $sqlUsers = "CREATE TABLE IF NOT EXISTS users (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(30) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    if ($conn->query($sqlUsers) === TRUE) {
        echo "Tabela 'users' verificada/criada.\n";
    }

    // 5. Create Wishlist Table
    $sqlWishlist = "CREATE TABLE IF NOT EXISTS wishlist (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        user_id INT(6) UNSIGNED NOT NULL,
        game_id VARCHAR(50) NOT NULL,
        title VARCHAR(255) NOT NULL,
        sale_price DECIMAL(10, 2),
        normal_price DECIMAL(10, 2),
        thumb VARCHAR(255),
        store_id VARCHAR(50),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    )";
    if ($conn->query($sqlWishlist) === TRUE) {
        echo "Tabela 'wishlist' verificada/criada.\n";
    }

    // 6. Create Test User (Optional)
    $testUser = "gamer";
    $testPass = password_hash("123", PASSWORD_DEFAULT);
    
    // Check if user exists
    $check = $conn->query("SELECT id FROM users WHERE username = '$testUser'");
    if ($check->num_rows == 0) {
        $sqlInsert = "INSERT INTO users (username, password) VALUES ('$testUser', '$testPass')";
        if ($conn->query($sqlInsert) === TRUE) {
            echo "Usuário de teste criado (User: gamer, Pass: 123).\n";
        }
    } else {
        echo "Usuário de teste já existe.\n";
    }

    $conn->close();
    echo "\nConfiguração do Banco de Dados Concluída com Sucesso!";

} catch (mysqli_sql_exception $e) {
    echo "\nERRO FATAL: Não foi possível conectar ao MySQL.\n";
    echo "Mensagem: " . $e->getMessage() . "\n";
    echo "SOLUÇÃO: Verifique se o XAMPP Control Panel está aberto e o módulo 'MySQL' está rodando (verde).\n";
    exit(1);
}
?>
