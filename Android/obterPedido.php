<?php 
require "conexao_bdPDO.php";

$idPedido = $_POST["idPedido"];
//$idPedido = 23;
try {
    $sql = "SELECT * FROM tb_postagem WHERE ID_POSTAGEM = :id_pedido";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id_pedido", $idPedido);
    $stmt->execute();
    $dados = array();

    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Adiciona cada pedido encontrado ao array de pedidos
            $dados[] = $row;
        }
    }

    echo json_encode(array("status" => "true", "Pedido" => $dados), JSON_UNESCAPED_UNICODE);

}catch (Exception $e) {
    echo json_encode($e);
}

