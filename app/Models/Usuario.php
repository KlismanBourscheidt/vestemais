
<?php

require_once __DIR__ . "/../../config/Database.php";

class Usuario {

    private $conexao;

    public function __construct() {

        $this->conexao = Database::conectar();
    }

    public function buscarPorEmail($email) {

        $sql = "SELECT id, nome, email, senha, perfil
                FROM usuarios
                WHERE email = :email
                LIMIT 1";

        $consulta = $this->conexao->prepare($sql);

        $consulta->bindValue(":email", $email);

        $consulta->execute();

        return $consulta->fetch();
    }

    public function verificarLogin($email, $senha) {

        $usuario = $this->buscarPorEmail($email);

        if (!$usuario) {
            return false;
        }

        if (!password_verify($senha, $usuario["senha"])) {
            return false;
        }

        return [
            "id" => $usuario["id"],
            "nome" => $usuario["nome"],
            "email" => $usuario["email"],
            "perfil" => $usuario["perfil"]
        ];
    }
}
?>