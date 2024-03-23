<?php
    session_start();
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true){
        header('Location: login.php');
        exit;
    }
    require 'config.php';
    require 'api/cheapshark_api.php';
    $deals = array();
    $searchTerm = '';
    $storeFilter = '';
    $priceFilter = '';
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
        $storeFilter = isset($_GET['store']) ? $_GET['store'] : '';
        $priceFilter = isset($_GET['price']) ? $_GET['price'] : '';
    }
    $deals = buscarPromocoes($searchTerm, $storeFilter, $priceFilter);
    $stores = getStores();
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Promoções de Jogos</title>
        <link rel="stylesheet" href="./CSS/index.css">
        <link rel="icon" type="image/x-icon" href="https://cdn2.iconfinder.com/data/icons/xbox-one-controllers/500/gamer_white-512.png">
    </head>
    <body>
        <nav class="navbar">
            <form action="index.php" method="get" class="search-form">
                <input type="text" name="search" placeholder="Buscar jogo..." value="<?php echo $searchTerm; ?>">
                <select name="store">
                    <option value="">Todas as lojas</option>
                    <?php foreach ($stores as $storeID => $storeName): ?>
                    <option value="<?php echo $storeID; ?>"><?php echo $storeName; ?></option>
                    <?php endforeach; ?>
                </select>
                <select name="price">
                    <option value="">Qualquer preço</option>
                    <!-- Opções de faixa de preço aqui -->
                </select>
                <button type="submit">Buscar</button>
            </form>
        </nav>
        <div class="deals-container">
            <?php foreach ($deals as $deal): ?>
            <div class="deal">
                <img src="<?php echo $deal['thumb']; ?>" alt="<?php echo htmlspecialchars($deal['title'], ENT_QUOTES, 'UTF-8'); ?>">
                <p><b><?php echo htmlspecialchars($deal['title'], ENT_QUOTES, 'UTF-8'); ?></b></p>
                <p><b>Preço</b>: $ <?php echo $deal['normalPrice']; ?></p>
                <p><b>Preço promocional</b>: $ <?php echo $deal['salePrice']; ?></p>
                <p><b>Loja</b>: <?php echo $stores[$deal['storeID']]; ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </body>
</html>