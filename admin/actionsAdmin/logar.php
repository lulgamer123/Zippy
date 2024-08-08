<?php

require_once('../../actions/conexao_bd.php');

try{
    if(isset($_POST['btn-login'])) {
        $email = $_POST['loginEmail'];
        $senha = $_POST['loginSenha'];
    
        $sql = "SELECT * FROM tb_usuario_adm WHERE EMAIL_USUARIO_ADM = '$email' AND SENHA_USUARIO_ADM = '$senha'";
        $result = $pdo->query($sql);
        $rows = $result->fetchAll();
    
        if(count($rows) > 0) {
            session_start();
            $_SESSION['email'] = $email;
            $_SESSION['senha'] = $senha;
            header('Location: ../admin.php');
        } else {
            header('Location: ../index.php?login=false');
        }
    }
}catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}