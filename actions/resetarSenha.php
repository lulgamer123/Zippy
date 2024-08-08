<?php

require_once 'conexao_bd.php';

var_dump($_POST);

try {
    if (isset($_POST['btn-cadastrar']) && isset($_POST['senha'])) {
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $senha = password_hash($senha, PASSWORD_DEFAULT);
    
        try {
            $sql = "UPDATE tb_usuario SET SENHA_USUARIO = :senha WHERE EMAIL_USUARIO = :email";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':senha', $senha);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
    
            if ($stmt->rowCount() > 0) {
                echo "Senha cadastrada com sucesso!";
                header("Location: ../pages/autenticacao/login.php?sucesso=senhaCadastrada");
            } else {
                echo "Erro ao cadastrar senha! Nenhuma linha foi afetada.";
            }
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    } else {
        echo "Erro ao cadastrar senha! Dados insuficientes.";
    }
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}

