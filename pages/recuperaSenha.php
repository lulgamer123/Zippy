<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    <title>Recupera Senha</title>
    <style>
        body {
            background: #f0f0f0;
        }

        .page-wrap {
            min-height: 100vh;
        }

        .container {
            max-width: 900px;
        }
    </style>
</head>


<body>

    <div class="page-wrap d-flex flex-row align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-md-3 text-center">
                    <img src="../img/logoZippy.png" class="img-fluid" alt="" />
                    <h2 class="">Zippy</h2>
                </div>
                <div class="col-md-9">
                    <h2 class="display-4 font-weight-light">Cadastre sua nova senha</h2>
                    Não se preocupe. Basta inserir sua nova senha que em seguida sera redirecionada pro login.
                    <form action="../actions/resetarSenha.php" method="post" class="mt-3">
                        <input class="form-control form-control-lg" name="senha" type="password"/>

                        <input type="hidden" name="email" value="<?= $_GET['email']?>">
                        
                        <div class="text-right my-3">
                            <button name="btn-cadastrar" type="submit" class="btn btn-lg" style="background: #8C76DB; color:#fff">Cadastrar Senha</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>

</html>