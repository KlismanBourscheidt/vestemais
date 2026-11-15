
<?php

require_once __DIR__ . "/../app/Controllers/HomeController.php";
require_once __DIR__ . "/../app/Controllers/AuthController.php";
require_once __DIR__ . "/../app/Controllers/AdminController.php";
require_once __DIR__ . "/../app/Controllers/ProdutoController.php";



$pagina = $_GET["pagina"] ?? "home";

switch ($pagina) {

    case "login":

        $controller = new AuthController();
        $controller->login();
        break;

    case "logout":

        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            http_response_code(405);
            exit("Método não permitido.");
        }

        $controller = new AuthController();
        $controller->logout();
        break;

    case "home":

        $controller = new HomeController();
        $controller->index();
        break;
    
    case "admin":

        $controller = new AdminController();
        $controller->index();
        break;
    
    case "produto-cadastrar":

        $controller = new ProdutoController();
        $controller->cadastrar();
        break;

    case "produto-editar":

        $controller = new ProdutoController();
        $controller->editar();
        break;

    case "produto-atualizar":

        $controller = new ProdutoController();
        $controller->atualizar();
        break;

    case "produto-excluir":

        $controller = new ProdutoController();
        $controller->excluir();
        break;

    case "produto-confirmar-exclusao":

        $controller = new ProdutoController();
        $controller->confirmarExclusao();
        break;

    default:

        http_response_code(404);
        echo "Página não encontrada.";
        break;
}
?>