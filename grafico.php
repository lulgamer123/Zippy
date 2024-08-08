<?php


// Configurações do banco de dados
$servername = "zippybd.mysql.dbaas.com.br";
$username = "zippybd";
$password = "C0dingd3vs@";
$dbname = "zippybd";

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die(json_encode(array("error" => "Falha na conexão: " . $conn->connect_error)));
}

// SQL para selecionar os dados
$sql = "SELECT VALOR_TRANSFERIDO, DATA_TRANSFERENCIA FROM `tb_caixa`";
$result = $conn->query($sql);

$data = array();

// Verifica se há resultados
if ($result->num_rows > 0) {
    // Itera sobre os resultados e adiciona ao array de dados
    while ($row = $result->fetch_assoc()) {
        $data[] = array(
            "valor_transferido" => $row["VALOR_TRANSFERIDO"],
            "data_transferencia" => $row["DATA_TRANSFERENCIA"]
        );
    }
}

// Retorna os dados como JSON
echo json_encode($data);

// Fecha a conexão
$conn->close();
?>