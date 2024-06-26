<?php
    session_start();
    require 'config.php';
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = $_POST['username'];
        $password = $_POST['password'];
        if(!empty($username) && !empty($password)){
            $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                if(password_verify($password, $row['password'])){
                    $_SESSION['loggedin'] = true;
                    $_SESSION['username'] = $username;
                    $_SESSION['id'] = $row['id'];
                    header("Location: index.php");
                    exit;
                }else{
                    $error = "Usuário ou senha incorretos!";
                }
            }else{
                $error = "Usuário ou senha incorretos!";
            }
            $stmt->close();
        }else{
            $error = "Por favor, preencha todos os campos!";
        }
    }
    $conn->close();
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link rel="icon" type="image/x-icon" href="https://cdn2.iconfinder.com/data/icons/xbox-one-controllers/500/gamer_white-512.png">
        <link rel="stylesheet" href="./CSS/login.css">
    </head>
    <body>
        <div class="login-container">
            <h2>
                <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewBox="0 0 48 48">
                    <path fill="currentColor" d="M19.544 11.02c-1.06-.537-2.23-.623-3.302-.418l-2.244.43a5.737 5.737 0 0 0-4.032 3.032c-2.734 5.383-4.789 9.773-5.59 13.51c-.822 3.836-.35 7.102 2.044 10.082c1.6 1.991 4.403 1.595 5.86-.066a477.51 477.51 0 0 0 3.394-3.92A4.773 4.773 0 0 1 19.296 32h9.412a4.77 4.77 0 0 1 3.622 1.67a477.51 477.51 0 0 0 3.394 3.92c1.457 1.66 4.26 2.057 5.86.066c2.394-2.98 2.866-6.246 2.044-10.081c-.801-3.738-2.856-8.128-5.59-13.51a5.737 5.737 0 0 0-4.032-3.032l-2.244-.43c-1.072-.206-2.243-.12-3.302.417a25.43 25.43 0 0 0-.627.327c-.784.42-1.626.653-2.462.653h-2.738c-.836 0-1.678-.232-2.462-.653a27.36 27.36 0 0 0-.627-.327Zm-2.831 2.038c.626-.12 1.219-.053 1.702.192c.186.094.377.194.573.3c1.1.59 2.344.95 3.645.95h2.738c1.3 0 2.546-.36 3.645-.95c.196-.106.387-.206.573-.3c.483-.245 1.076-.312 1.702-.192l2.244.43c.981.188 1.824.82 2.274 1.708c2.756 5.426 4.652 9.533 5.375 12.903c.702 3.273.272 5.724-1.55 7.992c-.416.518-1.365.61-2.031-.15a474.369 474.369 0 0 1-3.375-3.899a7.273 7.273 0 0 0-5.52-2.542h-9.412c-2.125 0-4.14.933-5.52 2.542a472.456 472.456 0 0 1-3.375 3.899c-.666.76-1.615.668-2.032.15c-1.821-2.268-2.25-4.719-1.549-7.992c.723-3.37 2.619-7.477 5.374-12.903a3.237 3.237 0 0 1 2.275-1.708l2.244-.43ZM23.998 21a2 2 0 1 0 0-4a2 2 0 0 0 0 4Z"/>
                </svg>
            </h2>
            <?php if (isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>
            <form action="login.php" method="post">
                <div class="form-group">
                    <label for="username">Usuário</label>
                    <input type="text" name="username" id="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Senha</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <button type="submit">Login</button>
            </form>
        </div>
    </body>
</html>