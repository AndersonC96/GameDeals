<div class="game-card glass" data-tilt>
    <div class="card-image">
        <a href="game?id=<?php echo $deal['gameID']; ?>">
            <img src="<?php echo $deal['thumb']; ?>" alt="<?php echo htmlspecialchars($deal['title'], ENT_QUOTES, 'UTF-8'); ?>">
        </a>
        <div class="savings-tag">-<?php echo round(100 - ($deal['salePrice'] / $deal['normalPrice'] * 100)); ?>%</div>
    </div>
    <div class="card-content">
        <h3 class="game-title">
            <a href="game?id=<?php echo $deal['gameID']; ?>" style="text-decoration: none; color: inherit;">
                <?php echo htmlspecialchars($deal['title'], ENT_QUOTES, 'UTF-8'); ?>
            </a>
        </h3>
        
        <div class="price-info">
            <span class="normal-price">$<?php echo $deal['normalPrice']; ?></span>
            <span class="sale-price neon-text">$<?php echo $deal['salePrice']; ?></span>
        </div>
        
        <div class="meta-info">
            <span class="store-name">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                <?php echo isset($stores[$deal['storeID']]) ? $stores[$deal['storeID']] : 'Check Deal'; ?>
            </span>
        </div>
        
        <div class="actions" style="display: flex; gap: 10px;">
            <a href="https://www.cheapshark.com/redirect?dealID=<?php echo $deal['dealID']; ?>" target="_blank" class="btn-view" style="flex: 1;">Ver Oferta</a>
            <button class="btn-neon" style="padding: 8px;" onclick="addToWishlist('<?php echo $deal['gameID']; ?>', '<?php echo addslashes(htmlspecialchars($deal['title'], ENT_QUOTES, 'UTF-8')); ?>', '<?php echo $deal['salePrice']; ?>', '<?php echo $deal['normalPrice']; ?>', '<?php echo $deal['thumb']; ?>', '<?php echo $deal['storeID']; ?>')">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
            </button>
        </div>
    </div>
</div>
