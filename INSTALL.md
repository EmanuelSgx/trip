# 📖 Guia de Instalação Detalhado - TripTech

## 🎯 Instalação Passo a Passo (Windows)

### 1. Preparação do Ambiente

#### 1.1 Instalar Ferramentas Necessárias

1. **PHP 8.2+**
   ```bash
   # Baixe do site oficial: https://www.php.net/downloads
   # Ou use Chocolatey:
   choco install php
   ```

2. **Composer**
   ```bash
   # Baixe de: https://getcomposer.org/download/
   # Ou use Chocolatey:
   choco install composer
   ```

3. **Node.js 18+**
   ```bash
   # Baixe de: https://nodejs.org/
   # Ou use Chocolatey:
   choco install nodejs
   ```

4. **Git**
   ```bash
   # Baixe de: https://git-scm.com/
   # Ou use Chocolatey:
   choco install git
   ```

#### 1.2 Verificar Instalações

```bash
php --version
composer --version
node --version
npm --version
git --version
```

### 2. Configuração do Projeto

#### 2.1 Clone e Configuração Inicial

```bash
# 1. Clone o repositório
git clone https://github.com/EmanuelSgx/trip.git
cd trip

# 2. Instale dependências PHP
composer install

# 3. Instale dependências Node.js
npm install

# 4. Configure ambiente
copy .env.example .env
php artisan key:generate
php artisan jwt:secret
```

#### 2.2 Configuração do Banco SQLite (Recomendado)

```bash
# 1. Criar arquivo do banco
New-Item -Path "database/database.sqlite" -ItemType File

# 2. Configurar .env (já configurado por padrão)
# DB_CONNECTION=sqlite
# DB_DATABASE=database/database.sqlite

# 3. Executar migrações
php artisan migrate --seed
```

#### 2.3 Configuração do Banco MySQL (Opcional)

1. **Instalar MySQL**
   ```bash
   # Baixe de: https://dev.mysql.com/downloads/mysql/
   # Ou use Chocolatey:
   choco install mysql
   ```

2. **Criar Database**
   ```sql
   CREATE DATABASE triptech;
   ```

3. **Configurar .env**
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=triptech
   DB_USERNAME=root
   DB_PASSWORD=sua_senha
   ```

4. **Executar Migrações**
   ```bash
   php artisan migrate --seed
   ```

### 3. Executar a Aplicação

#### 3.1 Modo Desenvolvimento

```bash
# Terminal 1 - Backend Laravel
php artisan serve

# Terminal 2 - Frontend Vite (se necessário)
npm run dev
```

#### 3.2 Modo Produção

```bash
# Build do frontend
npm run build

# Cache de produção
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Servir aplicação
php artisan serve
```

### 4. Acessar a Aplicação

1. **URL**: http://localhost:8000
2. **Login Admin**: admin@triptech.com / admin123

## 🔧 Comandos de Manutenção

### Limpeza Completa
```bash
# Limpar todos os caches
php artisan optimize:clear

# Limpar banco e recriar
php artisan migrate:fresh --seed

# Limpar node_modules
rm -rf node_modules
npm install
```

### Backup do Banco
```bash
# SQLite
copy database\database.sqlite database\backup.sqlite

# MySQL
mysqldump -u root -p triptech > backup.sql
```


## 📦 Deploy em Servidor

### Preparação
```bash
# 1. Otimizar para produção
composer install --no-dev --optimize-autoloader
npm run build

# 2. Configurar .env para produção
APP_ENV=production
APP_DEBUG=false

# 3. Gerar caches
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Apache/Nginx
- Document root: `public/`
- PHP version: 8.2+
- Mod_rewrite habilitado

### Permissões Linux
```bash
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
```

## 📞 Ajuda Adicional

- 📚 [Documentação Laravel](https://laravel.com/docs)
- 🎨 [Documentação Vue.js](https://vuejs.org/guide/)
- 💎 [Documentação Tailwind](https://tailwindcss.com/docs)
- 🔧 [Troubleshooting Laravel](https://laravel.com/docs/11.x/troubleshooting)
