<?php
require_once 'conexao_bdPDO.php';

$id_pedido = $_POST['idPedido'];
//$id_pedido = 22;


$sql = "SELECT * FROM tb_postagem WHERE ID_POSTAGEM = :id_pedido";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":id_pedido", $id_pedido);
$stmt->execute();

$resultado = $stmt->fetch(PDO::FETCH_ASSOC);
$idCliente = $resultado['ID_CLIENTE'];

if ($resultado['STATUS_POSTAGEM'] == "PAGO") {
    $response = array("status" => "PAGO", "remetente" => $idCliente);
} else {
    $response = array("status" => "PENDENTE", "remetente" => $idCliente);
}

echo json_encode($response);

?>
