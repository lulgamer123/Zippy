<?php
try {

    // Conexão com o banco de dados (substitua pelos seus próprios dados)
    include("conexao_bdPDO.php");

    // $emailCliente = "aluiz5342@gmail.com";
    // $nomeCliente = "Luiz";
    // $sobrenomeCliente = "CLEBER2";
    // $foneCliente = 123;

    $emailCliente = $_POST['email'];
    $nomeCliente = $_POST['nome'];
    $sobrenomeCliente = $_POST['sobrenome'];
    $foneCliente = $_POST['fone'];

    $sql = 'SELECT * FROM tb_usuario WHERE EMAIL_USUARIO = :emailCliente';

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':emailCliente', $emailCliente);
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        $id_usuario = $row['ID_USUARIO'];
    }

    //echo $id_usuario;

    $sql2 = "UPDATE tb_cliente SET NOME_CLIENTE = IFNULL(:nome, NOME_CLIENTE), SOBRENOME_CLIENTE = IFNULL(:sobrenome, SOBRENOME_CLIENTE), FONE_CLIENTE = IFNULL(:fone, FONE_CLIENTE) WHERE ID_CLIENTE = :id_usuario";

    $stmt2 = $conn->prepare($sql2);
    $stmt2->bindParam(':nome', $nomeCliente);
    $stmt2->bindParam(':sobrenome', $sobrenomeCliente);
    $stmt2->bindParam(':fone', $foneCliente);
    $stmt2->bindParam(':id_usuario', $id_usuario);

    $stmt2->execute();

    if ($stmt2->rowCount() > 0) {

        $dados = array("status" => "ok");

    } else {
        $dados = array("status" => "erro");

    }



} catch (PDOException $e) {
    $dados = array(
        "status" => "erro",
        "mensagem_erro" => $e->getMessage());
}

echo json_encode($dados);

?>