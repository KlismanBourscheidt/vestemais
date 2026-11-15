<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= htmlspecialchars($titulo) ?></title>

    <link rel="stylesheet" href="/flores/vestemais/public/css/style.css?v=11">
</head>

<body>

    <header class="cabecalho">
        <a href="index.php" class="logo">
            VesteMais
        </a>

        <nav class="menu">
            <a href="index.php">Início</a>
            <a href="#produtos">Coleção</a>
            <a href="#masculino">Masculino</a>
            <a href="#feminino">Feminino</a>
        </nav>

        <a href="/flores/vestemais/public/index.php?pagina=login">
            Entrar
        </a>
    </header>

    <main>

        <section class="banner">

            <div class="banner-slides" aria-hidden="true">
                <div class="banner-slide slide-1"></div>
                <div class="banner-slide slide-2"></div>
                <div class="banner-slide slide-3"></div>
            </div>

            <div class="banner-conteudo">

                <span class="etiqueta">
                    NOVA COLEÇÃO
                </span>

                <h1><?= htmlspecialchars($slogan) ?></h1>

                <p>
                    Peças essenciais para quem valoriza
                    conforto, autenticidade e estilo.
                </p>

                <a href="#produtos" class="botao">
                    Explorar coleção
                </a>

            </div>

            <div class="banner-indicadores" aria-hidden="true">
                <span></span>
                <span></span>
                <span></span>
            </div>

        </section>

        <section id="produtos" class="produtos">

            <div class="secao-titulo">
                <div>
                    <span class="etiqueta">
                        SELEÇÃO VESTEMAIS
                    </span>

                    <h2>Nossos produtos</h2>
                </div>
            </div>

            
            <div class="grade-produtos">

                <?php if (empty($produtos)): ?>

                    <p>Nenhum produto cadastrado.</p>

                <?php else: ?>

                    <?php foreach ($produtos as $produto): ?>

                        <article class="produto">

                            <div class="produto-imagem">

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
                                        loading="lazy"
                                    >

                                <?php else: ?>

                                    <span>Imagem indisponível</span>

                                <?php endif; ?>

                            </div>

                            <h3>
                                <?= htmlspecialchars(
                                    $produto["nome"],
                                    ENT_QUOTES,
                                    "UTF-8"
                                ) ?>
                            </h3>

                            <p>
                                <?= htmlspecialchars(
                                    $produto["categoria"] ?? "Sem categoria",
                                    ENT_QUOTES,
                                    "UTF-8"
                                ) ?>
                            </p>

                            <strong>
                                R$ <?= number_format(
                                    $produto["preco"],
                                    2,
                                    ",",
                                    "."
                                ) ?>
                            </strong>

                        </article>

                    <?php endforeach; ?>

                <?php endif; ?>

            </div>

        </section>

    </main>

    <footer class="rodape">
        <p>
            &copy; <?= date("Y") ?> VesteMais.
            Todos os direitos reservados.
        </p>
    </footer>

</body>
</html>