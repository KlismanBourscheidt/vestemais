
<?php

require_once __DIR__ . "/../Models/Produto.php";
require_once __DIR__ . "/../Models/Categoria.php";
require_once __DIR__ . "/../Services/UploadImagem.php";



class ProdutoController {

    private function verificarAdmin() {

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
    }

    
    public function cadastrar() {

        $this->verificarAdmin();

        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            http_response_code(405);
            exit("Método não permitido.");
        }

        // Verifica o token CSRF
        $token = $_POST["csrf_token"] ?? "";

        if (
            !is_string($token) ||
            empty($_SESSION["csrf_token"]) ||
            !hash_equals($_SESSION["csrf_token"], $token)
        ) {
            http_response_code(403);
            exit("Token de segurança inválido.");
        }

        // Recebe os dados do formulário
        $nome = trim($_POST["nome"] ?? "");
        $descricao = trim($_POST["descricao"] ?? "");
        $preco = $_POST["preco"] ?? "";
        $estoque = $_POST["estoque"] ?? "";
        $categoria_id = $_POST["categoria_id"] ?? "";

        // Valida os dados
        if (
            $nome === "" ||
            strlen($nome) > 150 ||
            !is_numeric($preco) ||
            (float) $preco <= 0 ||
            filter_var($estoque, FILTER_VALIDATE_INT) === false ||
            (int) $estoque < 0 ||
            filter_var($categoria_id, FILTER_VALIDATE_INT) === false ||
            (int) $categoria_id <= 0
        ) {
            http_response_code(422);
            exit("Dados do produto inválidos.");
        }

        // Confirma que a categoria existe
        $categoriaModel = new Categoria();

        if (!$categoriaModel->existe((int) $categoria_id)) {
            http_response_code(422);
            exit("A categoria selecionada não existe.");
        }

        $imagem = null;

        try {

            // Processa a imagem, se enviada
            if (
                isset($_FILES["imagem"]) &&
                $_FILES["imagem"]["error"] !== UPLOAD_ERR_NO_FILE
            ) {
                $imagem = UploadImagem::salvar(
                    $_FILES["imagem"]
                );
            }

            // Salva o produto no MySQL
            $produtoModel = new Produto();

            $produtoModel->cadastrar(
                $nome,
                $descricao,
                $preco,
                (int) $estoque,
                (int) $categoria_id,
                $imagem
            );

        } catch (Throwable $erro) {

            // Remove a imagem se o cadastro falhar
            if ($imagem !== null) {

                $arquivo = __DIR__ .
                    "/../../public/" . $imagem;

                if (is_file($arquivo)) {
                    unlink($arquivo);
                }
            }

            
            error_log($erro->getMessage());

            http_response_code(500);
            exit("Não foi possível cadastrar o produto.");

        }

