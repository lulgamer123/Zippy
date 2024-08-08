<?php

include "../conexao_bdPDO.php";

$usuario = $_POST['idusuario'];
// PRUEBAS
// $usuario = $_POST['remetente'];
// $usuarioDestino = $_POST['destinatario'];

//$usuario = 4;
// $usuarioDestino = 6;

try {
    $sql = "SELECT * FROM `tb_chats` WHERE `REMETENTE` = :remetente OR `DESTINATARIO` = :remetente2";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':remetente', $usuario);
    $stmt->bindParam(':remetente2', $usuario);

    $stmt->execute();

    $dados = array();

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // Adiciona cada pedido encontrado ao array de pedidos
                $dados[] = $row;
            }
        }

    echo json_encode(array("dados" => $dados));
} catch (Exception $e) {
    echo $e;
}
