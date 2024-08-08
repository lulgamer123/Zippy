<?php
// Pega o email do POST
$email = $_POST["email"];
// $email = "luis@gmail.com";

// Conexão com o banco de dados (substitua pelos seus próprios dados)
try {
    include("conexao_bdPDO.php");


    // Verifica se o email já existe
    $stmt = $pdo->prepare("SELECT * FROM tb_usuario WHERE EMAIL_USUARIO = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        // O email já existe no banco de dados
        $dados = array("status" => "true", "login" => $email);
    } else {
        // O email não existe
        $dados = array("status" => "false", "login" => "");
    }

    // Retornar a resposta como JSON
    echo json_encode($dados);
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>