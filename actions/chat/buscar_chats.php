<?php


require_once "../actions/conexao_bd.php";

// Verifica se o usuário está logado
if (isset($_SESSION["id_usuario"])) {
    $id_usuario = $_SESSION["id_usuario"];

    // Query para buscar os chats do usuário
    $sql = "SELECT * FROM tb_chats
            WHERE REMETENTE = :id_usuario_remetente OR DESTINATARIO = :id_usuario_destinatario";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id_usuario_remetente", $id_usuario);
    $stmt->bindParam(":id_usuario_destinatario", $id_usuario);
    $stmt->execute();

    // Array para armazenar os chats do usuário
    $chats = [];

    // Verifica se existem chats encontrados
    if ($stmt->rowCount() > 0) {
        // Adiciona os chats encontrados ao array
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $chats[] = $row; // Adiciona toda a linha do chat ao array
        }
    }

    // Armazena o array de chats na sessão
    $_SESSION["chats"] = $chats;
}
