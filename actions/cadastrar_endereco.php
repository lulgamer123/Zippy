<?php

session_start();
require_once 'conexao_bd.php';

if (isset($_POST['btn-cadastrar-end'])) {
    $id_usuario = $_SESSION['id_usuario'];
    $rua = $_POST['rua'];
    $bairro = $_POST['bairro'];
    $uf = $_POST['uf'];
    $pais = $_POST['pais'];
    $cidade = $_POST['cidade'];
    $complemento = $_POST['complemento'];
    
   
   
    
   
   

    try {
        $sql = "INSERT INTO tb_endereco (ID_USUARIO,RUA_ENDERECO,BAIRRO_ENDERECO,ESTADO_ENDERECO,PAIS_ENDERECO,CIDADE_ENDERECO,COMPLEMENTO_ENDERECO) 
        VALUES (:id_usuario,:rua,:bairro,:uf,:pais,:cidade,:complemento)";

        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->bindParam(':rua', $rua);
        $stmt->bindParam(':bairro', $bairro);
        $stmt->bindParam(':uf', $uf);
        $stmt->bindParam(':pais', $pais);
        $stmt->bindParam(':cidade', $cidade);
        $stmt->bindParam(':complemento', $complemento);

        $stmt->execute();
        
        if($stmt->rowCount() > 0){
            header('Location: ../pages/perfil.php?sucesso=endereco cadastrado');
        }else{
            header('Location: ../pages/perfil.php?erro=endereco não cadastrado');
        }

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
