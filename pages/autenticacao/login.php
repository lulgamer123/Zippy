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
    <link rel="shortcut icon" type="imagex/png" href="../../img/logoZippy.png"> <!-- LOGO IMG-->

    <!-- CSS -->
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/login.css">
    <link rel="stylesheet" href="../../css/responsive.css">
    <!--FINAL DA LINKAGEM DO CSS-->

    <!-- CSS BOOTSTRAP -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Faça Login | Zippy</title>
    <!--FINAL BOOTSTRAP-->

    <!-- JAVASCRIPT BOOTSTRAP -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <!--FINAL BOOTSTRAP-->
</head>


<body>


    <div class="container-login">

        <?php
        // Verifica se há uma mensagem de sucesso
        if (isset($_GET['sucesso'])) {
            include_once '../../includes/mensagens.php';
        } else {
            // Verifica se há uma mensagem de erro
            if (isset($_GET['erro'])) {
                switch ($_GET['erro']) {
                    case 'Senha incorreta':
                    case 'Email não cadastrado':
                    case 'Erro ao logar':
                    case 'Erro ao cadastrar':
                        include_once '../../includes/mensagens.php';
                        break;
                }
            }
        }
        ?>


        <!--INÍCIO DO FORMULARIO PARA LOGIN-->
        <div class="caixa"> <!--É A CAIXINHA EM VOLTA DO FORMULÁRIO-->
            <div id="formLogin" style="display: block;">

                <!--INÍCIO DO FORMULÁRIO-->
                <form class="form-signin text-center container-fluid d-flex flex-column justify-content-center" action="<?= $baseUrl ?>/actions/login.php" method="post">
                    <img class="mb-4 img-responsive mx-auto" src="../../img/logoZippy.png" alt="logoZippy">
                    <h4 class="mb-3 font-weight-normal text-light">Zippy | Faça Login</h4> <!--MINI CABEÇALHO-->

                    <!--PRIMEIRA LABEL - EMAIL-->
                    <div class="form-group">
                        <label for="loginEmail" class="sr-only">Email:</label>
                        <input type="email" class="form-control" id="loginEmail" name="loginEmail" placeholder="email@cadastrado.com">
                    </div>

                    <!--SEGUNDA LABEL - SENHA-->
                    <div class="form-group">
                        <label for="loginSenha" class="sr-only">Senha:</label>
                        <input type="password" class="form-control" id="loginSenha" name="loginSenha" placeholder="**********">
                    </div>

                    <!--BOTÃO ESQUECEU A SENHA-->
                    <a id="btnEsqueciSenha" href="javascript:void(0)">
                        <p class="text-left text-light">Esqueceu sua senha?</p>
                    </a>
                    <!--PUXADO PARA OUTRA INFORMAÇÃO-->

                    <!--BOTÃO DE LOGIN-->
                    <button class="btnLogin" type="submit" name="btn-login">Login &rarr;</button>
                

                    <a id="btnCadastro" href="javascript:void(0)">
                        <p class="text-center text-light mt-3">Não tem uma conta? Crie uma aqui</p>
                        <!--LINK PARA REGISTRAR-->
                    </a>
                </form>
                <!--FIM DO FORMULÁRIO-->
            </div>
            <!--FIM DO FORMULÁRIO PARA LOGIN-->


            <!--INÍCIO DO FORMULÁRIO PARA RECUPERAR SENHA-->
            <div id="formRecupera" style="display: none;">

                <form id="formRecupera" class="form-signin text-center container-fluid d-flex flex-column justify-content-center" action="../../actions/recuperar_senha.php" method="post">
                    <img class="mb-4 img-responsive mx-auto" src="../../img/logoZippy.png" alt="">
                    <h4 class="mb-3 font-weight-normal text-light">Digite o email cadastrado</h4>

                    <div class="form-group">
                        <label for="emailCadastrado" class="sr-only">Email:</label>
                        <input type="email" class="form-control" id="emailCadastrado" name="emailCadastrado" placeholder="email@cadastrado.com">
                    </div>

                    <a id="btnVoltarLogin" href="javascript:void(0)">
                        <p class="text-left text-light">Já tem uma conta? Faça login</p>
                    </a>

                    <!--SUBMIT PARA RECUPERAÇÃO-->
                    <button class="btn btn-lg btn-primary btn-block" type="submit" name="btn-recupera">Recuperar
                        &rarr;
                    </button>
                </form>
            </div>

            <!--FINAL DO FORMULÁRIO PARA RECUPERAR A SENHA-->



            <!-- FORMULÁRIO PARA CADASTRO -->
            <div id="formCadastro" class="text-light text-center" style="display: none;">
                <div class="cabecalho-form">
                    <img class="mb-4 img-responsive mx-auto" src="../../img/logoZippy.png" alt="">
                    <h4 class="mb-3 font-weight-normal text-light">Faça parte da Zippy </h4>
                    <h1 class="font-weight-bold">Cadastre suas informações</h1>
                </div>


                <form id="formCadastro" action="<?= $baseUrl ?>/actions/cadastro.php" method="post">

                    <div class="form-row text-left">

                        <!--LABEL NOME-->
                        <div class="form-group col-md-4">
                            <label for="nome">Nome:</label>
                            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome">
                        </div>

                        <!--LABEL SOBRENOME-->
                        <div class="form-group col-md-4">
                            <label for="sobrenome">Sobrenome:</label>
                            <input type="text" class="form-control" id="sobrenome" name="sobrenome" placeholder="Sobrenome">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="dtaNasc">Nascimento:</label>
                            <input type="date" class="form-control" id="dtaNasc" name="dtaNasc" placeholder="">
                        </div>
                    </div>

                    <!--LABEL EMAIL-->
                    <div class="row mb-2 text-left">
                        <div class="col">
                            <label for="email">Email:</label>
                            <input id="email" name="email" type="text" class="form-control" placeholder="Email">
                        </div>
                    </div>

                    <!--LABEL TELEFONE-->
                    <div class="row mt-2 mb-2 text-left">
                        <div class="col">
                            <label for="tel">Telefone:</label>
                            <input id="tel" name="tel" type="tel" class="form-control" placeholder="Telefone">
                        </div>
                    </div>

                    <!--LABEL CPF-->
                    <div class="row mt-2 mb-2 text-left">
                        <div class="col">
                            <label for="identidade">Identidade:</label>
                            <input id="identidade" name="identidade" type="text" class="form-control" placeholder="">
                        </div>
                    </div>

                    <!--LABEL SENHA-->
                    <div class="form-row text-left">
                        <div class="form-group col-md-6 ">
                            <label for="senha">Senha:</label>
                            <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="confSenha">Confirme a senha:</label> <!--CONFIRMAR A SENHA-->
                            <input type="password" class="form-control" id="confSenha" name="confSenha" placeholder="Confirme senha">

                            <!--CASO AS SENHAS NÃO SE COINCIDEM-->
                            <small id="senhaError" class="text-danger" style="display:none;">As senhas não
                                coincidem.
                            </small>
                        </div>
                    </div>

                    <!--BOTÃO FINALIZAR CADASTRO-->
                    <button class="btn btn-lg btn-primary btn-block" type="submit" name="btn-cadastrar">Cadastrar</button>

                    <!--CASO JÁ TENHA-->
                    <a id="btnLogin" href="javascript:void(0)">
                        <p class="text-left text-light mt-3 text-center">Já tem conta? Faça login</p>
                    </a>
                </form>
            </div>
            <!--FINAL FORMULÁRIO DE CADASTRO-->
        </div>
    </div>

    <!--PARTE DOS SCRIPTS-->
    <script src="../../js/switchForm.js"></script> <!--TROCAR PARA CADASTRO-->
    <script src="../../js/validInputs.js"></script> <!--SENHA VÁLIDA-->

    <!------------------->

</body>

</html>