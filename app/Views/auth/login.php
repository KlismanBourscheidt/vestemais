
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Login | VesteMais</title>

    <link rel="stylesheet"
      href="/flores/vestemais/public/css/style.css?v=2">
</head>

<body class="pagina-login">

    <main class="login-container">

        <div class="login-card">

            <a href="index.php" class="logo">
                VesteMais<span>.</span>
            </a>

            <h1>Bem-vindo de volta</h1>

            <p class="login-subtitulo">
                Entre com sua conta para continuar.
            </p>

            <?php if (!empty($erro)): ?>

                <p class="login-erro">
                    <?= htmlspecialchars($erro) ?>
                </p>

            <?php endif; ?>

            <form action="index.php?pagina=login"
                  method="POST">

                <div class="campo">
                    <label for="email">E-mail</label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="seuemail@exemplo.com"
                        autocomplete="username"
                        required>
                </div>

                <div class="campo">
                    <label for="senha">Senha</label>

                    <input
                        type="password"
                        id="senha"
                        name="senha"
                        placeholder="Digite sua senha"
                        autocomplete="current-password"
                        required>
                </div>

                <button type="submit" class="login-botao">
                    Entrar
                </button>

            </form>

            <a href="index.php" class="voltar-loja">
                Voltar para a loja
            </a>

        </div>

    </main>

</body>
</html>