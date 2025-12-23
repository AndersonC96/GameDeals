<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastro - GameDeals</title>
        <link rel="icon" type="image/x-icon" href="https://cdn2.iconfinder.com/data/icons/xbox-one-controllers/500/gamer_white-512.png">
        <link rel="stylesheet" href="assets/css/login.css">
    </head>
    <body>
        <div class="login-container">
            <h2>
                <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 48 48">
                    <path fill="currentColor" d="M19.544 11.02c-1.06-.537-2.23-.623-3.302-.418l-2.244.43a5.737 5.737 0 0 0-4.032 3.032c-2.734 5.383-4.789 9.773-5.59 13.51c-.822 3.836-.35 7.102 2.044 10.082c1.6 1.991 4.403 1.595 5.86-.066a477.51 477.51 0 0 0 3.394-3.92A4.773 4.773 0 0 1 19.296 32h9.412a4.77 4.77 0 0 1 3.622 1.67a477.51 477.51 0 0 0 3.394 3.92c1.457 1.66 4.26 2.057 5.86.066c2.394-2.98 2.866-6.246 2.044-10.081c-.801-3.738-2.856-8.128-5.59-13.51a5.737 5.737 0 0 0-4.032-3.032l-2.244-.43c-1.072-.206-2.243-.12-3.302.417a25.43 25.43 0 0 0-.627.327c-.784.42-1.626.653-2.462.653h-2.738c-.836 0-1.678-.232-2.462-.653a27.36 27.36 0 0 0-.627-.327Z"/>
                </svg>
            </h2>
            <h3 style="margin-bottom: 25px; font-weight: 400; color: var(--text-muted);">Criar Conta</h3>
            <?php if (isset($error) && !empty($error)): ?>
            <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>
            <?php if (isset($success) && !empty($success)): ?>
            <p class="error" style="border-color: #00ff9d; color: #00ff9d; background: rgba(0,255,157,0.1);"><?php echo $success; ?></p>
            <?php endif; ?>
            <form action="register" method="post">
                <div class="form-group">
                    <label for="username">Usuário</label>
                    <input type="text" name="username" id="username" required minlength="3" maxlength="30">
                </div>
                <div class="form-group">
                    <label for="password">Senha</label>
                    <input type="password" name="password" id="password" required minlength="4">
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirmar Senha</label>
                    <input type="password" name="confirm_password" id="confirm_password" required>
                </div>
                <button type="submit">Cadastrar</button>
            </form>
            <p class="register-link">Já tem conta? <a href="login">Entrar</a></p>
        </div>
    </body>
</html>
