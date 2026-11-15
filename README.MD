# 🛍️ VesteMais — Loja Virtual

O **VesteMais** é um projeto acadêmico de loja virtual desenvolvido com **PHP, MySQL, HTML, CSS e JavaScript**, utilizando a arquitetura **MVC (Model–View–Controller)**.

O sistema foi criado com o objetivo de aplicar conhecimentos de desenvolvimento web, organização de código, integração com banco de dados e operações CRUD (*Create, Read, Update, Delete*).

O projeto possui uma interface de loja virtual e uma área administrativa para gerenciamento dos produtos.

## 🚀 Tecnologias utilizadas

- **PHP:** desenvolvimento da lógica do sistema.
- **MySQL:** armazenamento e gerenciamento dos dados.
- **HTML5:** estrutura das páginas.
- **CSS3:** estilização e identidade visual.
- **JavaScript:** interatividade da interface.
- **MVC:** organização e separação das responsabilidades do sistema.
- **XAMPP:** ambiente de desenvolvimento local.
- **Git e GitHub:** versionamento e armazenamento do código-fonte.

## ⚙️ Funcionalidades

### 🛒 Loja virtual

- Página inicial com identidade visual VesteMais.
- Exibição de produtos.
- Navegação por categorias.
- Interface para moda masculina e feminina.
- Botão de acesso ao login administrativo.

### 🔐 Área administrativa

- Tela de login.
- Painel administrativo.
- Cadastro de novos produtos.
- Listagem de produtos cadastrados.
- Edição de informações dos produtos.
- Exclusão de produtos.
- Gerenciamento dos dados por meio do MySQL.

## 🏗️ Arquitetura MVC

O VesteMais utiliza o padrão **Model–View–Controller**, que divide a aplicação em três responsabilidades principais.

| Camada | Responsabilidade |
|---|---|
| Model | Gerencia os dados e a comunicação com o banco de dados. |
| View | Apresenta as páginas, formulários e informações ao usuário. |
| Controller | Recebe as requisições e coordena a comunicação entre Model e View. |

Essa organização facilita a manutenção, a leitura do código e a implementação de novas funcionalidades.

## 📁 Estrutura do projeto

O repositório está organizado da seguinte maneira:

```text
VesteMais/
├── app/
│   ├── Controllers/
│   │   ├── HomeController.php
│   │   ├── AuthController.php
│   │   ├── AdminController.php
│   │   └── ProdutoController.php
│   ├── Models/
│   └── Views/
│       ├── home/
│       ├── Auth/
│       └── ...
├── config/
├── public/
│   └── index.php
├── scripts/
└── README.md
```

**Descrição dos diretórios:**

- `app/Controllers/`: contém os controladores responsáveis pelas funcionalidades da aplicação.
- `app/Models/`: contém os modelos responsáveis pela manipulação dos dados.
- `app/Views/`: contém as interfaces da loja e da área administrativa.
- `config/`: contém os arquivos de configuração do sistema.
- `public/`: contém o ponto de entrada da aplicação e os recursos públicos.
- `scripts/`: diretório destinado aos scripts auxiliares do projeto.

## 💻 Como instalar e executar o projeto

O VesteMais foi desenvolvido para execução local utilizando o **XAMPP**, com Apache, PHP e MySQL.

### 1. Pré-requisitos

Antes de começar, instale:

