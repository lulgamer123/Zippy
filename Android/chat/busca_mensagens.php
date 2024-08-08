<?php

include "../conexao_bdMSQLI.php";

//$chat_id = 13;
$chat_id = $_POST['chatid'];
try {

    $query = "SELECT * FROM tb_mensagens WHERE CHAT_ID = '$chat_id'";
    $resulta = mysqli_query($conn, $query); //recebe o resultado

    $dados=array();

    while ($resultado = $resulta->fetch_assoc()) {
        $dados[] = $resultado;
    }

    echo json_encode(array("mensagens" => $dados));

} catch (Exception $e) {
    echo $e;
}
