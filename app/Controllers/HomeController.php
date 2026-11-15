<?php

require_once __DIR__ . "/../Models/Produto.php";

class HomeController {

    public function index() {

        $titulo = "VesteMais";
        $slogan = "Seu estilo começa aqui.";

        $produtoModel = new Produto();

        $produtos = $produtoModel->listar();

        require __DIR__ . "/../Views/home/index.php";
    }
}
?>