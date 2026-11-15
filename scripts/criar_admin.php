
<?php

require_once __DIR__ . "/../config/Database.php";

if (PHP_SAPI !== "cli") {
    exit("Execução permitida somente pelo Terminal.");
}

echo "=== Criar administrador VesteMais ===\n";

echo "Nome: ";
$nome = trim(fgets(STDIN));

echo "E-mail: ";
$email = trim(fgets(STDIN));

echo "Senha (não será exibida): ";
system("stty -echo");
try {
    $senha = rtrim(fgets(STDIN), "\r\n");
} finally {
    system("stty echo");
    echo "\n";
}

if (
    $nome === "" ||
    !filter_var($email, FILTER_VALIDATE_EMAIL) ||
    strlen($senha) < 12
) {
    exit("Dados inválidos. Use uma senha de pelo menos 12 caracteres.\n");
}

$pdo = Database::conectar();

$consulta = $pdo->prepare(
    "SELECT id FROM usuarios WHERE email = :email"
);

$consulta->execute(["email" => $email]);

if ($consulta->fetch()) {
    exit("Este e-mail já está cadastrado.\n");
}

$hash = password_hash($senha, PASSWORD_DEFAULT);

$consulta = $pdo->prepare(
    "INSERT INTO usuarios (nome, email, senha, perfil)
     VALUES (:nome, :email, :senha, 'admin')"
);

$consulta->execute([
    "nome" => $nome,
    "email" => $email,
    "senha" => $hash
]);

echo "Administrador criado com sucesso!\n";
?>