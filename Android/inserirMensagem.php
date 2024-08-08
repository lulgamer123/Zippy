<?php

    include "../conexao_bdMSQLI.php";
    
    $remetente = $_POST['remetente'];
    $destinatario = $_POST['destinatario'];
    $msg = $_POST['mensagem'];
    $chatId = $_POST['chatid'];

    
    // PARA PRUEBAS
    //$usuario = "laura";
    //$usuarioDestino = "cheko";
    //$mensaje = "Bien y tu?";
    
    if(empty($usuario) || empty($usuarioDestino) || empty($mensaje)) {
        echo "No puedes entrar";
    } else {
        $query = "INSERT INTO tb_mensagens VALUES( '$remetente', '$destinatario', '$msg', NOW(), $chatId";
        $result = $mysqli->query($query);
        
        echo json_encode(array("mensagem Enviada!"));
    }
?>
