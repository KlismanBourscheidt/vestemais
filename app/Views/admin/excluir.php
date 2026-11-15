
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Excluir Produto | VesteMais</title>

    <link rel="stylesheet"
          href="/flores/vestemais/public/css/style.css?v=9">
</head>

<body>

    <main class="admin-container">

        <section class="admin-card">

            <h1>Excluir produto</h1>

            <p>
                Tem certeza de que deseja excluir
                o produto abaixo?
            </p>

            <h2>
                <?= htmlspecialchars(
                    $produto["nome"],
                    ENT_QUOTES,
                    "UTF-8"
                ) ?>
            </h2>

            <p>
                Esta ação removerá o produto
                permanentemente do banco de dados.
            </p>

            <div class="acoes-exclusao">

                <a
                    href="index.php?pagina=admin"
                    class="botao-cancelar"
                >
                    Cancelar
                </a>

                <form
                    action="index.php?pagina=produto-excluir"
                    method="POST"
                >

                    <input
                        type="hidden"
                        name="id"
                        value="<?= (int) $produto["id"] ?>"
                    >

                    <input
                        type="hidden"
                        name="csrf_token"
                        value="<?= htmlspecialchars(
                            $_SESSION["csrf_token"],
                            ENT_QUOTES,
                            "UTF-8"
                        ) ?>"
                    >

                    <button
                        type="submit"
                        class="botao-excluir"
                    >
                        Confirmar exclusão
                    </button>

                </form>

            </div>

        </section>

    </main>

</body>
</html>
