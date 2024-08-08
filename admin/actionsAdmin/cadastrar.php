<?php
require_once('../../actions/conexao_bd.php');

if(isset($_POST['btn-register'])) {
    $email = $_POST['registerEmail'];
    $senha = $_POST['registerSenha'];

    try{
        $sql = "INSERT INTO tb_usuario_adm (EMAIL_USUARIO_ADM, SENHA_USUARIO_ADM, STATUS_USUARIO_ADM) VALUES ('$email', '$senha', 'Ativo')";
    $result = $pdo->query($sql);

    if($result) {
        header('Location: ../index.php?cadastrado=true');
    } else {
       header('Location: ../index.php?cadastrado=false');
    }
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }

    
}