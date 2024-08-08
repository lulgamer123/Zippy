<?php
try {

    // Conexão com o banco de dados (substitua pelos seus próprios dados)
    include("conexao_bdPDO.php");

    // $id_usuario = "5";
    // $novoEmail = "aluiz@gmail.com";
    // $novaSenha = "1234";
    // $novaDtaNasc = "2006-10-05";

    $id_usuario = $_POST['idUsuario'];
    $novoEmail = $_POST['novoEmail'];
    $novaSenha = $_POST['novaSenha'];
    $novaDtaNasc = $_POST['novaDtaNasc'];
    $hash = password_hash($novaSenha, PASSWORD_DEFAULT);


    $sql = "UPDATE tb_usuario SET EMAIL_USUARIO = IFNULL(:emailModificado, EMAIL_USUARIO), SENHA_USUARIO = IFNULL(:senhaModificada, SENHA_USUARIO), DTA_NASC = IFNULL(:dataModificada, DTA_NASC) WHERE ID_USUARIO = :id_usuario";

    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':emailModificado', $novoEmail);
    $stmt->bindParam(':senhaModificada', $hash);
    $stmt->bindParam(':dataModificada', $novaDtaNasc);
    $stmt->bindParam(':id_usuario', $id_usuario);

    $stmt->execute();

    if ($stmt->rowCount() > 0) {

        $dados = array("status" => "ok");

    } else {
        $dados = array("status" => "erro");

    }


} catch (Exception $e) {

    echo $e->getMessage();
}

echo json_encode($dados);

    ?>