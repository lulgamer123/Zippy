    <?php

include('conexao_bdPDO.php');
// $id_cliente = "1";
// $produto = "oi";
// $preco = "20";
// $link = "ola";
// $paisOrigem = "feijao";
// $cidadeOrigem = "feijoca";
// $ufOrigem = "sela";
// $paisDestino = "gh";
// $cidadeDestino = "fm";
// $ufDestino = "vm";
// $caixa = "Avulsa";

$id_cliente = $_POST['id_cliente'];
$produto = $_POST['nomeProduto'];
$preco = $_POST['preco'];
$link = $_POST['link'];
$paisOrigem = $_POST['paisOrigem'];
$cidadeOrigem = $_POST['cidadeOrigem'];
$ufOrigem = $_POST['ufOrigem'];
$paisDestino = $_POST['paisDestino'];
$cidadeDestino = $_POST['cidadeDestino'];
$ufDestino = $_POST['ufDestino'];
$caixa = $_POST['caixa'];
try {
    $sql = "INSERT INTO tb_postagem (ID_CLIENTE, DTA_POSTAGEM, STATUS_POSTAGEM, PRODUTO_POSTAGEM, VALOR_POSTAGEM, LINK_REFERENCIA, PAIS_ORIGEM, CIDADE_ORIGEM, UF_ORIGEM, PAIS_DESTINO, CIDADE_DESTINO, UF_DESTINO, CAIXA, IMAGEM_PRODUTO) 
		VALUES (:id_cliente, NOW(), 'Pendente', :produto, :preco, :link, :paisOrigem, :cidadeOrigem, :ufOrigem, :paisDestino, :cidadeDestino, :ufDestino, :caixa, 'produtoDefault.png')";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_cliente', $id_cliente);
    $stmt->bindParam(':produto', $produto);
    $stmt->bindParam(':preco', $preco);
    $stmt->bindParam(':link', $link);
    $stmt->bindParam(':paisOrigem', $paisOrigem);
    $stmt->bindParam(':cidadeOrigem', $cidadeOrigem);
    $stmt->bindParam(':ufOrigem', $ufOrigem);
    $stmt->bindParam(':paisDestino', $paisDestino);
    $stmt->bindParam(':cidadeDestino', $cidadeDestino);
    $stmt->bindParam(':ufDestino', $ufDestino);
    $stmt->bindParam(':caixa', $caixa);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {

        $dados = array("status" => "ok");
  
     } else {
        $dados = array("status" => "erro");
  
     }
     echo json_encode($dados);

} catch (PDOException $e) {
    'Error: ' . $e->getMessage();

    $error = $e->getMessage();
    $dados = array("status" => $error);
    //echo json_encode($dados);
}

?>
