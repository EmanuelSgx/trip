# 🌍 TripTech - Sistema de Gestão de Viagens Corporativas

<div align="center">

![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Vue.js](https://img.shields.io/badge/Vue.js-3.x-4FC08D?style=for-the-badge&logo=vue.js&logoColor=white)
![TypeScript](https://img.shields.io/badge/TypeScript-5.x-3178C6?style=for-the-badge&logo=typescript&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)

*Sistema profissional para gestão de solicitações de viagem corporativa*

</div>

---

## 📋 Sobre o Projeto

O **TripTech** é uma aplicação web moderna desenvolvida para facilitar o gerenciamento de solicitações de viagem em empresas. Com uma interface intuitiva e funcionalidades robustas, permite que funcionários solicitem viagens e administradores as aprovem de forma eficiente.

### ✨ Principais Funcionalidades

- 🔐 **Autenticação Segura** - Sistema JWT com controle de acesso
- 👥 **Gestão de Usuários** - Perfis de Administrador e Usuário
- ✈️ **CRUD Completo** - Criar, editar, visualizar e gerenciar solicitações
- ✅ **Aprovação/Reprovação** - Workflow de aprovação para administradores
- 📊 **Dashboard Interativo** - Visão geral com estatísticas e filtros
- 📥 **Exportação CSV** - Download de relatórios
- 🎨 **Interface Moderna** - Design responsivo com Tailwind CSS
- � **Notificações** - Sistema de toast para feedback do usuário

---

## 🛠️ Stack Técnica

### Backend
- **Laravel 11** - Framework PHP
- **JWT Auth** - Autenticação segura
- **Eloquent ORM** - Manipulação de dados
- **Spatie Query Builder** - Filtros avançados

### Frontend
- **Vue.js 3** - Framework JavaScript
- **TypeScript** - Tipagem estática
- **Vue Router** - Roteamento SPA
- **Tailwind CSS** - Estilização
- **Vite** - Build tool

### Banco de Dados
- **SQLite** (desenvolvimento)
- **MySQL** (produção)

---

## � Instalação e Configuração

### Pré-requisitos

Certifique-se de ter as seguintes ferramentas instaladas:

- **PHP** >= 8.2
- **Node.js** >= 18.x
- **Composer** (gerenciador de dependências PHP)
- **Git** (controle de versão)

### 1️⃣ Clone o Repositório

```bash
git clone https://github.com/seu-usuario/triptech.git
cd triptech
```

### 2️⃣ Instale as Dependências

```bash
# Dependências PHP
composer install

# Dependências Node.js
npm install
```

### 3️⃣ Configure o Ambiente

```bash
# Copie o arquivo de configuração
cp .env.example .env

# Gere a chave da aplicação
php artisan key:generate

# Gere a chave JWT
php artisan jwt:secret
```

### 4️⃣ Configure o Banco de Dados

Edite o arquivo `.env` e configure as credenciais do banco:

```env
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite

# Para MySQL:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=triptech
# DB_USERNAME=seu_usuario
# DB_PASSWORD=sua_senha
```

### 5️⃣ Execute as Migrações

```bash
# Criar tabelas e inserir dados iniciais
php artisan migrate --seed
```

### 6️⃣ Build do Frontend

```bash
# Para desenvolvimento
npm run dev

# Para produção
npm run build
```

### 7️⃣ Inicie o Servidor

```bash
# Servidor Laravel
php artisan serve

# O sistema estará disponível em: http://localhost:8000
```

---

## � Credenciais de Acesso

### Administrador
- **Email:** `admin@triptech.com`
- **Senha:** `admin123`
- **Permissões:** Visualizar todas as solicitações, aprovar/reprovar, gerenciar usuários

---

## 📁 Estrutura do Projeto

```
triptech/
├── 📂 app/
│   ├── Http/Controllers/Api/    # Controllers da API
│   └── Models/                  # Models Eloquent
├── 📂 database/
│   ├── migrations/              # Migrações do banco
│   └── seeders/                 # Seeders de dados
├── 📂 resources/
│   ├── js/                      # Frontend Vue.js
│   │   ├── components/          # Componentes reutilizáveis
│   │   ├── pages/               # Páginas da aplicação
│   │   ├── composables/         # Lógica reutilizável
│   │   └── types/               # Tipagens TypeScript
│   └── css/                     # Estilos globais
├── 📂 routes/
│   ├── api.php                  # Rotas da API
│   └── web.php                  # Rotas web
└── 📂 public/
    └── build/                   # Assets buildados
```

---

## 🎯 Como Usar

### Para Usuários Regulares

1. **Faça Login** com suas credenciais
2. **Crie uma Solicitação** clicando em "Nova Solicitação"
3. **Preencha os Dados** (destino, datas, observações)
4. **Acompanhe o Status** no dashboard
5. **Edite se Necessário** enquanto estiver pendente

### Para Administradores

1. **Acesse o Dashboard** com credenciais de admin
2. **Visualize Todas as Solicitações** no painel administrativo
3. **Aprove ou Reprove** clicando no status da solicitação
4. **Exporte Relatórios** usando o botão "Exportar CSV"
5. **Gerencie Filtros** por status, destino ou período

---

## 🧪 Dados de Teste

Para desenvolvimento, você pode carregar dados de exemplo:

```bash
php artisan db:seed --class=TravelRequestTestSeeder
```

Isso criará:
- 2 usuários teste
- 4 solicitações de exemplo com diferentes status

---

## 🚀 Deploy em Produção

### 1️⃣ Otimizações

```bash
# Install dependências de produção
composer install --no-dev --optimize-autoloader

# Build de produção
npm run build

# Cache de configurações
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 2️⃣ Configurações de Produção

No arquivo `.env` de produção:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://seudominio.com

# Configure seu banco de produção
DB_CONNECTION=mysql
DB_HOST=seu_host
DB_DATABASE=sua_database
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```

---

## 🔧 Comandos Úteis

### Desenvolvimento

```bash
# Limpar todos os caches
php artisan optimize:clear

# Resetar banco de dados
php artisan migrate:fresh --seed

# Verificar rotas
php artisan route:list

# Executar testes
php artisan test
```

### Manutenção

```bash
# Backup do banco
php artisan backup:run

# Verificar status da aplicação
php artisan about

# Monitorar logs
php artisan pail
```

---

## 🎨 Capturas de Tela

### Dashboard Principal
- Interface moderna com gradientes
- Estatísticas em tempo real
- Filtros avançados
- Lista paginada de solicitações

### Modal de Aprovação (Admin)
- Botões coloridos para cada ação
- Informações detalhadas da solicitação
- Feedback visual imediato

### Exportação de Dados
- Download em formato CSV
- Dados filtrados
- Formatação profissional

---

## 🤝 Contribuição

1. Fork o projeto
2. Crie uma branch para sua feature (`git checkout -b feature/nova-funcionalidade`)
3. Commit suas mudanças (`git commit -m 'Adiciona nova funcionalidade'`)
4. Push para a branch (`git push origin feature/nova-funcionalidade`)
5. Abra um Pull Request

---

## 📝 Licença

Este projeto está sob a licença MIT. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.

---

## 📞 Suporte

Para dúvidas ou suporte:

- 📧 Email: suporte@triptech.com
- 🐛 Issues: [GitHub Issues](https://github.com/seu-usuario/triptech/issues)
- 📚 Documentação: [Wiki do Projeto](https://github.com/seu-usuario/triptech/wiki)

---

<div align="center">

**Desenvolvido com ❤️ pela equipe TripTech**

⭐ Se este projeto foi útil, não esqueça de dar uma estrela!

</div>
