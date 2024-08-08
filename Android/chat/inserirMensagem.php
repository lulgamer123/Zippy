<?php

include "../conexao_bdPDO.php";

$remetente = $_POST['remetente'];
$destinatario = $_POST['destinatario'];
$mensagem = $_POST['mensagem'];


// PARA PRUEBAS
// $remetente = 10;
// $destinatario = 2;
// $mensagem = "salve";
// $chatId = 21;


if (empty($remetente) || empty($destinatario) || empty($mensagem)) {
    echo "No puedes entrar";
} else {
    try {

        $sql_chat = "SELECT ID_CHAT FROM `tb_chats` WHERE `REMETENTE` = :remetente AND DESTINATARIO = :destinatario OR `REMETENTE` = :remetente2 AND DESTINATARIO = :destinatario2 ";

        $stmt_chatId = $pdo->prepare($sql_chat);
        $stmt_chatId->bindParam(':remetente', $remetente);
        $stmt_chatId->bindParam(':destinatario', $destinatario);
        $stmt_chatId->bindParam(':remetente2', $destinatario);
        $stmt_chatId->bindParam(':destinatario2', $remetente);
        $stmt_chatId->execute();
        $id_chat = $stmt_chatId->fetchColumn();

        $sql = "INSERT INTO tb_mensagens (REMETENTE, DESTINATARIO, MENSAGEM, DTA_ENVIO, CHAT_ID) VALUES( :remetente, :destinatario, :mensagem, NOW(), :chatid)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':remetente', $remetente);
        $stmt->bindParam(':destinatario', $destinatario);
        $stmt->bindParam(':mensagem', $mensagem);
        $stmt->bindParam(':chatid', $id_chat);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {

            $dados = array("status" => "ok");
        } else {
            $dados = array("status" => "erro");
        }
        echo json_encode($dados);
    } catch (PDOException $e) {

        $erro = $e->getMessage();
        echo json_encode($erro);
    }
}
