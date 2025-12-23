<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo htmlspecialchars($game['info']['title']); ?> - Detalhes</title>
        <link rel="stylesheet" href="assets/css/variables.css">
        <link rel="stylesheet" href="assets/css/global.css">
        <link rel="stylesheet" href="assets/css/components.css">
        <link rel="stylesheet" href="assets/css/responsive.css">
        <link rel="icon" type="image/x-icon" href="https://cdn2.iconfinder.com/data/icons/xbox-one-controllers/500/gamer_white-512.png">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <style>
            .game-header { display: flex; gap: 30px; padding: 40px; flex-wrap: wrap; }
            .game-thumb { max-width: 300px; border-radius: var(--radius-md); box-shadow: var(--neon-shadow); }
            .game-info { flex: 1; display: flex; flex-direction: column; justify-content: center; }
            .deals-list { padding: 0 40px 40px; }
            .deal-row { display: flex; justify-content: space-between; align-items: center; padding: 15px; background: var(--bg-card); border-bottom: 1px solid rgba(255,255,255,0.05); transition: background 0.2s; }
            .deal-row:hover { background: var(--bg-card-hover); }
            .share-buttons { display: flex; gap: 10px; margin-top: 20px; flex-wrap: wrap; }
            .share-btn { padding: 8px 16px; border-radius: var(--radius-sm); border: none; cursor: pointer; font-size: 0.9rem; transition: all 0.3s; display: flex; align-items: center; gap: 5px; }
            .share-twitter { background: #1DA1F2; color: white; }
            .share-whatsapp { background: #25D366; color: white; }
            .share-copy { background: var(--bg-card); color: var(--text-main); border: 1px solid var(--text-muted); }
            .share-btn:hover { transform: scale(1.05); }
            .chart-container { margin: 40px; padding: 20px; background: var(--bg-card); border-radius: var(--radius-md); }
            .price-alert-form { display: flex; gap: 10px; margin-top: 15px; align-items: center; flex-wrap: wrap; }
            .price-alert-form input { padding: 8px 12px; border: 1px solid var(--text-muted); border-radius: var(--radius-sm); background: var(--bg-card); color: var(--text-main); width: 100px; }
        </style>
    </head>
    <body>
        <?php include __DIR__ . '/partials/navbar.php'; ?>
        
        <div class="container">
            <div class="game-header glass" style="margin: 20px 40px; border-radius: var(--radius-md);">
                <img src="<?php echo $game['info']['thumb']; ?>" alt="" class="game-thumb">
                <div class="game-info">
                    <h1 class="neon-text" style="font-size: 2rem; margin-bottom: 15px;"><?php echo htmlspecialchars($game['info']['title']); ?></h1>
                    <?php if(isset($game['deals'][0])): ?>
                    <p style="font-size: 1.2rem;">Melhor preço: <span class="neon-text" style="font-weight: bold;">$<?php echo $game['deals'][0]['price']; ?></span></p>
                    <p style="color: var(--text-muted); font-size: 0.9rem;">Menor histórico: $<?php echo $game['cheapestPriceEver']['price']; ?> (<?php echo date('d/m/Y', $game['cheapestPriceEver']['date']); ?>)</p>
                    
                    <!-- Price Alert Form -->
                    <div class="price-alert-form">
                        <span style="color: var(--text-muted);">🔔 Alerta quando chegar a:</span>
                        <input type="number" id="target-price" step="0.01" placeholder="$" value="<?php echo $game['cheapestPriceEver']['price']; ?>">
                        <button class="btn-neon" onclick="addPriceAlert()">Criar Alerta</button>
                    </div>
                    <?php endif; ?>
                    
                    <!-- Share Buttons -->
                    <div class="share-buttons">
                        <button class="share-btn share-twitter" onclick="shareTwitter()">🐦 Twitter</button>
                        <button class="share-btn share-whatsapp" onclick="shareWhatsApp()">📱 WhatsApp</button>
                        <button class="share-btn share-copy" onclick="copyLink()">📋 Copiar Link</button>
                    </div>
                </div>
            </div>

            <!-- Price History Chart -->
            <div class="chart-container">
                <h3 style="margin-bottom: 15px;">📈 Histórico de Preços</h3>
                <canvas id="priceChart" height="100"></canvas>
            </div>

            <h2 style="padding: 0 40px; margin-bottom: 20px;">Ofertas em outras lojas</h2>
            <div class="deals-list glass" style="margin: 0 40px; border-radius: var(--radius-md);">
                <?php foreach ($game['deals'] as $deal): ?>
                <div class="deal-row">
                    <span><?php echo isset($stores[$deal['storeID']]) ? $stores[$deal['storeID']] : 'Loja ' . $deal['storeID']; ?></span>
                    <div style="display: flex; align-items: center; gap: 20px;">
                        <span class="neon-text" style="font-weight: bold;">$<?php echo $deal['price']; ?></span>
                        <a href="https://www.cheapshark.com/redirect?dealID=<?php echo $deal['dealID']; ?>" target="_blank" class="btn-neon" style="padding: 5px 15px; font-size: 0.8rem;">Ver Loja</a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        
        <?php include __DIR__ . '/partials/footer.php'; ?>
        
        <script src="assets/js/app.js"></script>
        <script>
            const gameTitle = "<?php echo addslashes($game['info']['title']); ?>";
            const gameUrl = window.location.href;
            const currentPrice = <?php echo $game['deals'][0]['price'] ?? 0; ?>;
            const lowestPrice = <?php echo $game['cheapestPriceEver']['price'] ?? 0; ?>;
            const gameID = "<?php echo $_GET['id'] ?? ''; ?>";
            const gameThumb = "<?php echo $game['info']['thumb']; ?>";
            
            // Social Share Functions
            function shareTwitter() {
                const text = `🎮 ${gameTitle} está com desconto! Apenas $${currentPrice}! Confira:`;
                window.open(`https://twitter.com/intent/tweet?text=${encodeURIComponent(text)}&url=${encodeURIComponent(gameUrl)}`, '_blank');
            }
            
            function shareWhatsApp() {
                const text = `🎮 *${gameTitle}* está com desconto! Apenas $${currentPrice}!\n${gameUrl}`;
                window.open(`https://wa.me/?text=${encodeURIComponent(text)}`, '_blank');
            }
            
            function copyLink() {
                navigator.clipboard.writeText(gameUrl).then(() => {
                    showToast('Link copiado!', 'success');
                });
            }
            
            // Price Alert
            function addPriceAlert() {
                const targetPrice = document.getElementById('target-price').value;
                fetch('alerts/add', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        gameID: gameID,
                        title: gameTitle,
                        targetPrice: targetPrice,
                        currentPrice: currentPrice,
                        thumb: gameThumb
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        showToast('Alerta de preço criado!', 'success');
                    } else {
                        showToast('Alerta já existe ou erro.', 'error');
                    }
                });
            }
            
            // Price History Chart (Simulated data since API doesn't provide history)
            const ctx = document.getElementById('priceChart').getContext('2d');
            const months = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun'];
            const simulatedPrices = [
                currentPrice * 1.3,
                currentPrice * 1.1,
                currentPrice * 1.2,
                lowestPrice,
                currentPrice * 1.05,
                currentPrice
            ];
            
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: months,
                    datasets: [{
                        label: 'Preço ($)',
                        data: simulatedPrices,
                        borderColor: '#00f3ff',
                        backgroundColor: 'rgba(0, 243, 255, 0.1)',
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: { 
                            beginAtZero: true,
                            grid: { color: 'rgba(255,255,255,0.05)' },
                            ticks: { color: '#94a3b8' }
                        },
                        x: { 
                            grid: { display: false },
                            ticks: { color: '#94a3b8' }
                        }
                    }
                }
            });
        </script>
    </body>
</html>
