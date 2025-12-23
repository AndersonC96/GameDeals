<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Promoções de Jogos - GameDeals</title>
        <link rel="stylesheet" href="assets/css/variables.css">
        <link rel="stylesheet" href="assets/css/global.css">
        <link rel="stylesheet" href="assets/css/components.css">
        <link rel="stylesheet" href="assets/css/responsive.css">
        <link rel="icon" type="image/x-icon" href="https://cdn2.iconfinder.com/data/icons/xbox-one-controllers/500/gamer_white-512.png">
    </head>
    <body>
        <?php include __DIR__ . '/partials/navbar.php'; ?>
        
        <div class="deals-container">
            <?php if (empty($deals)): ?>
                <p style="color: white; text-align: center; width: 100%;">Nenhuma promoção encontrada.</p>
            <?php else: ?>
                <?php foreach ($deals as $deal): ?>
                    <?php include __DIR__ . '/partials/game_card.php'; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        
        <?php include __DIR__ . '/partials/pagination.php'; ?>
        
        <?php include __DIR__ . '/partials/footer.php'; ?>
        
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
