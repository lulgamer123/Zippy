<?php

global $pdo;
require_once 'conexao_bd.php';

//verifica se botao btn-cadastrar foi clicado
if (isset($_POST['btn-cadastrar'])) {

    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $identidade = $_POST['identidade'];
    $senha = $_POST['senha'];
    $dtaNasc = $_POST['dtaNasc'];
    $status = "ATIVO";
    $hash = password_hash($senha, PASSWORD_DEFAULT);


    try {

        $sql = "INSERT INTO tb_usuario (EMAIL_USUARIO,SENHA_USUARIO,STATUS_USUARIO,DTA_NASC) VALUES (:email, :senha, :status, :dtaNasc)";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $hash);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':dtaNasc', $dtaNasc);
        $stmt->execute();

        $id_usuario = $pdo->lastInsertId();

        $sql2 = "INSERT INTO tb_cliente (ID_USUARIO,NOME_CLIENTE,SOBRENOME_CLIENTE,FONE_CLIENTE,IDENTIDADE_CLIENTE) VALUES (:id_usuario,:nome,:sobrenome,:tel,:identidade)";

        $stmt2 = $pdo->prepare($sql2);
        $stmt2->bindParam(':id_usuario', $id_usuario);
        $stmt2->bindParam(':nome', $nome);
        $stmt2->bindParam(':sobrenome', $sobrenome);
        $stmt2->bindParam(':tel', $tel);
        $stmt2->bindParam(':identidade', $identidade);
        $stmt2->execute();

        header('Location: ../pages/autenticacao/login.php?sucesso=Cadastrado com sucesso');
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
      
       
    }
}
