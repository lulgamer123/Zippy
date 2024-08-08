<?php
require_once '../conexao_bd.php';

// Verifica se os cookies estão definidos
if (isset($_COOKIE['idPedido']) && isset($_COOKIE['valor'])) {

    $idPedido = $_COOKIE['idPedido'];
    $valor = $_COOKIE['valor'];
    $remetente = $_COOKIE['remetente'];
    $destinatario = $_COOKIE['destinatario'];
    $idChat = $_COOKIE['chatID'];
    $pagador = $_COOKIE['pagador'];

    // Determina o comprador e o vendedor com base no pagador
    if ($remetente == $pagador) {
        $idComprador = $remetente;
        $idVendedor = $destinatario;
    } else {
        $idComprador = $destinatario;
        $idVendedor = $remetente;
    }

    // Insere na tabela de transacoes
    $sqlTransacao = "INSERT INTO tb_transacoes (ID_COMPRADOR, ID_VIAJANTE, ID_CHAT,ID_PEDIDO, VALOR_TOTAL) VALUES (:idComprador, :idViajante, :idChat,:idPedido, :valor)";
    $stmtTransacao = $pdo->prepare($sqlTransacao);
    $stmtTransacao->bindParam(':idComprador', $idComprador);
    $stmtTransacao->bindParam(':idViajante', $idVendedor);
    $stmtTransacao->bindParam(':idChat', $idChat);
    $stmtTransacao->bindParam(':idPedido', $idPedido);
    $stmtTransacao->bindParam(':valor', $valor);
    $stmtTransacao->execute();

    // Atualiza a postagem
    $sqlAtualizacao = "UPDATE tb_postagem SET STATUS_POSTAGEM = 'PAGO' WHERE ID_POSTAGEM = :idPedido";
    $stmtAtualizacao = $pdo->prepare($sqlAtualizacao);
    $stmtAtualizacao->bindParam(':idPedido', $idPedido);
    $stmtAtualizacao->execute();

    if ($stmtTransacao->rowCount() > 0 && $stmtAtualizacao->rowCount() > 0) {
        header('Location: ../../pages/checkout.php?ID_PEDIDO=' . $idPedido . '&PAGAMENTO=success' . '&VALOR=' . $valor);
        exit(); 
    } else {
        echo "Erro ao processar o pagamento.";
    }
} else {
    echo "Dados do formulário não encontrados.";
}
?>
