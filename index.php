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
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Promoções de Jogos</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <div class="search-container">
            <form action="index.php" method="get">
                <input type="text" name="search" placeholder="Buscar jogo..." value="<?php echo $searchTerm; ?>">
                <select name="store">
                    <option value="">Todas as lojas</option>
                </select>
                <select name="price">
                    <option value="">Qualquer preço</option>
                </select>
                <button type="submit">Buscar</button>
            </form>
        </div>
        <div class="deals-container">
            <?php if (empty($deals)): ?>
                <p>Nenhuma promoção encontrada.</p>
            <?php else: ?>
            <?php foreach ($deals as $deal): ?>
            <div class="deal">
                <p><?php echo $deal['title']; ?></p>
                <p>Preço: <?php echo $deal['salePrice']; ?></p>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </body>
</html>