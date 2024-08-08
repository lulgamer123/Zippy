<?php
$con=mysqli_connect("zippybd.mysql.dbaas.com.br", "zippybd", "C0dingd3vs@", "zippybd"); 
//O usuário e a senha e o banco de dados

$comando= "select * from tb_avaliacoes"; // query de selecionar a variável no banco
$resulta = mysqli_query($con,$comando); //recebe o resultado
 $dados=array(); //array dos dados
while($r = mysqli_fetch_array($resulta)){ //cria a variável do resultado
 $dados[]=array("id"=>$r[0],"nome01"=>$r[1],"nome02"=>$r[2],"pais01"=>$r[3], "pais02" =>$r[4], "perfil01"=>$r[5],"perfil02"=>$r[6]); //array que mostra todas as variáveis
}
$close = mysqli_close($con); //fecha conexão do banco
echo json_encode($dados, JSON_UNESCAPED_SLASHES); //envia para o android
?>