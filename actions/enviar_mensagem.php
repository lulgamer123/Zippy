<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "zippy";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Verificar se o ID do chat, o ID do remetente, o ID do destinatário e a mensagem foram recebidos

   

    $chatId = $_POST['chat_id'];
    $remetenteId = $_POST['usuarioId'];
    $destinatarioId = $_POST['numPedido'];
    $mensagem = $_POST['mensagem'];

    // Consulta para inserir a mensagem no banco de dados
    $sql = "INSERT INTO mensagens (chat_id, remetente_id, destinatario_id, mensagem, data_envio) VALUES ('$chatId', '$remetenteId', '$destinatarioId', '$mensagem', NOW())";

    
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array('success' => true));
    } else {
        echo json_encode(array('success' => false, 'message' => 'Erro ao enviar a mensagem: ' . $conn->error));
    }
    exit();

// Fechar conexão
$conn->close();
?>
