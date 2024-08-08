<?php
session_start();
require_once "../conexao_bd.php";

// Verifica se a solicitação é do tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se a mensagem foi recebida
    if (isset($_POST["mensagem"]) && isset($_POST["chat_id"])) {
        // Captura a mensagem e o chat_id enviados pelo cliente
        $mensagem = $_POST["mensagem"];
        $chat_id = $_POST["chat_id"];

        // Consulta SQL para buscar as informações do chat
        $sql = "SELECT REMETENTE, DESTINATARIO FROM tb_chats WHERE ID_CHAT = :chat_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":chat_id", $chat_id);
        $stmt->execute();
        $chat_info = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifica se o usuário atual é o remetente da conversa
        if ($chat_info['REMETENTE'] == $_SESSION['id_cliente']) {
            // Insere a mensagem no banco de dados mantendo o destinatário atual
            $sql_insert = "INSERT INTO tb_mensagens (REMETENTE, DESTINATARIO, MENSAGEM, DTA_ENVIO, CHAT_ID) VALUES (:remetente, :destinatario, :mensagem, NOW(), :chat_id)";
            $stmt_insert = $pdo->prepare($sql_insert);
            $stmt_insert->bindParam(":remetente", $_SESSION['id_cliente']);
            $stmt_insert->bindParam(":destinatario", $chat_info['DESTINATARIO']);
            $stmt_insert->bindParam(":mensagem", $mensagem);
            $stmt_insert->bindParam(":chat_id", $chat_id);
            $stmt_insert->execute();

            if ($stmt_insert->rowCount() > 0) {
                echo "✓ Mensagem enviada com sucesso!";
            } else {
                echo "✘ Erro: Mensagem não enviada";
            }
        } else {
            // Atualiza os registros na tabela tb_chats para trocar os papéis de remetente e destinatário
            $novo_remetente = $chat_info['DESTINATARIO'];
            $novo_destinatario = $chat_info['REMETENTE'];
            $sql_update = "UPDATE tb_chats SET REMETENTE = :novo_remetente, DESTINATARIO = :novo_destinatario WHERE ID_CHAT = :chat_id";
            $stmt_update = $pdo->prepare($sql_update);
            $stmt_update->bindParam(":novo_remetente", $novo_remetente);
            $stmt_update->bindParam(":novo_destinatario", $novo_destinatario);
            $stmt_update->bindParam(":chat_id", $chat_id);
            $stmt_update->execute();

            // Insere a mensagem no banco de dados com o novo destinatário
            $sql_insert = "INSERT INTO tb_mensagens (REMETENTE, DESTINATARIO, MENSAGEM, DTA_ENVIO, CHAT_ID) VALUES (:remetente, :destinatario, :mensagem, NOW(), :chat_id)";
            $stmt_insert = $pdo->prepare($sql_insert);
            $stmt_insert->bindParam(":remetente", $_SESSION['id_cliente']);
            $stmt_insert->bindParam(":destinatario", $novo_destinatario);
            $stmt_insert->bindParam(":mensagem", $mensagem);
            $stmt_insert->bindParam(":chat_id", $chat_id);
            $stmt_insert->execute();

            if ($stmt_insert->rowCount() > 0) {
                echo "✓ Mensagem enviada com sucesso!";
            } else {
                echo "✘ Erro: Mensagem não enviada";
            }
        }
    } else {
        // Se a mensagem ou chat_id não foram recebidos, retorna uma mensagem de erro
        echo "Erro: Mensagem ou ID do chat não recebidos";
    }
} else {
    
    echo "Erro: Método não suportado";
}
