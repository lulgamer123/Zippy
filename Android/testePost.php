<?php
include 'conexao_bdPDO.php';



// $paisOrigem = "Russia";
// $paisDestino = "japao";
$paisOrigem = $_POST["paisOrigem"];
$paisDestino = $_POST["paisDestino"];

$sql = "SELECT * FROM tb_postagem WHERE PAIS_ORIGEM = :paisOrigem AND PAIS_DESTINO = :paisDestino";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":paisOrigem", $paisOrigem);
$stmt->bindParam(":paisDestino", $paisDestino);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Adiciona cada pedido encontrado ao array de pedidos
        $dados[] = $row;
    }
}
else {
}


echo json_encode(array("postagens" => $dados), JSON_UNESCAPED_UNICODE);
