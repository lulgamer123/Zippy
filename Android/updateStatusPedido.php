<?php

require_once 'conexao_bdPDO.php';

    $idPedido = $_POST['idPedido'];

    $sql = "UPDATE tb_postagem SET STATUS_POSTAGEM = 'Pago' WHERE ID_POSTAGEM = :id_pedido";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id_pedido", $idPedido);
    $stmt->execute();

    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($stmt->rowCount() > 0) {
        $response = array("status" => "ok");

    } else {
        $response = array("status" => "erro");
    }


    echo json_encode($response);
