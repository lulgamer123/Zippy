<?php

require_once 'conexao_bd.php';

if(isset($_GET['NOME'])){
    $id = $_GET['NOME'];
    $idDenuncia = $_GET['IdDenuncia'];
    
    $sql = "SELECT * FROM tb_cliente WHERE NOME_CLIENTE = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    
    $result = $stmt->fetchAll();
    $idUsuario = $result[0]['ID_CLIENTE'];

    $sql = 'UPDATE tb_usuario SET STATUS_USUARIO = "BLOQUEADO" WHERE ID_USUARIO = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $idUsuario);
    $stmt->execute();

    $sql = "UPDATE tb_denuncia SET STATUS_DENUNCIA = 'Atendido' WHERE ID_DENUNCIA = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $idDenuncia);
    $stmt->execute();

    
    header('Location: ' . $_SERVER['HTTP_REFERER'] . '?bloqueado=true&status=Pendente'); 

   

}