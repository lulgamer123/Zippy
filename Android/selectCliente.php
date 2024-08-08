<?php

try {
    // Conexão com o banco de dados (substitua pelos seus próprios dados)
    include("conexao_bdMSQLI.php");


    //$id_usuario = 5;

    $id_usuario = $_POST['idUsuario'];

    $sql = "SELECT ID_USUARIO, EMAIL_USUARIO, DTA_NASC, FOTO_PERFIL FROM tb_usuario WHERE ID_USUARIO = '$id_usuario'";
    $resulta = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($resulta)) {
        $dados[]= array($row["ID_USUARIO"], $row["EMAIL_USUARIO"], $row["DTA_NASC"], $row["FOTO_PERFIL"]);
    }


    $sqlCliente = "SELECT * FROM tb_cliente WHERE ID_USUARIO = '$id_usuario'";
    $resultaCliente = mysqli_query($conn, $sqlCliente);
    $dadosCliente = array();

    while ($row = mysqli_fetch_assoc($resultaCliente)) {
        $dadosCliente[]= array($row["ID_CLIENTE"], $row["ID_USUARIO"], $row["NOME_CLIENTE"], $row["SOBRENOME_CLIENTE"], $row["FONE_CLIENTE"], $row["IDENTIDADE_CLIENTE"]);

    }

      echo json_encode($dadosCliente);

} catch (PDOException $e) {

   $erro = $e->getMessage();

}






?>