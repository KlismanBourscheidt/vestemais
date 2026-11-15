
<?php

require_once __DIR__ . "/../../config/Database.php";

class Categoria {

    private $conexao;

    public function __construct() {

        $this->conexao = Database::conectar();

    }

    public function listar() {

        $sql = "SELECT id, nome
                FROM categorias
                ORDER BY nome ASC";

        $consulta = $this->conexao->prepare($sql);

        $consulta->execute();

        return $consulta->fetchAll();
    }

    public function existe($id) {

        $sql = "SELECT COUNT(*)
                FROM categorias
                WHERE id = :id";

        $consulta = $this->conexao->prepare($sql);

        $consulta->execute([
            ":id" => $id
        ]);

        return (int) $consulta->fetchColumn() > 0;
    }
}
