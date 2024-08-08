<?php
require_once "conexao_bd.php";

if (isset($_POST['btn-conf'])) {
    $idPedido = $_POST['idPedido'];
    $identidade = $_POST['identidade'];

    // Verifique se os valores estão definidos e não estão vazios
    if (empty($idPedido) || empty($identidade)) {
        echo "<script>alert('ID do pedido ou identidade não podem estar vazios!')</script>";
        exit;
    }

    try {
        $sql = "SELECT * FROM tb_postagem WHERE ID_POSTAGEM = :idPedido";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':idPedido', $idPedido, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $pedido = $stmt->fetch(PDO::FETCH_ASSOC);
            $idCliente = $pedido['ID_CLIENTE'];

            $sql2 = "SELECT * FROM tb_cliente WHERE ID_CLIENTE = :idCliente";
            $stmt2 = $pdo->prepare($sql2);
            $stmt2->bindParam(':idCliente', $idCliente, PDO::PARAM_INT);
            $stmt2->execute();

            if ($stmt2->rowCount() > 0) {
                $cliente = $stmt2->fetch(PDO::FETCH_ASSOC);

                if ($cliente['IDENTIDADE_CLIENTE'] == $identidade) {
                    // Marcar a postagem como entregue
                    $sql3 = "UPDATE tb_postagem SET STATUS_POSTAGEM = 'ENTREGUE' WHERE ID_POSTAGEM = :idPedido";
                    $stmt3 = $pdo->prepare($sql3);
                    $stmt3->bindParam(':idPedido', $idPedido, PDO::PARAM_INT);
                    $stmt3->execute();

                    // Identificar a transação associada ao pedido
                    $sql4 = "SELECT * FROM tb_transacoes WHERE ID_PEDIDO = :idPedido";
                    $stmt4 = $pdo->prepare($sql4);
                    $stmt4->bindParam(':idPedido', $idPedido, PDO::PARAM_INT);
                    $stmt4->execute();

                    if ($stmt4->rowCount() > 0) {
                        $transacao = $stmt4->fetch(PDO::FETCH_ASSOC);
                        $valorTotal = $transacao['VALOR_TOTAL'];
                        $idViajante = $transacao['ID_VIAJANTE'];
                        $idTransacao = $transacao['ID_TRANSACAO'];
                        $observacoes = 'Transferência de 5% do valor da transação';

                        // Desconte 10% do valor total da transação
                        $valorDeduzido = $valorTotal * 0.10;

                        // Calcule 5% do valor total da transação para o caixa da empresa
                        $valorParaCaixa = $valorTotal * 0.05;

                        // Atualizar o saldo do viajante
                        $sql5 = "UPDATE tb_cliente SET SALDO = SALDO + :valorDeduzido WHERE ID_CLIENTE = :idViajante";
                        $stmt5 = $pdo->prepare($sql5);
                        $stmt5->bindParam(':valorDeduzido', $valorDeduzido, PDO::PARAM_STR);
                        $stmt5->bindParam(':idViajante', $idViajante, PDO::PARAM_INT);
                        $stmt5->execute();

                        // Inserir o valor no caixa da empresa
                        $sql6 = "INSERT INTO tb_caixa (ID_PEDIDO, VALOR_TRANSFERIDO, ID_TRANSACAO, OBSERVACOES) VALUES (:idPedido, :valorParaCaixa, :idTransacao, :observacoes)";
                        $stmt6 = $pdo->prepare($sql6);
                        $stmt6->bindParam(':idPedido', $idPedido, PDO::PARAM_INT);
                        $stmt6->bindParam(':valorParaCaixa', $valorParaCaixa, PDO::PARAM_STR);
                        $stmt6->bindParam(':idTransacao', $idTransacao, PDO::PARAM_INT);
                        $stmt6->bindParam(':observacoes', $observacoes, PDO::PARAM_STR);
                        $stmt6->execute();
                        
                        header("Location: ../pages/confEntrega.php?entrega=success");
                    } else {
                        header("Location: ../pages/confEntrega.php?entrega=error&erro=transacao_nao_encontrada");
                    }
                } else {
                    header("Location: ../pages/confEntrega.php?entrega=error&erro=identidade_errada");
                }
            } else {
                header("Location: ../pages/confEntrega.php?entrega=error&erro=cliente_nao_encontrado");
            }
        } else {
            header("Location: ../pages/confEntrega.php?entrega=error&erro=pedido_nao_encontrado");
        }
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}
