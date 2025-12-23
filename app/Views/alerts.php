<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Alertas de Preço - GameDeals</title>
        <link rel="stylesheet" href="assets/css/variables.css">
        <link rel="stylesheet" href="assets/css/global.css">
        <link rel="stylesheet" href="assets/css/components.css">
        <link rel="stylesheet" href="assets/css/responsive.css">
        <link rel="icon" type="image/x-icon" href="https://cdn2.iconfinder.com/data/icons/xbox-one-controllers/500/gamer_white-512.png">
    </head>
    <body>
        <?php include __DIR__ . '/partials/navbar.php'; ?>
        
        <div class="page-header">
            <h1 class="neon-text">🔔 Alertas de Preço</h1>
            <p style="color: var(--text-muted);">Seja notificado quando seus jogos atingirem o preço desejado.</p>
        </div>
        
        <div class="deals-container">
            <?php if (empty($alerts)): ?>
                <p style="color: white; text-align: center; width: 100%;">
                    Nenhum alerta configurado.<br>
                    <small style="color: var(--text-muted);">Adicione alertas de preço nos detalhes de cada jogo.</small>
                </p>
            <?php else: ?>
                <?php foreach ($alerts as $alert): ?>
                    <div class="game-card glass" data-tilt>
                        <div class="card-image">
                            <img src="<?php echo htmlspecialchars($alert['thumb']); ?>" alt="<?php echo htmlspecialchars($alert['title']); ?>">
                        </div>
                        <div class="card-content">
                            <h3 class="game-title"><?php echo htmlspecialchars($alert['title']); ?></h3>
                            <div class="price-info">
                                <span class="target-price" style="color: var(--accent-green);">
                                    Alvo: $<?php echo number_format($alert['target_price'], 2); ?>
                                </span>
                                <span class="current-price" style="color: var(--text-muted);">
                                    Atual: $<?php echo number_format($alert['current_price'], 2); ?>
                                </span>
                            </div>
                            <div class="actions">
                                <button class="btn-neon" onclick="removeAlert('<?php echo $alert['game_id']; ?>')">
                                    Remover Alerta
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        
        <?php include __DIR__ . '/partials/footer.php'; ?>
        
        <script src="assets/js/app.js"></script>
        <script>
            function removeAlert(gameID) {
                if(!confirm('Remover este alerta?')) return;
                
                fetch('alerts/remove', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ gameID: gameID }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showToast('Alerta removido.', 'success');
                        setTimeout(() => location.reload(), 500);
                    }
                });
            }
        </script>
    </body>
</html>
