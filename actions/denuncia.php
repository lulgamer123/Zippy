<?php
require_once 'conexao_bd.php';


if(isset($_POST['btn-denuncia'])){

    $nomeDenuciado = $_POST['nome_denuciado'];
    $idPostagem = $_POST['id_postagem'];
    $mensagem = $_POST['mensagem'];

    $sql = "INSERT INTO tb_denuncia (ID_USUARIO, DESC_DENUNCIA,DTA_DENUNCIA, STATUS_DENUNCIA, ID_POSTAGEM) VALUES (:nomeDenuciado, :mensagem, NOW(),'Pendente', :idPostagem)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nomeDenuciado', $nomeDenuciado);
    $stmt->bindParam(':mensagem', $mensagem);
    $stmt->bindParam(':idPostagem', $idPostagem);
    
    $stmt->execute();

    //pegar o id da denuncia
    $idDenuncia = $pdo->lastInsertId();

    if($stmt->rowCount() > 0){
        header('Location: ' . $_SERVER['HTTP_REFERER'] . '&denuncia=success'. '&idDenuncia='.$idDenuncia);
    }else{
        header('Location: ' . $_SERVER['HTTP_REFERER'] . '&denuncia=error');
    }
}