<?php

require_once __DIR__ . "/../../config/Database.php";

class Produto {

    private $conexao;

    public function __construct() {

        $this->conexao = Database::conectar();
    }

    public function listar() {

        $sql = "SELECT
                    produtos.id,
                    produtos.nome,
                    produtos.descricao,
                    produtos.preco,
                    produtos.estoque,
                    produtos.imagem,
                    categorias.nome AS categoria
                FROM produtos
                LEFT JOIN categorias
                    ON produtos.categoria_id = categorias.id
                ORDER BY produtos.id DESC";

        $consulta = $this->conexao->prepare($sql);

        $consulta->execute();

        return $consulta->fetchAll();
    }

   
    public function cadastrar(
        $nome,
        $descricao,
        $preco,
        $estoque,
        $categoria_id,
        $imagem = null
    ) {

        $sql = "INSERT INTO produtos
                (
                    nome,
                    descricao,
                    preco,
                    estoque,
                    categoria_id,
                    imagem
                )
                VALUES
                (
                    :nome,
                    :descricao,
                    :preco,
                    :estoque,
                    :categoria_id,
                    :imagem
                )";

        $consulta = $this->conexao->prepare($sql);

        $consulta->execute([
            ":nome" => $nome,
            ":descricao" => $descricao,
            ":preco" => $preco,
            ":estoque" => $estoque,
            ":categoria_id" => $categoria_id,
            ":imagem" => $imagem
        ]);

        return $this->conexao->lastInsertId();
    }


    public function buscarPorId($id) {

        $sql = "SELECT id, nome, descricao, preco, estoque,
               categoria_id, imagem
        FROM produtos
        WHERE id = :id";

        $consulta = $this->conexao->prepare($sql);

        $consulta->execute([
            ":id" => $id
        ]);

        return $consulta->fetch();
    }

    public function atualizar(
        $id,
        $nome,
        $descricao,
        $preco,
        $estoque,
        $categoria_id,
        $imagem = null
    ) {

        $sql = "UPDATE produtos SET
                    nome = :nome,
                    descricao = :descricao,
                    preco = :preco,
                    estoque = :estoque,
                    categoria_id = :categoria_id,
                    imagem = COALESCE(:imagem, imagem)
                WHERE id = :id";

        $consulta = $this->conexao->prepare($sql);

        return $consulta->execute([
            ":id" => $id,
            ":nome" => $nome,
            ":descricao" => $descricao,
            ":preco" => $preco,
            ":estoque" => $estoque,
            ":categoria_id" => $categoria_id,
            ":imagem" => $imagem
        ]);
    }

    public function excluir($id) {

        $sql = "DELETE FROM produtos
                WHERE id = :id";

        $consulta = $this->conexao->prepare($sql);

        return $consulta->execute([
            ":id" => $id
        ]);
    }
}
?>