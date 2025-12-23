<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "game_discounts_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// sql to create table
$sql = "CREATE TABLE IF NOT EXISTS wishlist (
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

if ($conn->query($sql) === TRUE) {
  echo "Table wishlist created successfully";
} else {
  echo "Error creating table: " . $conn->error;
}

$conn->close();
?>
