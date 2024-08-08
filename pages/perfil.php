<?php

include '../includes/header.php';


?>
<?php
if (isset($_GET['sucesso']) || isset($_GET['erro'])) {
    include '../includes/mensagens.php';
}

?>

<div class="container-perfil">

    <!-- aonde fica a foto de peril man  -->
    <div class="info-perfil">
        <img src="../uploads/<?= isset($_SESSION['foto_perfil']) ? $_SESSION['foto_perfil'] : 'default.jpg'; ?>" alt="..." class="img-thumbnail" width="100%">
        <h4><?= $_SESSION['nome'] . ' ' . $_SESSION['sobrenome']  ?> </h4>

        <p style="font-size: 1.5rem;"><i style="font-size: 2rem; color:#8C76DB" class="fa-solid fa-wallet"></i>R$ <span id="saldo"></span></p>
        <span id="idUsuario" style="display: none;"><?= $_SESSION['id_usuario'] ?></span>
        <form action="../actions/update_foto.php" method="post" enctype="multipart/form-data">
            <label for="btn-update-foto">Atualizar foto de perfil</label> <br>
            <label class="custom-file-upload">
                <input type="file" id="btn-update-foto" name="update-foto" accept="image/jpeg, image/png, image/gif" required maxlength="5242880">
                Escolher arquivo
            </label><br>
            <input class="btn-primary p-2 rounded" name="btn-update-foto" type="submit" value="Enviar">
        </form>


    </div>


    <!-- formulario de edição de dados -->

    <form action="../actions/update_perfil.php" method="post">
        <h3>Edite suas informações</h3>
        <div class="form-row text-left">
            <div class="form-group col-md-6">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?= $_SESSION['nome'] ?>">
            </div>

            <div class="form-group col-md-6">
                <label for="sobrenome">Sobrenome:</label>
                <input type="text" class="form-control" id="sobrenome" name="sobrenome" value="<?= $_SESSION['sobrenome'] ?>">
            </div>

        </div>
        <div class="row mb-2 text-left">
            <div class="col">
                <label for="email">Email:</label>
                <input id="email" name="email" type="text" class="form-control" value="<?= $_SESSION['email'] ?>">
            </div>
        </div>

        <div class="row mb-2 text-left">
            <div class="col">
                <label for="email">CPF:</label>
                <input id="cpf" name="cpf" type="text" class="form-control" value="<?= $_SESSION['identidade'] ?>" disabled>
            </div>
        </div>

        <div class="row mt-2 mb-2 text-left">
            <div class="col">
                <label for="tel">Telefone:</label>
                <input id="tel" name="tel" type="tel" class="form-control" value="<?= $_SESSION['fone'] ?>">
            </div>
        </div>
        <p>Atualize sua senha</p>
        <div class="form-row text-left">

            <div class="form-group col-md-6 ">
                <label for="senha">Nova Senha:</label>
                <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha">
            </div>
            <div class="form-group col-md-6">
                <label for="confSenha">Confirme a senha</label>
                <input type="password" class="form-control" id="confSenha" name="confSenha" placeholder="Confirme a senha:">
                <small id="senhaError" class="text-danger" style="display:none;">As senhas não
                    coincidem.</small>
            </div>
        </div>

        <button class="btn btn-lg btn-primary btn-block" type="submit" name="btn-atualizar">Atualizar</button>


    </form>

    <!-- Formulario de cadastro de endereco -->
    <form action="../actions/cadastrar_endereco.php" method="post">
        <h3>Cadastre seu endereço:</h3>

        <div class="form-row text-left">
            <div class="form-group col-md">
                <label for="cep">CEP:</label>
                <input type="text" class="form-control" id="cep" name="cep" value="" onblur="pesquisacep(this.value)">
            </div>

        </div>

        <div class="form-row text-left">
            <div class="form-group col-md-6">
                <label for="rua">Rua:</label>
                <input type="text" class="form-control end" id="rua" name="rua" value="<?= isset($_SESSION['rua']) ? $_SESSION['rua'] : ''; ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="bairro">Bairro:</label>
                <input type="text" class="form-control end" id="bairro" name="bairro" value="<?= isset($_SESSION['bairro']) ? $_SESSION['bairro'] : ''; ?>">
            </div>
        </div>

        <div class="form-row mt-2 mb-2 text-left">

            <div class="form-group col-md-5">
                <label for="pais">País:</label>
                <input type="text" class="form-control end" id="pais" name="pais" value="<?= isset($_SESSION['pais']) ? $_SESSION['pais'] : ''; ?>">
            </div>

            <div class="form-group col-md-5">
                <label for="cidade">Cidade:</label>
                <input type="text" class="form-control end" id="cidade" name="cidade" value="<?= isset($_SESSION['rua']) ? $_SESSION['rua'] : ''; ?>">
            </div>

            <div class="form-group col-md-2">
                <label for="uf">UF:</label>
                <input type="text" class="form-control end" id="uf" name="uf" value="<?= isset($_SESSION['uf']) ? $_SESSION['uf'] : ''; ?>">
            </div>
        </div>

        <div class="form-row text-left">
            <div class="form-group col-md">
                <label for="compl">Complemento:</label>
                <input type="text" class="form-control end" id="compl" name="complemento" value="<?= isset($_SESSION['complemento']) ? $_SESSION['complemento'] : ''; ?>">
            </div>
        </div>

        <button class="btn btn-lg btn-primary btn-block" id="btn-cadastrar-end" type="submit" name="btn-cadastrar-end">Cadastrar</button>


    </form>



</div>


<script src="<?= $baseUrl ?>/js/responsive.js"></script>
<script src="<?= $baseUrl ?>/js/validInputs.js"></script>
<script src="<?= $baseUrl ?>/js/apiCEP.js"></script>
<script src="<?= $baseUrl ?>/js/disableInputs.js"></script>
<script src="<?= $baseUrl ?>/js/updateSaldo.js"></script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>

</html>