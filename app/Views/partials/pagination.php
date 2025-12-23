<div class="pagination">
    <?php
        $queryParams = $_GET;
        unset($queryParams['page']);
        $baseUrl = '?' . http_build_query($queryParams);
        $baseUrl .= empty($queryParams) ? 'page=' : '&page=';
    ?>
    
    <?php if ($currentPage > 0): ?>
        <a href="<?php echo $baseUrl . ($currentPage - 1); ?>" class="btn-neon">← Anterior</a>
    <?php endif; ?>
    
    <span class="page-info">Página <?php echo $currentPage + 1; ?></span>
    
    <?php if (count($deals) >= 20): ?>
        <a href="<?php echo $baseUrl . ($currentPage + 1); ?>" class="btn-neon">Próxima →</a>
    <?php endif; ?>
</div>
