<?php
require_once 'conexao_bdPDO.php';

$id_cliente = $_POST['idCliente'];
//$id_cliente = 3;


$sql = "SELECT * FROM tb_postagem WHERE ID_CLIENTE = :id_cliente";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":id_cliente", $id_cliente);
$stmt->execute();

$pedidosPendentes = [];
$pedidosPagos = [];
$pedidosEntregues = [];

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    // Adiciona cada pedido encontrado ao array de pedidos

    $meusPedidos[] = $row;
    }


echo json_encode(array("pedidos" => $meusPedidos, JSON_UNESCAPED_UNICODE));

?>
