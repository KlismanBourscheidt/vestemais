# 🛍️ VesteMais — Loja Virtual

Projeto acadêmico de uma loja virtual de moda masculina e feminina, desenvolvido em **PHP, MySQL, HTML e CSS**, utilizando o padrão **MVC (Model–View–Controller)**.

## Funcionalidades

- Página inicial com catálogo e navegação por coleções.
- Login administrativo com verificação de senha por hash.
- Painel administrativo para cadastro, consulta, edição e exclusão de produtos (CRUD).
- Upload de imagens de produtos e associação a categorias.

## Tecnologias

PHP, MySQL, HTML5, CSS3, XAMPP, Git e GitHub.

## Estrutura

```text
htdocs/
└── flores/
    └── vestemais/
        ├── app/
        │   ├── Controllers/
        │   ├── Models/
        │   ├── Services/
        │   └── Views/
        ├── config/
        │   └── Database.php
        ├── public/
        │   ├── css/
        │   ├── imagens/
        │   ├── uploads/
        │   └── index.php
        ├── scripts/
        │   ├── criar_admin.php
        │   └── database.sql
        └── README.md
```

A pasta `flores` faz parte do caminho local utilizado neste projeto e **não** precisa existir dentro do repositório. A estrutura MVC já vem no clone.

## Instalação local

### 1. Instalar e iniciar o XAMPP

Instale o [XAMPP](https://www.apachefriends.org/) e inicie **Apache** e **MySQL**. É necessário ter o PHP com extensão `pdo_mysql` habilitada.

### 2. Clonar o projeto

**macOS (XAMPP no caminho padrão):**

```bash
cd /Applications/XAMPP/xamppfiles/htdocs
mkdir -p flores
cd flores
git clone https://github.com/KlismanBourscheidt/VesteMais.git vestemais
```

**Windows (XAMPP em `C:\xampp`):**

```bat
cd /d C:\xampp\htdocs
mkdir flores
cd flores
git clone https://github.com/KlismanBourscheidt/VesteMais.git vestemais
```

### 3. Criar o banco de dados

1. Acesse `http://localhost/phpmyadmin`.
2. Clique em **Importar**, selecione `scripts/database.sql` e execute a importação.
3. O script cria o banco **`vestemais`**, as tabelas **`usuarios`**, **`categorias`** e **`produtos`**, além das categorias iniciais **Masculino** e **Feminino**.
4. O script não cadastra produtos nem cria senhas ou usuários administrativos.

> **Atenção:** se você já tiver um banco `vestemais` com tabelas existentes, faça backup antes. O script usa `CREATE TABLE IF NOT EXISTS` e não modifica esquemas antigos.

### 4. Configurar a conexão

Confira `config/Database.php` e ajuste host, porta, banco, usuário e senha para o MySQL do seu computador. O código enviado utiliza `127.0.0.1`, porta `3306`, banco `vestemais` e usuário `root` com senha vazia como configuração local de exemplo. **Não publique senhas reais.**

### 5. Criar o primeiro administrador

Abra o Terminal na raiz do projeto e execute:

```bash
php scripts/criar_admin.php
```

No macOS, caso o comando `php` não esteja disponível no PATH, use o executável do XAMPP:

```bash
/Applications/XAMPP/xamppfiles/bin/php scripts/criar_admin.php
```

Informe **nome**, **e-mail** e uma **senha de pelo menos 12 caracteres**. O script é exclusivo do Terminal, verifica se o e-mail já existe e salva a senha com `password_hash()`. Nenhuma senha padrão é fornecida.

### 6. Abrir o sistema

- **Loja:** `http://localhost/flores/vestemais/public/index.php?pagina=home`
- **Login:** `http://localhost/flores/vestemais/public/index.php?pagina=login`

Use o e-mail e a senha criados na etapa anterior para entrar no painel administrativo.

## Rotas principais

| Rota | Finalidade |
| --- | --- |
| `?pagina=home` | Página inicial |
| `?pagina=login` | Login administrativo |
| `?pagina=admin` | Painel administrativo |
| `?pagina=produto-cadastrar` | Cadastro de produtos |
| `?pagina=produto-editar` | Edição de produtos |
| `?pagina=produto-atualizar` | Atualização de produtos |
| `?pagina=produto-confirmar-exclusao` | Confirmação de exclusão |
| `?pagina=produto-excluir` | Exclusão de produtos |
| `?pagina=logout` | Logout (somente requisição POST) |

## Arquitetura MVC

- **Models:** consultas e persistência no MySQL.
- **Views:** interfaces da loja e do painel.
- **Controllers:** regras de fluxo, autenticação e operações CRUD.
- **`public/index.php`:** ponto de entrada que seleciona o controller conforme o parâmetro `pagina`.

## Publicação

Este repositório contém o código-fonte. O GitHub Pages não executa PHP ou MySQL; a aplicação completa precisa de servidor compatível.

## Autor

**Klisman Gabriel Bourscheidt** — Projeto acadêmico de Análise e Desenvolvimento de Sistemas.
