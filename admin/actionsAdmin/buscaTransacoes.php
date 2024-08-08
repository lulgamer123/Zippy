<?php

require 'conexao_bd.php';

$sql = "SELECT * FROM tb_caixa ORDER BY DATA_TRANSFERENCIA DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$caixa = $stmt->fetchAll(PDO::FETCH_ASSOC);

