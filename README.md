# 🎮 GameDeals

Um agregador de promoções de jogos com design Cyberpunk moderno, construído com PHP MVC.

![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?logo=php)
![MySQL](https://img.shields.io/badge/MySQL-Database-4479A1?logo=mysql)
![License](https://img.shields.io/badge/License-MIT-green)

## ✨ Features

- **Busca e Filtros**: Encontre jogos por nome, loja, preço máximo
- **Ordenação**: Por melhor oferta, menor preço, maior desconto, nome
- **Paginação**: Navegue por centenas de ofertas
- **Lista de Desejos**: Salve jogos favoritos (requer login)
- **Detalhes do Jogo**: Compare preços entre lojas, veja histórico
- **Autenticação**: Login/Registro de usuários

## 🚀 Tecnologias

| Frontend | Backend | API |
|----------|---------|-----|
| CSS3 (Glassmorphism) | PHP 8.x | [CheapShark API](https://apidocs.cheapshark.com/) |
| Vanilla JS | MySQL | |
| Vanilla Tilt.js | MVC Custom | |

## 📁 Estrutura

```
GameDeals/
├── app/
│   ├── Controllers/    # HomeController, AuthController, etc.
│   ├── Core/           # Router, Database, Controller base
│   ├── Models/         # User, Wishlist
│   ├── Services/       # CheapSharkService (API)
│   └── Views/          # Templates PHP + Partials
├── public/
│   ├── assets/         # CSS, JS, Images
│   └── index.php       # Entry point
└── init_db.php         # Script de inicialização do DB
```

## ⚙️ Instalação

1. Clone o repositório para `htdocs`:
   ```bash
   git clone https://github.com/seu-usuario/GameDeals.git
   ```

2. Inicie Apache e MySQL no XAMPP

3. Acesse `http://localhost/GameDeals/init_db.php` para criar o banco

4. Acesse `http://localhost/GameDeals/public/`

5. Login padrão: `gamer` / `123`

## 🎨 Design

- **Tema**: Cyberpunk/Gamer com cores Neon
- **Efeitos**: Glassmorphism, 3D Tilt, Gradientes
- **Responsivo**: Mobile-first com Bottom Navigation

## 📄 Licença

MIT License - Projeto de Portfólio