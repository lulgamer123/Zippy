<?php

require_once "conexao_bd.php";

$sql =  "SELECT * FROM tb_postagem WHERE ID_CLIENTE = {$_SESSION['id_usuario']}";


$stmt = $pdo->query($sql);

$pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);

$_SESSION['meusPedidos'] = $pedidos;
