<?php


require_once '../conexao_bd.php';

if(isset($_GET['id_pedido'])){
    $idPedido = $_GET['id_pedido'];

    $sql = "SELECT * FROM tb_postagem WHERE ID_POSTAGEM = :id_pedido";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id_pedido", $idPedido);
    $stmt->execute();

    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    if($resultado['STATUS_POSTAGEM'] == "PAGO"){
        $response = array("status" => "success");
    } else {
        $response = array("status" => "pending");
    }

    echo json_encode($response);
} else {
    $response = array("status" => "error");
    echo json_encode($response);
}