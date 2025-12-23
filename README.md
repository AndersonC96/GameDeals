# 🎮 GameDeals

<div align="center">

![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)
![PWA](https://img.shields.io/badge/PWA-5A0FC8?style=for-the-badge&logo=pwa&logoColor=white)

**Agregador de promoções de jogos com design Cyberpunk moderno**

[Demo](#-demo) • [Features](#-features) • [Instalação](#️-instalação) • [Uso](#-uso) • [Arquitetura](#️-arquitetura) • [API](#-api)

</div>

---

## 📋 Sobre o Projeto

O **GameDeals** é uma aplicação web que agrega e exibe promoções de jogos de diversas lojas digitais (Steam, GOG, Humble Bundle, etc.) utilizando a API do CheapShark. O projeto foi desenvolvido com foco em **UI/UX moderno** seguindo as tendências de 2025/2026, incluindo Glassmorphism, efeitos 3D e tema Cyberpunk.

### 🎯 Objetivo

Criar uma experiência completa de busca e acompanhamento de promoções de jogos, permitindo que usuários:
- Descubram as melhores ofertas do momento
- Salvem jogos favoritos em uma wishlist
- Recebam alertas quando um jogo atingir o preço desejado
- Compartilhem ofertas nas redes sociais

---

## ✨ Features

### Core
| Feature | Descrição |
|---------|-----------|
| 🔍 **Busca Inteligente** | Pesquise jogos por nome |
| 🏪 **Filtro por Loja** | Steam, GOG, Humble Bundle, Epic, etc. |
| 💰 **Filtro por Preço** | Defina preço máximo |
| 📊 **Ordenação** | Por melhor oferta, preço, desconto ou nome |
| ♾️ **Infinite Scroll** | Carregamento dinâmico ao rolar |

### Usuário
| Feature | Descrição |
|---------|-----------|
| 🔐 **Autenticação** | Login e registro de usuários |
| ❤️ **Wishlist** | Salve jogos favoritos |
| 🔔 **Alertas de Preço** | Notificação quando atingir preço alvo |
| 📈 **Histórico de Preços** | Gráfico com evolução de preços |

### Avançado
| Feature | Descrição |
|---------|-----------|
| 🌗 **Dark/Light Mode** | Alterne entre temas |
| 📱 **PWA** | Instale como aplicativo |
| ⚡ **Cache de API** | Respostas otimizadas com TTL |
| 📤 **Share Social** | Compartilhe no X e WhatsApp |
| 🛡️ **Admin Dashboard** | Gerencie usuários e estatísticas |

---

## 🖼️ Screenshots

<div align="center">

| Home | Detalhes do Jogo |
|------|------------------|
| Listagem de ofertas com cards 3D | Gráfico de preços e compartilhamento |

| Admin Dashboard | Login |
|-----------------|-------|
| Estatísticas e gerenciamento | Design Cyberpunk com glassmorphism |

</div>

---

## 🛠️ Tecnologias

### Backend
- **PHP 8.x** - Linguagem principal
- **MySQL** - Banco de dados relacional
- **MVC Custom** - Arquitetura própria sem framework

### Frontend
- **CSS3** - Glassmorphism, gradientes, animações
- **JavaScript ES6** - Vanilla JS, Chart.js
- **Bootstrap Icons** - Ícones vetoriais
- **VanillaTilt.js** - Efeito 3D nos cards

### Serviços
- **CheapShark API** - Dados de promoções
- **Service Worker** - Funcionalidade offline (PWA)

---

## ⚙️ Instalação

### Pré-requisitos
- [XAMPP](https://www.apachefriends.org/) (Apache + MySQL + PHP)
- PHP 8.0 ou superior
- Composer (opcional, para testes)

### Passo a Passo

1. **Clone o repositório**
```bash
cd C:\xampp\htdocs
git clone https://github.com/AndersonC96/GameDeals.git
```

2. **Inicie o XAMPP**
   - Abra o XAMPP Control Panel
   - Inicie **Apache** e **MySQL**

3. **Configure o banco de dados**
```
Acesse: http://localhost/GameDeals/init_db.php
```

4. **Acesse a aplicação**
```
URL: http://localhost/GameDeals/
```

### Usuários de Teste

| Usuário | Senha | Permissão |
|---------|-------|-----------|
| `gamer` | `123` | Usuário normal |
| `admin` | `admin123` | Administrador |

---

## 📁 Arquitetura

```
GameDeals/
├── app/
│   ├── Controllers/           # Lógica de controle
│   │   ├── AdminController.php
│   │   ├── AlertController.php
│   │   ├── AuthController.php
│   │   ├── GameController.php
│   │   ├── HomeController.php
│   │   └── WishlistController.php
│   │
│   ├── Core/                  # Classes base
│   │   ├── Controller.php
│   │   ├── Database.php
│   │   └── Router.php
│   │
│   ├── Models/                # Camada de dados
│   │   ├── PriceAlert.php
│   │   ├── User.php
│   │   └── Wishlist.php
│   │
│   ├── Services/              # Serviços externos
│   │   ├── CacheService.php
│   │   └── CheapSharkService.php
│   │
│   └── Views/                 # Templates
│       ├── admin/
│       ├── partials/
│       └── *.php
│
├── public/                    # Arquivos públicos
│   ├── assets/
│   │   ├── css/
│   │   └── js/
│   ├── index.php             # Entry point
│   ├── manifest.json         # PWA manifest
│   └── sw.js                 # Service Worker
│
├── cache/                     # Cache de API
├── tests/                     # Testes PHPUnit
├── composer.json
└── init_db.php               # Setup do banco
```

---

## 🔌 API

O projeto utiliza a [CheapShark API](https://apidocs.cheapshark.com/) para obter dados de promoções.

### Endpoints Utilizados

| Endpoint | Descrição |
|----------|-----------|
| `/deals` | Lista de promoções com filtros |
| `/stores` | Lista de lojas disponíveis |
| `/games?id=X` | Detalhes de um jogo específico |

### Cache Strategy

| Endpoint | TTL |
|----------|-----|
| Deals | 3 minutos |
| Stores | 1 hora |
| Game Details | 10 minutos |

---

## 🧪 Testes

```bash
# Instalar dependências de dev
composer install

# Executar testes
composer test
```

---

## 🎨 Design System

### Cores

| Variável | Valor | Uso |
|----------|-------|-----|
| `--primary-neon` | `#00f3ff` | Destaques, links |
| `--secondary-neon` | `#ff0055` | Alertas, CTAs |
| `--accent-green` | `#00ff9d` | Sucesso, preços |
| `--bg-dark` | `#09090b` | Fundo principal |

### Tipografia

- **Headings**: Chakra Petch (Google Fonts)
- **Body**: Inter (Google Fonts)

---

## 📝 Roadmap

- [x] Arquitetura MVC
- [x] Design Cyberpunk/Glassmorphism
- [x] Autenticação de usuários
- [x] Wishlist
- [x] Alertas de preço
- [x] PWA
- [x] Admin Dashboard
- [x] Compartilhamento social
- [ ] Notificações push
- [ ] Integração com mais APIs
- [ ] Sistema de reviews

---

## 🤝 Contribuindo

1. Fork o projeto
2. Crie uma branch (`git checkout -b feature/NovaFeature`)
3. Commit suas mudanças (`git commit -m 'Add: nova feature'`)
4. Push para a branch (`git push origin feature/NovaFeature`)
5. Abra um Pull Request

---

## 📄 Licença

Este projeto está sob a licença MIT. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.

---

## 👤 Autor

**Anderson Cavalcante**

[![GitHub](https://img.shields.io/badge/GitHub-100000?style=for-the-badge&logo=github&logoColor=white)](https://github.com/AndersonC96)
[![LinkedIn](https://img.shields.io/badge/LinkedIn-0077B5?style=for-the-badge&logo=linkedin&logoColor=white)](https://linkedin.com/in/andersoncavalcante96)

---

<div align="center">

**⭐ Se este projeto te ajudou, deixe uma estrela!**

</div>