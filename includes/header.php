<?php
session_start();


//Url base para os caminhos relativos, altere a porta caso for diferente
global $baseUrl;
$baseUrl = "https://zippyinternacional.com";
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CDN ICONS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" type="imagex/png" href="<?= $baseUrl ?>/img/logoZippy.png">

    <!-- CSS -->
    <link rel="stylesheet" href="<?= $baseUrl ?>/css/style.css">
    <link rel="stylesheet" href="<?= $baseUrl ?>/css/home.css">
    <link rel="stylesheet" href="<?= $baseUrl ?>/css/chats.css">
    <link rel="stylesheet" href="<?= $baseUrl ?>/css/perfil.css">
    <link rel="stylesheet" href="<?= $baseUrl ?>/css/pedidos.css">
    <link rel="stylesheet" href="<?= $baseUrl ?>/css/responsive.css">
    <link rel="stylesheet" href="<?= $baseUrl ?>/css/checkout.css">
    <link rel="stylesheet" href="<?= $baseUrl ?>/css/confEntrega.css">


    <!-- CSS BOOTSTRAP -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <title>Home | Zippy</title>
</head>

<body style="background-color: #FAFAFA;">
    <!-- HEADER -->
    <header id="header" class="">
        <div id="logo" class="logo">
            <img src="<?= $baseUrl ?>/img/logoZippy.png" alt="">
            <a href="<?= $baseUrl ?>/pages/home.php">
                <p>Zippy</p>
            </a>
        </div>
        <nav id="nav">
            <ul id="ul" class="">
                <li><a href="<?= $baseUrl ?>/pages/criarPedido.php">Criar Pedido <i class="fa-solid fa-plus"></i></a></li>
                <li><a href="<?= $baseUrl ?>/pages/listarPedidos.php">Entregas disponiveis <i class="fa-solid fa-truck"></i></a></li>
                <li>
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" value="">
                            <i class="fa-solid fa-user"></i> <?= $_SESSION['nome'] ?? '' ?><span style="display: none;" id="idUsuario"><?= $_SESSION['id_usuario']     ?></span>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="<?= $baseUrl ?>/pages/confEntrega.php">Confirmar entrega</a>
                            <a class="dropdown-item" href="<?= $baseUrl ?>/pages/meusPedidos.php">Meus pedidos</a>
                            <a class="dropdown-item" href="<?= $baseUrl ?>/pages/perfil.php">Editar Perfil</a>
                            <a class="dropdown-item" href="<?= $baseUrl ?>/pages/chats.php">Chats</a>
                            <a class="dropdown-item" href="<?= $baseUrl ?>/actions/logout.php">Sair</a>
                        </div>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="btn-hamburguer" class="btn-hamburguer" onclick="navResponsive()">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
    </header>