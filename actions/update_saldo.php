<?php

require_once 'conexao_bd.php';

if(isset($_GET['id_usuario'])){
    $id_usuario = $_GET['id_usuario'];
    
    $sql = "SELECT * FROM tb_cliente WHERE ID_USUARIO = :id_usuario";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_usuario', $id_usuario);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $saldo = $result['SALDO'];

    $response = array(
        'saldo' => $saldo
    );

    echo json_encode($response);

}