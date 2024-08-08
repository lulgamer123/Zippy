<?php
session_start();

$baseURL = 'https://zippyinternacional.com';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Administração</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/styleAdmin.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #8C76DB;">
        <a class="navbar-brand d-flex" href="<?=$baseURL?>/admin/admin.php">
            <img src="<?=$baseUrl?>/img/logoZippy.png" width="50px"></img>
            <h2 class="text-light ml-3" href="#">Zippy Admin</h2>
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto  ">
                <li class="nav-item">
                    <a class="nav-link active" href="<?=$baseUrl?>/admin/admin.php">Usuários Denunciados</a>
                <li class="nav-item">
                <li class="nav-item">
                    <a class="nav-link active" href="<?=$baseUrl?>/admin/dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="<?=$baseUrl?>/admin/actionsAdmin/logout.php">Logout</a>
                </li>
                <li class="nav-item">
                    <p class="nav-link disabled"> <i style="font-size: 25px;" class="fa-solid fa-user-shield"></i> <?= $_SESSION['email'] ?></p>
                </li>
            </ul>
        </div>
    </nav>