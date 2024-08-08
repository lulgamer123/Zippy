<?php
session_start();
require_once 'conexao_bd.php';

if(isset($_POST['btn-atualizar'])){


    try{
        $id_cliente = $_SESSION['id_cliente'];
        $nome = $_POST['nome'];
        $sobrenome = $_POST['sobrenome'];
        $email = $_POST['email'];
        $tel = $_POST['tel'];
        $senha = $_POST['senha'];
        $hash = password_hash($senha, PASSWORD_DEFAULT);
    
        $sql = "UPDATE tb_cliente SET NOME_CLIENTE = :nome, SOBRENOME_CLIENTE = :sobrenome, FONE_CLIENTE = :tel WHERE ID_CLIENTE = :id_cliente";
    
        $smtp = $pdo->prepare($sql);
        $smtp->bindParam(':nome', $nome);
        $smtp->bindParam(':sobrenome', $sobrenome);
        $smtp->bindParam(':tel', $tel); 
        $smtp->bindParam(':id_cliente', $id_cliente);
        $smtp->execute();
    
        $sql2 = "UPDATE tb_usuario SET EMAIL_USUARIO = :email, SENHA_USUARIO = :senha WHERE ID_USUARIO = :id_cliente";
    
        $smtp2 = $pdo->prepare($sql2);
        $smtp2->bindParam(':email', $email);
        $smtp2->bindParam(':senha', $hash);
        $smtp2->bindParam(':id_cliente', $id_cliente);
        $smtp2->execute();
    
        if($smtp->rowCount() > 0 && $smtp2->rowCount() > 0){
            $_SESSION['nome'] = $nome;
            $_SESSION['sobrenome'] = $sobrenome;
            $_SESSION['email'] = $email;
            $_SESSION['fone'] = $tel;
            header('Location: ../pages/perfil.php?sucesso=Atualizado com sucesso');
        }

    }catch(PDOException $e){
        $erro = $e->getMessage();
        header('Location: ../pages/perfil.php?erro=Erro ao atualizar');
    }

 
   
    }