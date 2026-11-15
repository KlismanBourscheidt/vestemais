
<?php

require_once __DIR__ . "/../Models/Usuario.php";

class AuthController {

    public function login() {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $email = trim($_POST["email"] ?? "");
            $senha = $_POST["senha"] ?? "";

            $usuarioModel = new Usuario();

            $usuario = $usuarioModel->verificarLogin(
                $email,
                $senha
            );

            if ($usuario) {

                session_regenerate_id(true);

                $_SESSION["usuario_id"] = $usuario["id"];
                $_SESSION["usuario_nome"] = $usuario["nome"];
                $_SESSION["perfil"] = $usuario["perfil"];

                if ($usuario["perfil"] === "admin") {

                    header("Location: index.php?pagina=admin");

                } else {

                    header("Location: index.php");
                }

                exit;
            }

            $erro = "E-mail ou senha inválidos.";
        }

        require __DIR__ . "/../Views/auth/login.php";
    }

    public function logout() {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION = [];

        if (ini_get("session.use_cookies")) {

            $parametros = session_get_cookie_params();

            setcookie(
                session_name(),
                "",
                time() - 42000,
                $parametros["path"],
                $parametros["domain"],
                $parametros["secure"],
                $parametros["httponly"]
            );
        }

        session_destroy();

        header("Location: index.php?pagina=login");
        exit;
    }
}
?>