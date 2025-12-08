<div align="center">

<img width="540" height="120" alt="wownator" src="https://github.com/user-attachments/assets/b30a31c5-e0ed-4ff3-92d0-fbdec1f96bed" />

### Jogo de Adivinhação de World of Warcraft

[![Laravel](https://img.shields.io/badge/Laravel-11-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://mysql.com)
[![TailwindCSS](https://img.shields.io/badge/Tailwind-CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![Vite](https://img.shields.io/badge/Vite-646CFF?style=for-the-badge&logo=vite&logoColor=white)](https://vitejs.dev)

*Teste seu conhecimento sobre o universo de Azeroth!*

[🚀 Instalação](#-instalação) • [📖 Documentação](#-estrutura-do-projeto) • [🤝 Contribuir](#-contribuindo)

</div>

---

## 📝 Sobre

**WOWNATOR** é um jogo web diário de adivinhação inspirado por projetos como [Loldle](https://loldle.net), [Mcdle](https://www.mcdle.net/) e [Onepiecedle](https://onepiecedle.net/), focado no universo do **World of Warcraft**.

O jogador deve adivinhar o alvo do dia em diferentes categorias — como personagem, zona, montaria, habilidade ou citação — acumulando pontos com base em acertos e eficiência.

---

## ✨ Funcionalidades

<table>
<tr>
<td width="50%">

### 🎮 Gameplay
- 🎯 Palpites diários por categoria
- 🏆 Ranking global com base no desempenho
- 📊 Estatísticas e gráficos diários
- 📜 Histórico de palpites

</td>
<td width="50%">

### 👤 Usuário
- 🔐 Registro e login com verificação de e-mail
- 🔔 Sistema de notificações
- ⚔️ Escolha de facção (Horda/Aliança)
- 📸 Foto de perfil personalizada

</td>
</tr>
</table>

### 🎯 Categorias de Jogo

| Categoria | Descrição |
|-----------|-----------|
| 🧙 **Personagem** | Adivinhe o personagem do universo WoW |
| 🗺️ **Zona** | Descubra a zona/região de Azeroth |
| 🐴 **Montaria** | Identifique a montaria |
| ⚡ **Habilidade** | Reconheça a skill/spell |
| 💬 **Citação** | Descubra quem disse a frase famosa |

---

## 🛠️ Tecnologias

<div align="center">

| Backend | Frontend | Database | DevTools |
|---------|----------|----------|----------|
| ![Laravel](https://img.shields.io/badge/-Laravel_11-FF2D20?style=flat-square&logo=laravel&logoColor=white) | ![Blade](https://img.shields.io/badge/-Blade-FF2D20?style=flat-square&logo=laravel&logoColor=white) | ![MySQL](https://img.shields.io/badge/-MySQL-4479A1?style=flat-square&logo=mysql&logoColor=white) | ![Vite](https://img.shields.io/badge/-Vite-646CFF?style=flat-square&logo=vite&logoColor=white) |
| ![PHP](https://img.shields.io/badge/-PHP_8.2+-777BB4?style=flat-square&logo=php&logoColor=white) | ![TailwindCSS](https://img.shields.io/badge/-TailwindCSS-38B2AC?style=flat-square&logo=tailwind-css&logoColor=white) | | ![Pest](https://img.shields.io/badge/-Pest_PHP-F9322C?style=flat-square&logo=php&logoColor=white) |

</div>

---

## 🚀 Instalação

### Pré-requisitos

- PHP 8.2+
- Composer
- Node.js & NPM
- MySQL

### Passo a passo

```bash
# Clone o repositório
git clone https://github.com/NSchrot/WoWnator.git
cd WoWnator

# Instale as dependências do PHP
composer install

# Instale as dependências do Node
npm install

# Configure o ambiente
cp .env.example .env
php artisan key:generate

# Configure o banco de dados no arquivo .env
# DB_DATABASE=wownator
# DB_USERNAME=seu_usuario
# DB_PASSWORD=sua_senha

# Execute as migrations e seeders
php artisan migrate --seed

# Compile os assets
npm run dev

# Inicie o servidor
php artisan serve
```

### 🎯 Gerando Desafios Diários

O sistema possui um comando para gerar os desafios diários automaticamente:

```bash
# Gerar o desafio do dia (executa uma vez)
php artisan app:create-daily-challenge

# Forçar regeneração do desafio (substitui o existente)
php artisan app:create-daily-challenge --force
```

**Para automatizar a geração diária**, configure o scheduler do Laravel:

```bash
# Adicione ao crontab do servidor (Linux/Mac)
* * * * * cd /caminho/para/WoWnator && php artisan schedule:run >> /dev/null 2>&1

# No Windows, use o Task Scheduler ou execute manualmente:
php artisan schedule:run
```

🌐 Acesse: `http://localhost:8000`

---

## 📁 Estrutura do Projeto

```
WoWnator/
├── 📂 app/
│   ├── Console/Commands/     # Comandos Artisan (ex: CreateDailyChallenge)
│   ├── Http/Controllers/     # Controllers da aplicação
│   ├── Models/               # Eloquent Models
│   └── View/Components/      # Componentes Blade
├── 📂 database/
│   ├── factories/            # Factories para testes
│   ├── migrations/           # Estrutura do banco
│   └── seeders/              # Dados iniciais
├── 📂 resources/
│   ├── css/                  # Estilos (Tailwind)
│   ├── js/                   # JavaScript
│   └── views/                # Templates Blade
├── 📂 routes/
│   ├── web.php               # Rotas web
│   └── auth.php              # Rotas de autenticação
└── 📂 tests/                 # Testes automatizados
```

---

## 🔐 Segurança

O sistema implementa práticas modernas de segurança:

- **Senhas criptografadas** com `Hash::make()` (Bcrypt)
- **Proteção CSRF** em formulários
- **Verificação de e-mail** obrigatória
- **RBAC** (Role-Based Access Control) para permissões
- **Soft Deletes** para exclusão segura de dados

---

## 👥 Papéis de Usuário

| Role | Permissões |
|------|------------|
| 👤 **Usuário** | Jogar, ver estatísticas, editar perfil |
| 👑 **Admin** | Gerenciar usuários, categorias e desafios |

---

## 🧪 Testes

```bash
# Executar todos os testes
php artisan test

# Executar com cobertura
php artisan test --coverage
```

---

## 📌 Status

<div align="center">

🚧 **Projeto em pausa** — versão inicial acadêmica concluída 🚧

</div>

---

## 🤝 Contribuindo

Contribuições são bem-vindas! Sinta-se à vontade para:

1. 🍴 Fazer um Fork
2. 🔧 Criar uma branch: `git checkout -b feature/nova-funcionalidade`
3. 💾 Commit: `git commit -m 'Add: nova funcionalidade'`
4. 📤 Push: `git push origin feature/nova-funcionalidade`
5. 🔃 Abrir um Pull Request

---

## 📄 Licença

Este projeto é desenvolvido para fins acadêmicos.

---

<div align="center">


*Lok'tar Ogar! ⚔️ For the Alliance!*

</div>
