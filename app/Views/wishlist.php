<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Minha Lista de Desejos - GameDeals</title>
        <link rel="stylesheet" href="assets/css/variables.css">
        <link rel="stylesheet" href="assets/css/global.css">
        <link rel="stylesheet" href="assets/css/components.css">
        <link rel="icon" type="image/x-icon" href="https://cdn2.iconfinder.com/data/icons/xbox-one-controllers/500/gamer_white-512.png">
    </head>
    <body>
        <?php include __DIR__ . '/partials/navbar.php'; ?>
        
        <div class="container" style="padding: 20px;">
            <h2 class="neon-text" style="text-align: center; margin-bottom: 20px; font-family: var(--font-heading);">Minha Lista de Desejos</h2>
            
            <div class="deals-container">
                <?php if (empty($deals)): ?>
                    <p style="color: white; text-align: center; width: 100%;">Sua lista está vazia.</p>
                <?php else: ?>
                    <?php foreach ($deals as $deal): ?>
                        <div class="game-card glass" data-tilt>
                            <div class="card-image">
                                <img src="<?php echo $deal['thumb']; ?>" alt="<?php echo htmlspecialchars($deal['title'], ENT_QUOTES, 'UTF-8'); ?>">
                            </div>
                            <div class="card-content">
                                <h3 class="game-title"><?php echo htmlspecialchars($deal['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
                                
                                <div class="price-info">
                                    <span class="normal-price">$<?php echo $deal['normal_price']; ?></span>
                                    <span class="sale-price neon-text">$<?php echo $deal['sale_price']; ?></span>
                                </div>
                                
                                <div class="meta-info">
                                    <span class="store-name">
                                        <?php echo isset($stores[$deal['store_id']]) ? $stores[$deal['store_id']] : 'Loja ' . $deal['store_id']; ?>
                                    </span>
                                </div>
                                
                                <button onclick="removeFromWishlist('<?php echo $deal['game_id']; ?>')" class="btn-neon" style="width: 100%; margin-top: 10px; font-size: 0.8rem;">Remover</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        <script src="assets/js/app.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-tilt/1.7.0/vanilla-tilt.min.js"></script>
        <script>
            VanillaTilt.init(document.querySelectorAll(".game-card"), {
                max: 15,
                speed: 400,
                glare: true,
                "max-glare": 0.2,
                scale: 1.05
            });
        </script>
    </body>
</html>
