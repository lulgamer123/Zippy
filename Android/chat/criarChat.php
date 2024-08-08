<?php

require_once '../conexao_bdPDO.php';

    $remetente = $_POST['remetente'];
    $destinatario = $_POST['destinatario'];
    $id_postagem = $_POST['id_pedido'];

    // $remetente = 5;
    // $destinatario = 8;
    // $id_postagem = 11;

    // Verifica se o chat já existe
    $sql_verificar = "SELECT COUNT(*) FROM tb_chats WHERE REMETENTE = :remetente AND DESTINATARIO = :destinatario";
    $stmt_verificar = $pdo->prepare($sql_verificar);
    $stmt_verificar->bindParam(':remetente', $remetente);
    $stmt_verificar->bindParam(':destinatario', $destinatario);
    $stmt_verificar->execute();

    $chat_existente = $stmt_verificar->fetchColumn();

    if ($chat_existente > 0) {
        // Se o chat já existe, redireciona com mensagem de erro
        echo json_encode(array("result" => "chat ja existe!"));
        exit(); 
    }

    // Recupera os nomes do remetente e destinatário da tabela tb_clientes
    $sql_dados_remetente = "SELECT NOME_CLIENTE FROM tb_cliente WHERE ID_CLIENTE = :remetente";
    $stmt_dados_remetente = $pdo->prepare($sql_dados_remetente);
    $stmt_dados_remetente->bindParam(':remetente', $remetente);
    $stmt_dados_remetente->execute();
    $nome_remetente = $stmt_dados_remetente->fetchColumn();

    $sql_dados_destinatario = "SELECT NOME_CLIENTE FROM tb_cliente WHERE ID_CLIENTE = :destinatario";
    $stmt_dados_destinatario = $pdo->prepare($sql_dados_destinatario);
    $stmt_dados_destinatario->bindParam(':destinatario', $destinatario);
    $stmt_dados_destinatario->execute();
    $nome_destinatario = $stmt_dados_destinatario->fetchColumn();

    // Insere os dados na tabela de chats
    $sql = "INSERT INTO tb_chats (REMETENTE,DESTINATARIO,DTA_CRIACAO,NOME_REMETENTE, NOME_DESTINATARIO,ID_PEDIDO) VALUES (:remetente, :destinatario, NOW(), :nome_remetente, :nome_destinatario, :id_postagem)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':remetente', $remetente);
    $stmt->bindParam(':destinatario', $destinatario);
    $stmt->bindParam(':nome_remetente', $nome_remetente);
    $stmt->bindParam(':nome_destinatario', $nome_destinatario);
    $stmt->bindParam(':id_postagem', $id_postagem);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo json_encode(array("result" => "sucesso", "idChat"=> $pdo->lastInsertId()));
    } else {
        echo json_encode(array("result" => "erro ao criar chat!"));
    }

