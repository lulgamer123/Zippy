
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <title>Painel de Administração</title>
    <style>
        .form-container {
            display: none;
        }
        .form-container.active {
            display: block;
        }
    </style>
</head>


<?php
include "../includes/mensagens.php";

?>
<body class="bg-light" style="height: 100vh; display: flex; flex-direction:column; justify-content: center; align-items: center;">

    <div class="container" style="max-width: 50%;">
        <div class="text-center">
            <div class="col mb-3">
                <img src="../img/logoZippy.png" alt="Logo">
            </div>
            <div class="col">
                <!-- Formulário de Login -->
                <div id="loginForm" class="form-container active">
                    <form class="form-signin" action="actionsAdmin/logar.php" method="post">
                        <h1 class="h3 mb-3 font-weight-normal">Zippy Internacional | Painel Administração</h1>
                        <div class="form-group">
                            <label for="loginEmail" class="sr-only">Email</label>
                            <input type="email" class="form-control" id="loginEmail" name="loginEmail" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="loginSenha" class="sr-only">Password</label>
                            <input type="password" class="form-control" id="loginSenha" name="loginSenha" placeholder="Senha">
                        </div>
                        <button class="btn btn-lg btn-primary btn-block" type="submit" name="btn-login">Login &rarr;</button>
                        <button type="button" class="btn btn-lg btn-secondary btn-block" onclick="toggleForms()">Registrar</button>
                        <p class="mt-5 mb-3 text-muted">Todos os direitos reservados &copy; 2024 | Zippy Internacional</p>
                    </form>
                </div>

                <!-- Formulário de Registro -->
                <div id="registerForm" class="form-container">
                    <form class="form-signin" action="actionsAdmin/cadastrar.php" method="post">
                        <h1 class="h3 mb-3 font-weight-normal">Zippy Internacional | Painel Administração</h1>
                        <h2 class="h3">Registre um novo usuário</h2>
                        <div class="form-group">
                            <label for="registerEmail" class="sr-only">Email</label>
                            <input type="email" class="form-control" id="registerEmail" name="registerEmail" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="registerSenha" class="sr-only">Password</label>
                            <input type="password" class="form-control" id="registerSenha" name="registerSenha" placeholder="Senha">
                        </div>
                        <button class="btn btn-lg btn-primary btn-block" type="submit" name="btn-register">Registrar &rarr;</button>
                        <button type="button" class="btn btn-lg btn-secondary btn-block" onclick="toggleForms()">Login</button>
                        <p class="mt-5 mb-3 text-muted">Todos os direitos reservados &copy; 2024 | Zippy Internacional</p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="js/switchForms.js"></script>
</body>



</html>