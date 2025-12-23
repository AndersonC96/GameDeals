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
