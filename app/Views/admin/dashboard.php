<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - GameDeals</title>
    <link rel="stylesheet" href="../assets/css/variables.css">
    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/components.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">
    <link rel="icon" type="image/x-icon" href="https://cdn2.iconfinder.com/data/icons/xbox-one-controllers/500/gamer_white-512.png">
    <style>
        .admin-container { max-width: 1200px; margin: 0 auto; padding: 30px; }
        .admin-header { margin-bottom: 30px; }
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 40px; }
        .stat-card { background: var(--bg-card); border: var(--glass-border); border-radius: var(--radius-md); padding: 25px; text-align: center; }
        .stat-value { font-size: 2.5rem; font-weight: 700; color: var(--primary-neon); font-family: var(--font-heading); }
        .stat-label { color: var(--text-muted); margin-top: 5px; }
        .admin-nav { display: flex; gap: 15px; margin-bottom: 30px; }
        .admin-nav a { color: var(--text-muted); padding: 10px 20px; border-radius: var(--radius-sm); transition: all 0.3s; }
        .admin-nav a:hover, .admin-nav a.active { background: var(--bg-card); color: var(--primary-neon); }
        .users-table { width: 100%; border-collapse: collapse; }
        .users-table th, .users-table td { padding: 15px; text-align: left; border-bottom: 1px solid rgba(255,255,255,0.05); }
        .users-table th { color: var(--text-muted); font-weight: 400; }
    </style>
</head>
<body>
    <div class="admin-container">
        <div class="admin-header">
            <h1 class="neon-text">🛡️ Admin Dashboard</h1>
            <p style="color: var(--text-muted);">Gerencie usuários e visualize estatísticas</p>
        </div>
        
        <nav class="admin-nav">
            <a href="admin" class="active">Dashboard</a>
            <a href="admin/users">Usuários</a>
            <a href="/">← Voltar ao Site</a>
        </nav>
        
        <div class="stats-grid">
            <div class="stat-card glass">
                <div class="stat-value"><?php echo $stats['total_users']; ?></div>
                <div class="stat-label">Usuários</div>
            </div>
            <div class="stat-card glass">
                <div class="stat-value"><?php echo $stats['total_wishlist']; ?></div>
                <div class="stat-label">Itens na Wishlist</div>
            </div>
            <div class="stat-card glass">
                <div class="stat-value"><?php echo $stats['total_alerts']; ?></div>
                <div class="stat-label">Alertas de Preço</div>
            </div>
        </div>
        
        <h2 style="margin-bottom: 20px;">Usuários Recentes</h2>
        <div class="glass" style="border-radius: var(--radius-md); overflow: hidden;">
            <table class="users-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuário</th>
                        <th>Data de Criação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recentUsers as $user): ?>
                    <tr>
                        <td><?php echo $user['id']; ?></td>
                        <td><?php echo htmlspecialchars($user['username']); ?></td>
                        <td><?php echo $user['created_at'] ?? 'N/A'; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <script src="../assets/js/app.js"></script>
</body>
</html>
