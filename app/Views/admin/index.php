
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Painel Administrativo | VesteMais</title>

    <link rel="stylesheet"
      href="/flores/vestemais/public/css/style.css?v=9">
</head>

<body>

    <header class="cabecalho">

        <a href="index.php" class="logo">
            VesteMais<span>.</span>
        </a>

        <nav class="menu">
            <a href="index.php">Ver loja</a>
            <a href="index.php?pagina=admin">Painel</a>
        </nav>

    </header>

    <main class="admin-container">

        <h1>Painel Administrativo</h1>

        <p>
            Bem-vindo,
            <?= htmlspecialchars($nome) ?>!
        </p>

        

            
    <section class="admin-card">

    <h2>Cadastrar novo produto</h2>

    <p>Preencha os dados para adicionar uma roupa à loja.</p>

    <form
        action="index.php?pagina=produto-cadastrar"
        method="POST"
        enctype="multipart/form-data"
        class="form-produto">

        <input
            type="hidden"
            name="csrf_token"
            value="<?= htmlspecialchars($_SESSION["csrf_token"]) ?>"
        >

        <div class="campo">
            <label for="nome">Nome do produto</label>

            <input
                type="text"
                id="nome"
                name="nome"
                maxlength="150"
                required
            >
        </div>

        <div class="campo">
            <label for="descricao">Descrição</label>

            <textarea
                id="descricao"
                name="descricao"
                rows="4"
            ></textarea>
        </div>

        <div class="campo">
            <label for="preco">Preço (R$)</label>

            <input
                type="number"
                id="preco"
                name="preco"
                min="0.01"
                step="0.01"
                required
            >
        </div>

        <div class="campo">
            <label for="estoque">Quantidade em estoque</label>

            <input
                type="number"
                id="estoque"
                name="estoque"
                min="0"
                step="1"
                required
            >
        </div>
            
        <div class="campo">

            <label for="categoria_id">Categoria</label>

            <select
                id="categoria_id"
                name="categoria_id"
                required
            >

                <option value="">
                    Selecione uma categoria
                </option>

                <?php foreach ($categorias as $categoria): ?>

                    <option value="<?= (int) $categoria["id"] ?>">

                        <?= htmlspecialchars(
                            $categoria["nome"],
                            ENT_QUOTES,
                            "UTF-8"
                        ) ?>

                    </option>

                <?php endforeach; ?>

            </select>

        </div>

        <div class="campo">

            <label for="imagem">Imagem do produto</label>

            <input
                type="file"
                id="imagem"
                name="imagem"
                accept=".jpg,.jpeg,.png,.webp"
            >

            <small>
                Formatos permitidos: JPG, PNG e WebP.
                Tamanho máximo: 5 MB.
            </small>

        </div>

        <button type="submit" class="login-botao">
            Cadastrar produto
        </button>

        </form>

        <section class="admin-card">

            <h2>Produtos cadastrados</h2>

            <div class="tabela-container">

                <table class="tabela-produtos">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Imagem</th>
                            <th>Produto</th>
                            <th>Categoria</th>
                            <th>Preço</th>
                            <th>Estoque</th>
                            <th>Ações</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach ($produtos as $produto): ?>

                            <tr>

                                <td>
                                    <?= (int) $produto["id"] ?>
                                </td>

                                <td>
                                    <?php if (!empty($produto["imagem"])): ?>

                                        <img
                                            src="<?= htmlspecialchars(
                                                $produto["imagem"],
                                                ENT_QUOTES,
                                                "UTF-8"
                                            ) ?>"
                                            alt="<?= htmlspecialchars(
                                                $produto["nome"],
                                                ENT_QUOTES,
                                                "UTF-8"
                                            ) ?>"
                                            class="admin-produto-imagem"
                                            loading="lazy"
                                        >

                                    <?php else: ?>

                                        <span>Sem imagem</span>

                                    <?php endif; ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($produto["nome"]) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($produto["categoria"] ?? "") ?>
                                </td>

                                <td>
                                    R$ <?= number_format(
                                        $produto["preco"], 2, ",", "."
                                    ) ?>
                                </td>

                                <td>
                                    <?= (int) $produto["estoque"] ?>
                                </td>

                                <td>
                                    <span class="acao-pendente">
                                        
                                        <a
                                            href="index.php?pagina=produto-editar&id=<?= (int) $produto["id"] ?>"
                                            class="botao-editar"
                                        >
                                            Editar
                                        </a>

                                        
                                        <a
                                            href="index.php?pagina=produto-confirmar-exclusao&id=<?= (int) $produto["id"] ?>"
                                            class="botao-excluir-link"
                                        >
                                            Excluir
                                        </a>

                                    </span>
                                </td>

                            </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        </section>



    </section>

        <form action="index.php?pagina=logout"
              method="POST">

            <button type="submit" class="login-botao">
                Sair da conta
            </button>

        </form>

    </main>

</body>
</html>
