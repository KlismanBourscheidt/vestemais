# VesteMais — Loja Virtual

Projeto acadêmico de uma loja virtual de moda masculina e feminina, desenvolvido com **PHP**, **MySQL**, **HTML**, **CSS** e **JavaScript**, seguindo o padrão arquitetural **MVC (Model–View–Controller)**.

## Funcionalidades

- Página inicial com apresentação das coleções e catálogo de produtos.
- Navegação pelas seções da loja.
- Tela de login para acesso administrativo.
- Área administrativa para gerenciamento de produtos.
- Operações de cadastro, consulta, edição e exclusão de produtos (CRUD).

## Tecnologias utilizadas

- PHP
- MySQL
- HTML5 e CSS3
- JavaScript
- XAMPP (ambiente de desenvolvimento local)
- Git e GitHub (versionamento)

## Estrutura do projeto

O projeto segue o padrão MVC:

- **Models:** acesso e manipulação dos dados.
- **Views:** apresentação das páginas da loja e do painel administrativo.
- **Controllers:** processamento das requisições e integração entre Models e Views.
- **public/index.php:** ponto de entrada e roteamento da aplicação.

## Como executar localmente

1. Instale e abra o **XAMPP**, iniciando os serviços Apache e MySQL.
2. Clone o repositório na pasta `htdocs/flores/vestemais` do XAMPP (ou ajuste os caminhos do projeto conforme a pasta escolhida):

   ```bash
   git clone URL_DO_REPOSITORIO vestemais
   ```

3. Crie um banco de dados MySQL e importe o arquivo `.sql` do projeto, **caso ele seja disponibilizado no repositório**.
4. Configure a conexão com o banco usando os dados do seu ambiente local. Não publique senhas nem credenciais reais.
5. Acesse no navegador:

   ```text
   http://localhost/flores/vestemais/public/index.php?pagina=home
   ```

6. Para acessar a tela de login:

   ```text
   http://localhost/flores/vestemais/public/index.php?pagina=login
   ```

> **Observação:** para efetuar login, é necessário ter um usuário administrador configurado no banco de dados. As credenciais não acompanham o repositório.

## Rotas principais

| Rota | Finalidade |
| --- | --- |
| `?pagina=home` | Página inicial da loja |
| `?pagina=login` | Tela de login |
| `?pagina=admin` | Painel administrativo (requer autenticação) |

## Publicação

O GitHub hospeda o código-fonte. O **GitHub Pages não executa PHP nem MySQL**, portanto, para disponibilizar todas as funcionalidades na internet, será necessária uma hospedagem compatível com PHP e banco de dados.

## Finalidade

Projeto desenvolvido para fins acadêmicos e de aprendizado de desenvolvimento web, arquitetura MVC e operações CRUD.