// Toast Notification System
function showToast(message, type = 'info') {
    const container = document.getElementById('toast-container');
    if (!container) return;

    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
    toast.textContent = message;
    container.appendChild(toast);

    setTimeout(() => {
        toast.remove();
    }, 3000);
}

// Wishlist Functions
function addToWishlist(gameID, title, salePrice, normalPrice, thumb, storeID) {
    const data = {
        gameID: gameID,
        title: title,
        salePrice: salePrice,
        normalPrice: normalPrice,
        thumb: thumb,
        storeID: storeID
    };

    fetch('wishlist/add', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showToast('Jogo adicionado à lista de desejos!', 'success');
            } else {
                showToast('Jogo já está na lista ou erro ao adicionar.', 'error');
            }
        })
        .catch((error) => {
            console.error('Error:', error);
            showToast('Erro ao adicionar à lista.', 'error');
        });
}

function removeFromWishlist(gameID) {
    if (!confirm('Remover este jogo da lista?')) return;

    fetch('wishlist/remove', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ gameID: gameID }),
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showToast('Jogo removido da lista.', 'success');
                setTimeout(() => location.reload(), 500);
            } else {
                showToast('Erro ao remover da lista.', 'error');
            }
        })
        .catch((error) => {
            console.error('Error:', error);
        });
}

// ==========================================
// INFINITE SCROLL
// ==========================================
let currentPage = 0;
let isLoading = false;
let hasMorePages = true;

function initInfiniteScroll() {
    const container = document.querySelector('.deals-container');
    if (!container) return;

    window.addEventListener('scroll', () => {
        if (isLoading || !hasMorePages) return;

        const scrollY = window.scrollY;
        const windowHeight = window.innerHeight;
        const documentHeight = document.documentElement.scrollHeight;

        // Load more when 200px from bottom
        if (scrollY + windowHeight >= documentHeight - 200) {
            loadMoreDeals();
        }
    });
}

function loadMoreDeals() {
    if (isLoading || !hasMorePages) return;
    isLoading = true;

    currentPage++;
    const params = new URLSearchParams(window.location.search);
    params.set('page', currentPage);
    params.set('ajax', '1');

    // Show loading indicator
    const loader = document.getElementById('scroll-loader');
    if (loader) loader.style.display = 'flex';

    fetch('?' + params.toString())
        .then(response => response.text())
        .then(html => {
            const container = document.querySelector('.deals-container');
            if (html.trim() === '' || html.includes('[]')) {
                hasMorePages = false;
                if (loader) loader.innerHTML = '<p style="color: var(--text-muted);">Fim das ofertas</p>';
            } else {
                container.insertAdjacentHTML('beforeend', html);
                // Reinitialize tilt on new cards
                if (typeof VanillaTilt !== 'undefined') {
                    VanillaTilt.init(container.querySelectorAll(".game-card:not([data-tilt-init])"), {
                        max: 15,
                        speed: 400,
                        glare: true,
                        "max-glare": 0.2,
                        scale: 1.05
                    });
                }
            }
            isLoading = false;
            if (loader && hasMorePages) loader.style.display = 'none';
        })
        .catch(error => {
            console.error('Error loading more:', error);
            isLoading = false;
        });
}

// ==========================================
// THEME TOGGLE (Dark/Light)
// ==========================================
function initThemeToggle() {
    const savedTheme = localStorage.getItem('theme') || 'dark';
    document.documentElement.setAttribute('data-theme', savedTheme);
}

function toggleTheme() {
    const currentTheme = document.documentElement.getAttribute('data-theme');
    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';

    document.documentElement.setAttribute('data-theme', newTheme);
    localStorage.setItem('theme', newTheme);

    showToast(`Tema alterado para ${newTheme === 'dark' ? 'Escuro' : 'Claro'}`, 'info');
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', () => {
    initThemeToggle();
    initInfiniteScroll();
});