        // Retorna ao painel
        header("Location: index.php?pagina=admin");
        exit;
    }



    public function editar() {

        $this->verificarAdmin();

        $id = filter_input(
            INPUT_GET,
            "id",
            FILTER_VALIDATE_INT
        );

        if (!$id || $id <= 0) {
            http_response_code(400);
            exit("ID do produto inválido.");
        }

        $produtoModel = new Produto();

        $produto = $produtoModel->buscarPorId($id);

        if (!$produto) {
            http_response_code(404);
            exit("Produto não encontrado.");
        }

        if (empty($_SESSION["csrf_token"])) {
            $_SESSION["csrf_token"] = bin2hex(random_bytes(32));
        }

        $categoriaModel = new Categoria();
        $categorias = $categoriaModel->listar();

        require __DIR__ . "/../Views/admin/editar.php";
    }

    public function atualizar() {

        $this->verificarAdmin();

        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            http_response_code(405);
            exit("Método não permitido.");
        }

        $token = $_POST["csrf_token"] ?? "";

        if (
            !is_string($token) ||
            empty($_SESSION["csrf_token"]) ||
            !hash_equals($_SESSION["csrf_token"], $token)
        ) {
            http_response_code(403);
            exit("Token de segurança inválido.");
        }

        $id = filter_var(
            $_POST["id"] ?? null,
            FILTER_VALIDATE_INT
        );

        $nome = trim($_POST["nome"] ?? "");
        $descricao = trim($_POST["descricao"] ?? "");
        $preco = $_POST["preco"] ?? "";
        $estoque = $_POST["estoque"] ?? "";
        $categoria_id = $_POST["categoria_id"] ?? "";

        if (
            !$id || $id <= 0 ||
            $nome === "" ||
            strlen($nome) > 150 ||
            !is_numeric($preco) ||
            (float) $preco <= 0 ||
            filter_var($estoque, FILTER_VALIDATE_INT) === false ||
            (int) $estoque < 0 ||
            filter_var($categoria_id, FILTER_VALIDATE_INT) === false ||
            (int) $categoria_id <= 0
        ) {
            http_response_code(422);
            exit("Dados do produto inválidos.");
        }

        $categoriaModel = new Categoria();

        if (!$categoriaModel->existe((int) $categoria_id)) {
            http_response_code(422);
            exit("A categoria selecionada não existe.");
        }

        
        $produtoModel = new Produto();

        // Busca o produto e sua imagem atual
        $produto = $produtoModel->buscarPorId($id);

        if (!$produto) {
            http_response_code(404);
            exit("Produto não encontrado.");
        }

        $imagemNova = null;
        $imagemAntiga = $produto["imagem"] ?? null;

        try {

            // Verifica se uma nova imagem foi enviada
            if (
                isset($_FILES["imagem"]) &&
                $_FILES["imagem"]["error"] !== UPLOAD_ERR_NO_FILE
            ) {

                $imagemNova = UploadImagem::salvar(
                    $_FILES["imagem"]
                );

            }

            // Atualiza os dados no banco
            $resultado = $produtoModel->atualizar(
                $id,
                $nome,
                $descricao,
                $preco,
                (int) $estoque,
                (int) $categoria_id,
                $imagemNova
            );

            if (!$resultado) {
                throw new RuntimeException(
                    "Falha ao atualizar o produto."
                );
            }

        } catch (Throwable $erro) {

            // Remove a imagem nova se a atualização falhar
            if ($imagemNova !== null) {

                $arquivoNovo = __DIR__ .
                    "/../../public/" . $imagemNova;

                if (is_file($arquivoNovo)) {
                    unlink($arquivoNovo);
                }

            }

            error_log($erro->getMessage());

            http_response_code(500);
            exit("Não foi possível atualizar o produto.");
        }

        // Após atualizar, remove a imagem antiga
        if (
            $imagemNova !== null &&
            !empty($imagemAntiga) &&
            $imagemAntiga !== $imagemNova
        ) {

            // Só permite apagar imagens da pasta de produtos
            $prefixo = "uploads/produtos/";

            if (str_starts_with($imagemAntiga, $prefixo)) {

                $nomeAntigo = basename($imagemAntiga);

                $arquivoAntigo = __DIR__ .
                    "/../../public/uploads/produtos/" .
                    $nomeAntigo;

                if (is_file($arquivoAntigo)) {
                    if (!unlink($arquivoAntigo)) {
                        error_log(
                            "Não foi possível remover a imagem antiga."
                        );
                    }
                }

            }
        }


        // Retorna ao painel administrativo
        header("Location: index.php?pagina=admin");
        exit;
    }



    public function excluir() {

        // Verifica se o usuário é administrador
        $this->verificarAdmin();

        // Permite exclusão somente via POST
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            http_response_code(405);
            exit("Método não permitido.");
        }

        // Verifica o token de segurança
        $token = $_POST["csrf_token"] ?? "";

        if (
            !is_string($token) ||
            empty($_SESSION["csrf_token"]) ||
            !hash_equals($_SESSION["csrf_token"], $token)
        ) {
            http_response_code(403);
            exit("Token de segurança inválido.");
        }

        // Recebe e valida o ID
        $id = filter_var(
            $_POST["id"] ?? null,
            FILTER_VALIDATE_INT
        );

        if (!$id || $id <= 0) {
            http_response_code(400);
            exit("ID do produto inválido.");
        }

        // Instancia o Model
        $produtoModel = new Produto();

        // Verifica se o produto existe
        $produto = $produtoModel->buscarPorId($id);

        if (!$produto) {
            http_response_code(404);
            exit("Produto não encontrado.");
        }

        // Guarda o caminho da imagem antes da exclusão
        $imagem = $produto["imagem"] ?? null;

        // Exclui o produto do banco
        try {

            $resultado = $produtoModel->excluir($id);

            if (!$resultado) {
                throw new RuntimeException(
                    "Falha ao excluir o produto."
                );
            }

        } catch (Throwable $erro) {

            error_log($erro->getMessage());

            http_response_code(500);
            exit("Não foi possível excluir o produto.");
        }


        error_log("DEBUG - Imagem: " . var_export($imagem, true));

        error_log(
            "DEBUG - Pasta uploads gravável: " .
            (is_writable(__DIR__ . "/../../public/uploads/produtos/")
                ? "SIM"
                : "NAO")
        );


        // Remove a imagem após excluir o produto
        if (!empty($imagem)) {

            $prefixo = "uploads/produtos/";

            // Verifica se o caminho é da pasta permitida
            if (
                str_starts_with($imagem, $prefixo) &&
                basename($imagem) ===
                    substr($imagem, strlen($prefixo))
            ) {

                
                $arquivo = __DIR__ .
                    "/../../public/uploads/produtos/" .
                    basename($imagem);

                // Diagnóstico do arquivo
                error_log("DEBUG - Caminho: " . $arquivo);

                error_log(
                    "DEBUG - Arquivo existe: " .
                    (is_file($arquivo) ? "SIM" : "NAO")
                );


                if (is_file($arquivo)) {

                    if (!unlink($arquivo)) {
                        error_log(
                            "Falha ao remover imagem: " .
                            $arquivo
                        );
                    }

                }
            }
        }

        // Retorna ao painel administrativo
        header("Location: index.php?pagina=admin");
        exit;
    }

    public function confirmarExclusao() {

        $this->verificarAdmin();

        $id = filter_input(
            INPUT_GET,
            "id",
            FILTER_VALIDATE_INT
        );

        if (!$id || $id <= 0) {
            http_response_code(400);
            exit("ID do produto inválido.");
        }

        $produtoModel = new Produto();

        $produto = $produtoModel->buscarPorId($id);

        if (!$produto) {
            http_response_code(404);
            exit("Produto não encontrado.");
        }

        if (empty($_SESSION["csrf_token"])) {
            $_SESSION["csrf_token"] = bin2hex(random_bytes(32));
        }

        require __DIR__ . "/../Views/admin/excluir.php";
    }

}
?>