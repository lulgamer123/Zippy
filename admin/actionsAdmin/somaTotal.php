<?php

require 'conexao_bd.php';

try {
    if (isset($_POST['agrupar'])) {
        $agrupar = $_POST['agrupar'];
        if ($agrupar == 1) {
            $sql = "SELECT 
            DATE(DATA_TRANSFERENCIA) AS DATA,
            SUM(VALOR_TRANSFERIDO) AS TOTAL_TRANSFERIDO
            FROM 
            tb_caixa
            GROUP BY 
            DATE(DATA_TRANSFERENCIA)
            ORDER BY 
            DATA;
            ";
        } else if ($agrupar == 2) {
            $sql = "SELECT 
            DATE(DATA_TRANSFERENCIA) AS DATA,
            SUM(VALOR_TRANSFERIDO) AS TOTAL_TRANSFERIDO
            FROM 
            tb_caixa
            GROUP BY 
            DATE(DATA_TRANSFERENCIA)
            ORDER BY 
            TOTAL_TRANSFERIDO ASC;
            ";
        } else {
            $sql = "SELECT * FROM tb_caixa ORDER BY DATA_TRANSFERENCIA DESC";
        }
    }
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $caixa = $stmt->fetchAll(PDO::FETCH_ASSOC);



    // Formatar datas
    foreach ($caixa as &$linha) {
        if (isset($linha['DATA'])) {
            $linha['DATA'] = date('d/m/Y', strtotime($linha['DATA']));
        }   
        if (isset($linha['DATA_TRANSFERENCIA'])) {
            $linha['DATA_TRANSFERENCIA'] = date('d/m/Y', strtotime($linha['DATA_TRANSFERENCIA']));
        }
    }

    echo json_encode($caixa);
} catch (Exception $e) {
    echo $e->getMessage();
}
