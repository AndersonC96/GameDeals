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
            alert('Jogo adicionado à lista de desejos!');
        } else {
            // Check if it's because of auth (redirect?) or duplicate
            // Simple alert for now
            alert('Não foi possível adicionar. Verifique se já está na lista ou faça login.');
        }
    })
    .catch((error) => {
        console.error('Error:', error);
        alert('Erro ao adicionar à lista.');
    });
}

function removeFromWishlist(gameID) {
    if(!confirm('Remover este jogo da lista?')) return;

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
            location.reload();
        } else {
            alert('Erro ao remover da lista.');
        }
    })
    .catch((error) => {
        console.error('Error:', error);
    });
}
