# 🎮 GameDeals

Agregador de promoções de jogos com design **Cyberpunk** moderno e arquitetura **PHP MVC**.

![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?logo=php)
![MySQL](https://img.shields.io/badge/MySQL-Database-4479A1?logo=mysql)
![PWA](https://img.shields.io/badge/PWA-Enabled-5A0FC8?logo=pwa)
![PHPUnit](https://img.shields.io/badge/PHPUnit-Tests-4AA94A)

## ✨ Features

### Core
- 🔍 Busca e Filtros (loja, preço, ordenação)
- ♾️ Infinite Scroll
- ❤️ Lista de Desejos
- 🔔 Alertas de Preço
- 📊 Histórico de Preços (Chart.js)

### Avançadas
- 🌗 Dark/Light Mode
- 📱 PWA (instalável)
- ⚡ Cache de API
- � Compartilhamento Social (Twitter, WhatsApp)
- 🛡️ Dashboard Admin

## 📁 Estrutura

```
GameDeals/
├── app/
│   ├── Controllers/ (6)  → Home, Auth, Game, Wishlist, Alert, Admin
│   ├── Models/ (3)       → User, Wishlist, PriceAlert
│   ├── Services/ (2)     → CheapSharkService, CacheService
│   └── Views/ (12)       → Páginas + Partials + Admin
├── public/
│   ├── manifest.json     → PWA
│   └── sw.js             → Service Worker
├── tests/                → PHPUnit Tests
└── composer.json
```

## ⚙️ Instalação

```bash
# Clone
git clone https://github.com/seu-usuario/GameDeals.git

# Inicie Apache + MySQL no XAMPP

# Inicialize o banco
http://localhost/GameDeals/init_db.php

# Acesse
http://localhost/GameDeals/
```

### Usuários de Teste
| User | Pass | Role |
|------|------|------|
| gamer | 123 | Normal |
| admin | admin123 | Admin |

## 🧪 Testes

```bash
composer install
composer test
```

## 📄 Licença

MIT - Projeto de Portfólio