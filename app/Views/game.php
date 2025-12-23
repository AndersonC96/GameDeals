<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title><?php echo htmlspecialchars($game['info']['title']); ?> - Detalhes</title>
        <link rel="stylesheet" href="assets/css/variables.css">
        <link rel="stylesheet" href="assets/css/global.css">
        <link rel="stylesheet" href="assets/css/components.css">
        <link rel="icon" type="image/x-icon" href="https://cdn2.iconfinder.com/data/icons/xbox-one-controllers/500/gamer_white-512.png">
        <style>
            .game-header {
                display: flex;
                gap: 30px;
                padding: 40px;
                flex-wrap: wrap;
            }
            .game-thumb {
                max-width: 300px;
                border-radius: var(--radius-md);
                box-shadow: var(--neon-shadow);
            }
            .game-info {
                flex: 1;
                display: flex;
                flex-direction: column;
                justify-content: center;
            }
            .deals-list {
                padding: 0 40px 40px;
            }
            .deal-row {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 15px;
                background: var(--bg-card);
                border-bottom: 1px solid rgba(255,255,255,0.05);
                transition: background 0.2s;
            }
            .deal-row:hover {
                background: var(--bg-card-hover);
            }
        </style>
    </head>
    <body>
        <?php include __DIR__ . '/partials/navbar.php'; ?>
        
        <div class="container">
            <div class="game-header">
                <img src="<?php echo $game['info']['thumb']; ?>" alt="" class="game-thumb">
                <div class="game-info">
                    <h1 class="neon-text" style="font-size: 2.5rem; margin-bottom: 20px;"><?php echo htmlspecialchars($game['info']['title']); ?></h1>
                    <?php if(isset($game['deals'][0])): ?>
                    <p style="font-size: 1.2rem;">Melhor preço atual: <span class="neon-text" style="font-weight: bold;">$<?php echo $game['deals'][0]['price']; ?></span></p>
                    <p style="color: var(--text-muted);">Menor preço histórico: $<?php echo $game['cheapestPriceEver']['price']; ?> (em <?php echo date('d/m/Y', $game['cheapestPriceEver']['date']); ?>)</p>
                    <?php endif; ?>
                </div>
            </div>

            <h2 style="padding: 0 40px; margin-bottom: 20px;">Ofertas em outras lojas</h2>
            <div class="deals-list glass" style="margin: 0 40px;">
                <?php foreach ($game['deals'] as $deal): ?>
                <div class="deal-row">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <span><?php echo isset($stores[$deal['storeID']]) ? $stores[$deal['storeID']] : 'Loja ' . $deal['storeID']; ?></span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 20px;">
                        <span class="neon-text" style="font-weight: bold; font-size: 1.1rem;">$<?php echo $deal['price']; ?></span>
                        <a href="https://www.cheapshark.com/redirect?dealID=<?php echo $deal['dealID']; ?>" target="_blank" class="btn-neon" style="padding: 5px 15px; font-size: 0.8rem;">Ver Loja</a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <script src="assets/js/app.js"></script>
    </body>
</html>
