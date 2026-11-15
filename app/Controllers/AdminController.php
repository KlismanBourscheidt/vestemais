
<?php

require_once __DIR__ . "/../Models/Produto.php";
require_once __DIR__ . "/../Models/Categoria.php";


class AdminController {

    public function index() {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION["usuario_id"])) {
            header("Location: index.php?pagina=login");
            exit;
        }

        if (($_SESSION["perfil"] ?? "") !== "admin") {
            http_response_code(403);
            exit("Acesso não autorizado.");
        }


        if (empty($_SESSION["csrf_token"])) {
            $_SESSION["csrf_token"] = bin2hex(random_bytes(32));
        }


        $nome = $_SESSION["usuario_nome"];
        $produtoModel = new Produto();
        $produtos = $produtoModel->listar();
        $categoriaModel = new Categoria();
        $categorias = $categoriaModel->listar();


        require __DIR__ . "/../Views/admin/index.php";
    }
}
?>