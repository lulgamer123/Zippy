<?php
// Obter o email e a senha enviados pelo método POST
$email = $_POST["email"];
$senha = $_POST["senha"];

// $email = "aluis@gmail.com";
// $senha = "1234";



try {
    include("conexao_bdPDO.php");

    $stmt = $pdo->prepare("SELECT EMAIL_USUARIO, SENHA_USUARIO FROM tb_usuario WHERE EMAIL_USUARIO = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        // O email já existe no banco de dados
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        // Comparar a senha enviada com a senha do banco de dados usando a função hash_equals
        if (password_verify($senha, $usuario['SENHA_USUARIO'])) {
            // A senha está correta
            // Retornar "true" como resposta
            $dados = array("status" => "true");
        } else {
            // A senha está incorreta
            // Retornar "false" como resposta
            $dados = array("status" => "false");
        }
    } else {
        // O email não existe
        $dados = array("status" => "loginfake", "login" => "");
    }


    // Retornar a resposta como JSON
    echo json_encode($dados);
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>