<?php
try {

    // Conexão com o banco de dados (substitua pelos seus próprios dados)
    include("conexao_bdPDO.php");

    // $id_usuario = 5;
    // $nomeCliente = "Luiz2";
    // $sobrenomeCliente = "CLEBER5";
    // $foneCliente = 1234;

    $id_usuario = $_POST['idUsuario'];
    $nomeCliente = $_POST['nome'];
    $sobrenomeCliente = $_POST['sobrenome'];
    $foneCliente = $_POST['fone'];

    $sql = 'SELECT * FROM tb_usuario WHERE ID_USUARIO = :idUsuario';

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':idUsuario', $id_usuario);
    $stmt->execute();

    //echo $id_usuario;

    $sql2 = "UPDATE tb_cliente SET NOME_CLIENTE = IFNULL(:nome, NOME_CLIENTE), SOBRENOME_CLIENTE = IFNULL(:sobrenome, SOBRENOME_CLIENTE), FONE_CLIENTE = IFNULL(:fone, FONE_CLIENTE) WHERE ID_CLIENTE = :id_usuario";

    $stmt2 = $pdo->prepare($sql2);
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