<?php

require_once 'conexao_bd.php';

if(empty($_GET) ) {
    $sql = "SELECT * FROM tb_denuncia";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();

    foreach ($result as $row) {
        echo "<tr>";
        echo "<td>{$row['ID_DENUNCIA']}</td>";
        echo "<td>{$row['STATUS_DENUNCIA']}</td>";
        echo "<td>{$row['ID_USUARIO']}</td>";
        echo "<td>{$row['DESC_DENUNCIA']}</td>";
        echo "<td>{$row['DTA_DENUNCIA']}</td>";
        echo "<td><a href='../actions/notificar.php?IdDenuncia={$row['ID_DENUNCIA']}&NOME={$row['ID_USUARIO']}&MOTIVO={$row['DESC_DENUNCIA']}' id='btns' class='btn btn-success'>Notificar</a> <a href='../actions/bloquear.php?NOME={$row['ID_USUARIO']}&IdDenuncia={$row['ID_DENUNCIA']}' id='btns'  class='btn btn-danger'>Bloquear Usuario</a></td>";
        echo "</tr>";
    }
}

if (isset($_GET['searchID'])) {
    $sql = "SELECT * FROM tb_denuncia WHERE ID_DENUNCIA = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $_GET['searchID']);
    $stmt->execute();
    $result = $stmt->fetchAll();

    foreach ($result as $row) {
        echo "<tr>";
        echo "<td>{$row['ID_DENUNCIA']}</td>";
        echo "<td>{$row['STATUS_DENUNCIA']}</td>";
        echo "<td>{$row['ID_USUARIO']}</td>";
        echo "<td>{$row['DESC_DENUNCIA']}</td>";
        echo "<td>{$row['DTA_DENUNCIA']}</td>";
        echo "<td><a href='../actions/notificar.php?IdDenuncia={$row['ID_DENUNCIA']}&NOME={$row['ID_USUARIO']}&MOTIVO={$row['DESC_DENUNCIA']}' class='btn btn-success'>Notificar</a> <a href='../actions/bloquear.php?NOME={$row['ID_USUARIO']}&IdDenuncia={$row['ID_DENUNCIA']}' class='btn btn-danger'>Bloquear Usuario</a></td>";
        echo "</tr>";
    }
}

if(isset($_GET['status'])) {
    $sql = "SELECT * FROM tb_denuncia WHERE STATUS_DENUNCIA = :status";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':status', $_GET['status']);
    $stmt->execute();
    $result = $stmt->fetchAll();

    foreach ($result as $row) {
        echo "<tr>";
        echo "<td>{$row['ID_DENUNCIA']}</td>";  
        echo "<td>{$row['STATUS_DENUNCIA']}</td>";
        echo "<td>{$row['ID_USUARIO']}</td>";
        echo "<td>{$row['DESC_DENUNCIA']}</td>";
        echo "<td>{$row['DTA_DENUNCIA']}</td>";
        echo "<td><a href='../actions/notificar.php?IdDenuncia={$row['ID_DENUNCIA']}&NOME={$row['ID_USUARIO']}&MOTIVO={$row['DESC_DENUNCIA']}' class='btn btn-success'>Notificar</a> <a href='../actions/bloquear.php?NOME={$row['ID_USUARIO']}&IdDenuncia={$row['ID_DENUNCIA']}' class='btn btn-danger'>Bloquear Usuario</a></td>";
        echo "</tr>";
    }
}
