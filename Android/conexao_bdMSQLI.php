<?php

// Defina as credenciais de acesso ao banco de dados
$db_host = "186.202.152.71"; // Nome do host do banco de dados
$db_name = "zippybd"; // Nome do banco de dados
$db_user = "zippybd"; // Usuário do banco de dados
$db_pass = "C0dingd3vs@"; // Senha do banco de dados

// Crie a conexão com o banco de dados
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Verifique se a conexão foi bem-sucedida
if (!$conn) {
    die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
}

// Se a conexão for bem-sucedida, defina a variável global $conn para ser utilizada em outros arquivos
global $conn;
