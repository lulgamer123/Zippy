<?php
session_start();
require_once 'conexao_bd.php';



$extensoesPermitidas = ['jpg', 'jpeg', 'png', 'gif']; // Extensões permitidas
$tamanhoMaximo = 5242880; // Tamanho máximo do arquivo em bytes


if (isset($_POST['btn-update-foto'])) {

    // Verifica se o arquivo foi enviado corretamente
    if (!isset($_FILES['update-foto']['error']) || is_array($_FILES['update-foto']['error'])) {
        header('location: ../pages/perfil.php?erro=Erro no upload');
        exit();
    }

    // Verifica se houve algum erro no upload
    switch ($_FILES['update-foto']['error']) {
        case UPLOAD_ERR_OK:
            break;
        case UPLOAD_ERR_NO_FILE:
            header('location: ../pages/perfil.php?erro=Nenhum arquivo foi enviado');
            exit();
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            header('location: ../pages/perfil.php?erro=Tamanho do arquivo excedido');
            exit();
        default:
            header('location: ../pages/perfil.php?erro=Erro desconhecido');
            exit();
    }

    //verifica se a imagem é maior que o tamanho permitido
    if ($_FILES['update-foto']['size'] > $tamanhoMaximo) {
        header('location: ../pages/perfil.php?erro=Tamanho do arquivo excedido');
    }

    if (isset($_FILES['update-foto'])) {

        //pega a extensão do arquivo
        $extensao = pathinfo($_FILES['update-foto']['name'], PATHINFO_EXTENSION);

        // Verifica se a extensão do arquivo é permitida
        if (!in_array($extensao, $extensoesPermitidas)) {
            header('location: ../pages/perfil.php?erro=extensao_invalida');
        }


        $pathDiretorio = '../uploads/'; // Diretório para onde o arquivo será enviado
        $nomeArquivo = uniqid() . basename($_FILES['update-foto']['name']); // Nome do arquivo
        $pathCompleto = $pathDiretorio . $nomeArquivo; // Caminho completo do arquivo

        if (move_uploaded_file($_FILES['update-foto']['tmp_name'], $pathCompleto)) {


            try {
                $sql = "UPDATE tb_usuario SET FOTO_PERFIL = '$nomeArquivo' WHERE ID_USUARIO = " . $_SESSION['id_usuario'];
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                if ($stmt->rowCount() > 0) {
                    $_SESSION['foto_perfil'] = $nomeArquivo;
                    header('location: ' . $_SERVER['HTTP_REFERER']);
                } else {
                    echo "Erro ao atualizar foto";
                }
            } catch (PDOException $e) {
                header('location: ../pages/perfil.php?erro=' . urlencode("Erro no banco de dados: " . $e->getMessage()));
                exit();
            }
        } else {
            header('location: ../pages/perfil.php?erro=Erro ao enviar arquivo');
            exit();
        }
    }
}
