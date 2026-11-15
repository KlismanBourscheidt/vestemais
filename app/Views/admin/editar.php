
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Editar Produto | VesteMais</title>

    <link rel="stylesheet"
          href="/flores/vestemais/public/css/style.css?v=8">
</head>

<body>

    <main class="admin-container">

        <a href="index.php?pagina=admin"
           class="voltar-loja">
            ← Voltar ao painel
        </a>

        <section class="admin-card">

            <h1>Editar produto</h1>

            <p>Atualize as informações do produto.</p>

            <form
                action="index.php?pagina=produto-atualizar"
                method="POST"
                class="form-produto"
                enctype="multipart/form-data"
            >

                <input
                    type="hidden"
                    name="csrf_token"
                    value="<?= htmlspecialchars($_SESSION["csrf_token"]) ?>"
                >

                <input
                    type="hidden"
                    name="id"
                    value="<?= (int) $produto["id"] ?>"
                >

                <div class="campo">
                    <label for="nome">Nome do produto</label>

                    <input
                        type="text"
                        id="nome"
                        name="nome"
                        maxlength="150"
                        value="<?= htmlspecialchars($produto["nome"]) ?>"
                        required
                    >
                </div>

                <div class="campo">
                    <label for="descricao">Descrição</label>

                    <textarea
                        id="descricao"
                        name="descricao"
                        rows="4"
                    ><?= htmlspecialchars($produto["descricao"] ?? "") ?></textarea>
                </div>

                <div class="campo">
                    <label for="preco">Preço (R$)</label>

                    <input
                        type="number"
                        id="preco"
                        name="preco"
                        min="0.01"
                        step="0.01"
                        value="<?= htmlspecialchars($produto["preco"]) ?>"
                        required
                    >
                </div>

                <div class="campo">
                    <label for="estoque">Estoque</label>

                    <input
                        type="number"
                        id="estoque"
                        name="estoque"
                        min="0"
                        step="1"
                        value="<?= (int) $produto["estoque"] ?>"
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
                        <option value="1"
                            <?= (int) $produto["categoria_id"] === 1 ? "selected" : "" ?>>
                            Masculino
                        </option>

                        <option value="2"
                            <?= (int) $produto["categoria_id"] === 2 ? "selected" : "" ?>>
                            Feminino
                        </option>

                        <option value="3"
                            <?= (int) $produto["categoria_id"] === 3 ? "selected" : "" ?>>
                            Unissex
                        </option>
                    </select>
                </div>


                <div class="campo">

                    <label>Imagem atual</label>

                    <?php if (!empty($produto["imagem"])): ?>

                        <img
                            src="<?= htmlspecialchars(
                                $produto["imagem"],
                                ENT_QUOTES,
                                "UTF-8"
                            ) ?>"
                            alt="Imagem atual do produto"
                            style="width: 160px; height: 160px; object-fit: cover;"
                        >

                    <?php else: ?>

                        <p>Este produto não possui imagem.</p>

                    <?php endif; ?>

                    <label for="imagem">Alterar imagem</label>

                    <input
                        type="file"
                        id="imagem"
                        name="imagem"
                        accept=".jpg,.jpeg,.png,.webp"
                    >

                    <small>
                        Deixe vazio para manter a imagem atual.
                    </small>

                </div>

                <button type="submit" class="login-botao">
                    Salvar alterações
                </button>

            </form>

        </section>

    </main>

</body>
</html>
