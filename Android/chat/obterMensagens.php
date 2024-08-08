<?php

require "../conexao_bdPDO.php";

$usuario = $_POST['remetente'];
$usuarioDestino = $_POST['destinatario'];
$chat_id = $_POST['chatid'];



// PARA PRUEBAS
// $usuario = 1;
// $usuarioDestino = 2;
try {


    $sql_chat = "SELECT ID_CHAT, NOME_REMETENTE, NOME_DESTINATARIO FROM `tb_chats` WHERE `REMETENTE` = :remetente AND DESTINATARIO = :destinatario OR `REMETENTE` = :remetente2 AND DESTINATARIO = :destinatario2 ";
    
    $stmt = $pdo->prepare($sql_chat);
    $stmt->bindParam(':remetente', $usuario);
    $stmt->bindParam(':destinatario', $usuarioDestino);
    $stmt->bindParam(':remetente2', $usuarioDestino);
    $stmt->bindParam(':destinatario2', $usuario);
    $stmt->execute();
    $dadosCliente = array();

    while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $id_chat = $linha['ID_CHAT'];
        $nome_remetente = $linha['NOME_REMETENTE'];
        $nome_destinatario = $linha['NOME_DESTINATARIO'];

        $dadosCliente[] = $linha;
    }

    //echo $id_chat . "|" . $nome_remetente . "|" . $nome_destinatario;

    $sql = "SELECT * FROM tb_mensagens WHERE CHAT_ID = :chat_id ORDER BY DTA_ENVIO";
    $stmt2 = $pdo->prepare($sql);
    $stmt2->bindParam(":chat_id", $id_chat);
    $stmt2->execute();
    $dados = array();


    if ($stmt2->rowCount() > 0) {
        while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
            // Adiciona cada pedido encontrado ao array de pedidos
            $dados[] = $row;
        }
    }

    echo json_encode(array("mensagens" => $dados, "dadosCliente" => $dadosCliente ), JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    echo json_encode($e);
}


    
    // $sql = "SELECT CHAT_ID FROM `tb_mensagens` WHERE `REMETENTE` = :remetente AND DESTINATARIO = :destinatario OR `REMETENTE` = :remetente2 AND DESTINATARIO = :destinatario2 ";
    // $stmt = $pdo->prepare($sql);
    // $stmt->bindParam(':remetente', $usuario);
    // $stmt->bindParam(':destinatario', $usuarioDestino);
    // $stmt->bindParam(':remetente2', $usuarioDestino);
    // $stmt->bindParam(':destinatario2', $usuario);