- [XAMPP](https://www.apachefriends.org/)
- [Git](https://git-scm.com/)
- Um navegador atualizado.

### 2. Criar a estrutura de pastas

Para manter os caminhos utilizados durante o desenvolvimento, o projeto deve ser instalado dentro de uma pasta chamada `flores`, localizada no diretório `htdocs` do XAMPP.

A estrutura final deverá ficar assim:

```text
xampp/
└── htdocs/
    └── flores/
        └── vestemais/
            ├── app/
            ├── config/
            ├── public/
            ├── scripts/
            └── README.md
```

**Importante:** as pastas internas do VesteMais já estão presentes no repositório e serão baixadas automaticamente pelo Git.

### 3. Clonar o repositório

No macOS, considerando o caminho padrão do XAMPP, abra o Terminal e execute:

```bash
cd /Applications/XAMPP/xamppfiles/htdocs
mkdir -p flores
cd flores
git clone https://github.com/KlismanBourscheidt/VesteMais.git vestemais
```

**Para Windows:**

Abra o terminal no diretório do XAMPP:

```bash
cd C:\xampp\htdocs
mkdir flores
cd flores
git clone https://github.com/KlismanBourscheidt/VesteMais.git vestemais
```

Após a clonagem, os arquivos estarão disponíveis na pasta `flores/vestemais`.

### 4. Iniciar o XAMPP

Abra o painel de controle do XAMPP e inicie os serviços:

- Apache
- MySQL

Os dois serviços precisam estar funcionando para executar todas as funcionalidades do projeto.

### 5. Configurar o banco de dados

Acesse o phpMyAdmin pelo navegador:

`http://localhost/phpmyadmin`

Em seguida:

1. Crie o banco de dados com o nome utilizado na configuração do projeto.
2. Caso o repositório disponibilize um arquivo `.sql`, importe-o pelo phpMyAdmin.
3. Localize o arquivo de conexão com o banco de dados na pasta `config`.
4. Configure o nome do banco, usuário, senha e endereço do servidor conforme seu ambiente local.
5. Salve as alterações e verifique se a conexão está funcionando.

**Atenção:** não publique credenciais reais ou senhas do banco de dados no GitHub.

### 6. Executar a loja virtual

Com o Apache e o MySQL iniciados, abra o navegador e acesse:

**Página inicial:**

`http://localhost/flores/vestemais/public/index.php?pagina=home`

**Login administrativo:**

`http://localhost/flores/vestemais/public/index.php?pagina=login`

O acesso ao painel administrativo depende da autenticação e da configuração dos usuários no banco de dados.

## 🔄 Funcionamento das rotas

O projeto utiliza o arquivo `public/index.php` como ponto de entrada para direcionar as requisições aos controladores.

As rotas são identificadas pelo parâmetro `pagina`, enviado pela URL.

| Rota | Funcionalidade |
|---|---|
| `?pagina=home` | Página inicial da loja |
| `?pagina=login` | Login administrativo |
| `?pagina=admin` | Painel administrativo |
| `?pagina=produto-cadastrar` | Cadastro de produtos |
| `?pagina=produto-editar` | Edição de produtos |
| `?pagina=produto-atualizar` | Atualização de produtos |
| `?pagina=produto-excluir` | Exclusão de produtos |
| `?pagina=produto-confirmar-exclusao` | Confirmação de exclusão |
| `?pagina=logout` | Encerramento da sessão via POST |

As rotas administrativas devem ser acessadas somente por usuários autorizados.

## 🗄️ Operações CRUD

O sistema implementa as quatro operações fundamentais de gerenciamento de dados:

| Operação | Descrição |
|---|---|
| Create | Cadastrar novos produtos. |
| Read | Consultar e listar produtos cadastrados. |
| Update | Atualizar informações de produtos existentes. |
| Delete | Excluir produtos do sistema. |

Essas operações são realizadas pela aplicação PHP em comunicação com o banco de dados MySQL.

## 🎯 Objetivo acadêmico

O desenvolvimento do VesteMais tem como finalidade colocar em prática os conceitos estudados durante a formação em **Análise e Desenvolvimento de Sistemas**.

Entre os principais conhecimentos aplicados estão:

- Desenvolvimento de aplicações web.
- Organização de projetos utilizando MVC.
- Programação com PHP.
- Integração com banco de dados relacional.
- Implementação de operações CRUD.
- Criação de interfaces utilizando HTML, CSS e JavaScript.
- Controle de versões com Git e GitHub.

## 🌐 Sobre a hospedagem

Atualmente, o projeto está disponibilizado no GitHub como código-fonte.

Por utilizar PHP e MySQL, sua execução completa exige um servidor com suporte a essas tecnologias.

O GitHub Pages não executa aplicações PHP nem bancos de dados MySQL.

## 👨‍💻 Desenvolvedor

**Klisman Gabriel Bourscheidt**

Acadêmico de Análise e Desenvolvimento de Sistemas — UniCesumar.

**GitHub:** [KlismanBourscheidt](https://github.com/KlismanBourscheidt)

---

*VesteMais — Projeto acadêmico desenvolvido para fins de estudo e aperfeiçoamento em desenvolvimento web.*
