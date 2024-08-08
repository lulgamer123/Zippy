<?php
session_start();

require_once "conexao_bd.php";

if (isset($_POST['btn-criar'])) {
    $id_cliente = $_SESSION['id_cliente'];
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

    // Verificar se foi feito o upload de uma imagem
    if (isset($_FILES["produto-img"])) {

        //aonde vai ser salva a foto
        $targetDirectory = "../uploads/produtos/";
        $targetFile = generateUniqueFilename($_FILES["produto-img"]["name"]);
        $pathCompleted = $targetDirectory . $targetFile;

        if (!move_uploaded_file($_FILES["produto-img"]["tmp_name"], $pathCompleted)) {
            // O upload falhou
            header('Location: ../pages/criarPedido.php?erro=Erro ao fazer upload da imagem');
            exit;
        }
    } else {
        // Definir a imagem padrão
        $targetFile = "produtoDefault.png";
    }

    try {
        $sql = "INSERT INTO `tb_postagem` (`ID_CLIENTE`, `DTA_POSTAGEM`, `STATUS_POSTAGEM`, `PRODUTO_POSTAGEM`, `VALOR_POSTAGEM`, `LINK_REFERENCIA`, `PAIS_ORIGEM`, `CIDADE_ORIGEM`, `UF_ORIGEM`, `PAIS_DESTINO`, `CIDADE_DESTINO`, `UF_DESTINO`, `CAIXA`, `IMAGEM_PRODUTO`) 
        VALUES (:id_cliente, NOW(), 'Pendente', :produto, :valor, :link, :paisOrigem, :cidadeOrigem, :ufOrigem, :paisDestino, :cidadeDestino, :ufDestino, :caixa, :imagem_produto)";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_cliente', $id_cliente);
        $stmt->bindParam(':produto', $produto);
        $stmt->bindParam(':valor', $preco);
        $stmt->bindParam(':link', $link);
        $stmt->bindParam(':paisOrigem', $paisOrigem);
        $stmt->bindParam(':cidadeOrigem', $cidadeOrigem);
        $stmt->bindParam(':ufOrigem', $ufOrigem);
        $stmt->bindParam(':paisDestino', $paisDestino);
        $stmt->bindParam(':cidadeDestino', $cidadeDestino);
        $stmt->bindParam(':ufDestino', $ufDestino);
        $stmt->bindParam(':caixa', $caixa);
        $stmt->bindParam(':imagem_produto', $targetFile);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            header('Location: ../pages/criarPedido.php?sucesso=Pedido criado com sucesso');
        } else {
            header('Location: ../pages/criarPedido.php?erro=Erro ao criar pedido');
        }
    } catch (PDOException $e) {
        echo "Erro ao criar pedido: " . $e->getMessage();
    }
}

// Função para gerar um nome único para o arquivo
function generateUniqueFilename($filename) {
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    return uniqid() . '.' . $extension;
}
?>
