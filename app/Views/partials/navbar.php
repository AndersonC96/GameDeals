<nav class="navbar glass">
    <div class="nav-brand">
        <a href="/" style="display: flex; align-items: center; gap: 10px; text-decoration: none;">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--primary-neon)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="6" y1="12" x2="18" y2="12"></line>
                <path d="M6 12l4-4"></path>
                <path d="M6 12l4 4"></path>
                <rect x="2" y="6" width="20" height="12" rx="2"></rect>
            </svg>
            <span class="neon-text">GameDeals</span>
        </a>
    </div>

    <form action="" method="get" class="search-form">
        <div class="search-wrapper">
            <input type="text" name="search" placeholder="Buscar jogo..." value="<?php echo htmlspecialchars($searchTerm ?? ''); ?>">
            <button type="submit" class="btn-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
            </button>
        </div>
        
        <select name="store">
            <option value="">Todas lojas</option>
            <?php if (isset($stores)): foreach ($stores as $storeID => $storeName): ?>
            <option value="<?php echo $storeID; ?>" <?php echo (isset($storeFilter) && $storeFilter == $storeID) ? 'selected' : ''; ?>>
                <?php echo htmlspecialchars($storeName); ?>
            </option>
            <?php endforeach; endif; ?>
        </select>
        
        <select name="price">
            <option value="">Preço máx</option>
            <option value="10" <?php echo (isset($priceFilter) && $priceFilter == '10') ? 'selected' : ''; ?>>Até $10</option>
            <option value="20" <?php echo (isset($priceFilter) && $priceFilter == '20') ? 'selected' : ''; ?>>Até $20</option>
            <option value="30" <?php echo (isset($priceFilter) && $priceFilter == '30') ? 'selected' : ''; ?>>Até $30</option>
            <option value="50" <?php echo (isset($priceFilter) && $priceFilter == '50') ? 'selected' : ''; ?>>Até $50</option>
        </select>
        
        <select name="sort">
            <option value="Deal Rating" <?php echo (isset($sortBy) && $sortBy == 'Deal Rating') ? 'selected' : ''; ?>>Melhor Oferta</option>
            <option value="Price" <?php echo (isset($sortBy) && $sortBy == 'Price') ? 'selected' : ''; ?>>Menor Preço</option>
            <option value="Savings" <?php echo (isset($sortBy) && $sortBy == 'Savings') ? 'selected' : ''; ?>>Maior Desconto</option>
            <option value="Title" <?php echo (isset($sortBy) && $sortBy == 'Title') ? 'selected' : ''; ?>>Nome A-Z</option>
        </select>
    </form>
    
    <div class="nav-links">
        <button onclick="toggleTheme()" class="btn-icon theme-toggle" title="Alternar tema">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line></svg>
        </button>
        <a href="alerts" class="nav-item" title="Alertas de Preço">🔔</a>
        <a href="wishlist" class="nav-item">Wishlist</a>
        <a href="logout" class="btn-neon">Sair</a>
    </div>
</nav>
