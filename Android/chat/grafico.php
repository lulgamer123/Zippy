
<?php
header('Content-Type: application/json');

// Configurações do banco de dados
$host = '186.202.152.71'; 
$username = "zippybd";
$password = "C0dingd3vs@";
$dbname = "zippybd";

// Cria a conexão
$conn = new mysqli($host, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die(json_encode(array("error" => "Falha na conexão: " . $conn->connect_error)));
}

// SQL para selecionar os dados
$sql = "SELECT VALOR_TRANSFERIDO, DATA_TRANSFERENCIA FROM `tb_caixa`";
$result = $conn->query($sql);

$data = array();

// Verifica se a consulta foi executada com sucesso
if ($result === false) {
    die(json_encode(array("error" => "Erro na consulta: " . $conn->error)));
}

// Verifica se há resultados
if ($result->num_rows > 0) {
    // Itera sobre os resultados e adiciona ao array de dados
    while ($row = $result->fetch_assoc()) {
        $data_transferencia = date("d-m-Y", strtotime($row["DATA_TRANSFERENCIA"]));
        $data[] = array(
            "valor_transferido" => $row["VALOR_TRANSFERIDO"],
            "data_transferencia" => $data_transferencia
        );
    }
} else {
    // Caso não haja resultados
    $data[] = array("message" => "Nenhum dado encontrado");
}

// Retorna os dados como JSON
echo json_encode($data);

// Fecha a conexão
$conn->close();
?>
