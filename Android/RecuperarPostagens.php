<?php


include("conexao_bdMSQLI.php");

 $paisOrigem = $_POST['paisOrigem'];
 $paisDestino = $_POST['paisDestino'];

// $paisOrigem = "China";
// $paisDestino = "Brazil";


$query= "SELECT * FROM tb_postagem WHERE PAIS_ORIGEM = '$paisOrigem' AND PAIS_DESTINO = '$paisDestino'"; // query de selecionar a variável no banco
$resulta = mysqli_query($conn,$query); //recebe o resultado
 $dados=array(); //array dos dados
while($r = mysqli_fetch_array($resulta)){ //cria a variável do resultado
 $dados[]=array("idPedido"=>$r[0],"idClienteDest"=>$r[1],"nomeProduto"=>$r[4], "precoProduto"=>$r[5], "linkProduto"=>$r[6], "paisOrigem"=>$r[7], "paisDestino" =>$r[10], "cidadeDestino"=>$r[11],"caixaProduto"=>$r[13], "imgProduto"=>$r[14]); //array que mostra todas as variáveis
}
$close = mysqli_close($conn); //fecha conexão do banco
echo json_encode($dados, JSON_UNESCAPED_SLASHES); //envia para o android
?>