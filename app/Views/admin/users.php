<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Usuários - GameDeals</title>
    <link rel="stylesheet" href="../assets/css/variables.css">
    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/components.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">
    <link rel="icon" type="image/x-icon" href="https://cdn2.iconfinder.com/data/icons/xbox-one-controllers/500/gamer_white-512.png">
    <style>
        .admin-container { max-width: 1200px; margin: 0 auto; padding: 30px; }
        .admin-header { margin-bottom: 30px; }
        .admin-nav { display: flex; gap: 15px; margin-bottom: 30px; }
        .admin-nav a { color: var(--text-muted); padding: 10px 20px; border-radius: var(--radius-sm); transition: all 0.3s; }
        .admin-nav a:hover, .admin-nav a.active { background: var(--bg-card); color: var(--primary-neon); }
        .users-table { width: 100%; border-collapse: collapse; }
        .users-table th, .users-table td { padding: 15px; text-align: left; border-bottom: 1px solid rgba(255,255,255,0.05); }
        .users-table th { color: var(--text-muted); font-weight: 400; }
        .btn-danger { background: transparent; border: 1px solid var(--secondary-neon); color: var(--secondary-neon); padding: 6px 12px; border-radius: var(--radius-sm); cursor: pointer; transition: all 0.3s; }
        .btn-danger:hover { background: var(--secondary-neon); color: #000; }
    </style>
</head>
<body>
    <div class="admin-container">
        <div class="admin-header">
            <h1 class="neon-text">👥 Gerenciar Usuários</h1>
        </div>
        
        <nav class="admin-nav">
            <a href="admin">Dashboard</a>
            <a href="admin/users" class="active">Usuários</a>
            <a href="/">← Voltar ao Site</a>
        </nav>
        
        <div class="glass" style="border-radius: var(--radius-md); overflow: hidden;">
            <table class="users-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuário</th>
                        <th>Data de Criação</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                    <tr id="user-<?php echo $user['id']; ?>">
                        <td><?php echo $user['id']; ?></td>
                        <td><?php echo htmlspecialchars($user['username']); ?></td>
                        <td><?php echo $user['created_at'] ?? 'N/A'; ?></td>
                        <td>
                            <?php if ($user['id'] != $_SESSION['id']): ?>
                            <button class="btn-danger" onclick="deleteUser(<?php echo $user['id']; ?>)">Excluir</button>
                            <?php else: ?>
                            <span style="color: var(--text-muted);">Você</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <?php include dirname(__DIR__) . '/partials/footer.php'; ?>
    
    <script src="../assets/js/app.js"></script>
    <script>
        function deleteUser(userId) {
            if (!confirm('Tem certeza que deseja excluir este usuário?')) return;
            
            fetch('admin/delete-user', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ userId: userId })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('user-' + userId).remove();
                    showToast('Usuário excluído!', 'success');
                } else {
                    showToast('Erro ao excluir.', 'error');
                }
            });
        }
    </script>
</body>
</html>
