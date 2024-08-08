<?php

try {
    // Conexão com o banco de dados (substitua pelos seus próprios dados)
    include("conexao_bdMSQLI.php");
    // $emailUsuario = "luis@gmail.com";
    $emailUsuario = $_POST['email'];

    $sql = "SELECT ID_USUARIO, EMAIL_USUARIO, STATUS_USUARIO, DTA_NASC, FOTO_PERFIL FROM tb_usuario WHERE EMAIL_USUARIO = '$emailUsuario'";
    $resulta = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($resulta)) {
        $dados[]= array($row["ID_USUARIO"], $row["EMAIL_USUARIO"], $row["STATUS_USUARIO"], $row["DTA_NASC"], $row["FOTO_PERFIL"]);
    }

    echo json_encode($dados, JSON_UNESCAPED_SLASHES);


} catch (PDOException $e) {

    $erro = $e->getMessage();


}






?>