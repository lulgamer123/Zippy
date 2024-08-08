<?php
require_once 'conexao_bdPDO.php';

$paisOrigem = $_POST['paisOrigem'];
$paisDestino = $_POST['paisDestino'];

// $paisOrigem = "russia";
// $paisDestino = "";

$sql = "SELECT * FROM tb_postagem WHERE PAIS_ORIGEM = :paisOrigem AND PAIS_DESTINO = :paisDestino";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":paisOrigem", $paisOrigem);
$stmt->bindParam(":paisDestino", $paisDestino);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Adiciona cada pedido encontrado ao array de pedidos
        $dados = array("status" => "true", "postagens" => $row);
    }
}
else {
    $dados = array("status" => "false");
}


echo json_encode($dados, JSON_UNESCAPED_UNICODE);
