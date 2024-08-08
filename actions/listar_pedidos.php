<?php
session_start();
require_once "conexao_bd.php"; 


if (isset($_POST['origem']) && isset($_POST['destino'])) {
    
    $origem = $_POST['origem'];
    $destino = $_POST['destino'];

    try {
        
        $sql = "SELECT * FROM `tb_postagem` WHERE `PAIS_ORIGEM` = :origem AND `PAIS_DESTINO` = :destino";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':origem', $origem);
        $stmt->bindParam(':destino', $destino);
        $stmt->execute();

       
        $pedidos = array();

       
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // Adiciona cada pedido encontrado ao array de pedidos
                $pedidos[] = $row;
            }
        }

        // Armazena o array de pedidos na variável de sessão $_SESSION
        $_SESSION['pedidos'] = $pedidos;

        header('Location:' .$_SERVER['HTTP_REFERER']); 
    } catch (PDOException $e) {
        echo "Erro ao buscar pedidos: " . $e->getMessage();
    }
}
?>
