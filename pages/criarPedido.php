<?php
include '../includes/header.php';


?>

<?php

if (isset($_GET['sucesso']) || isset($_GET['erro'])) {
    include '../includes/mensagens.php';
}

?>
<div class="container-pedido">


    <form action="../actions/criar_pedido.php" method="post" class="p-2" enctype="multipart/form-data">
        <h1 class="mb-5">Crie seu pedido</h1>
        <div id="criarPedido" class="d-flex align-items-center">
            <div class="col-md-6">
                <h3 class="text-left">Produto</h3>
                <div class="form-row text-left">
                    <div class="form-group col-md-6">
                        <label for="nomeProduto">Nome do produto:</label>
                        <input type="text" class="form-control" id="nomeProduto" name="nomeProduto" placeholder="Air Pods">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="preco">Preço:</label>
                        <input type="number" class="form-control" id="preco" name="preco" placeholder="R$1.529">
                    </div>

                </div>

                <div class="row mb-2 text-left">
                    <div class="col">
                        <label for="link">Link de referência:</label>
                        <input id="link" name="link" type="text" class="form-control" placeholder="EX:https://www.amazon.com.br/Apple-AirPods">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="caixa" id="caixaOriginal" value="original">
                        <label class="form-check-label" for="caixaOriginal">
                            Caixa Original
                        </label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="caixa" id="caixaAvulsa" value="avulsa" checked>
                        <label class="form-check-label" for="caixaAvulsa">
                            Caixa Avulsa
                        </label>
                    </div>
                </div>

                <small id="aviso" class="text-danger text-left" style="display:none;">Caixa Original pode ocasionar em
                    taxa
                    da
                    alfândega.</small>

                <div class="form-group text-left mt-3">
                    <label  style="font-size: 1.5rem;" class="custom-file-upload text-light " for="btn-update-foto">Mande uma foto do produto</label>
                    <input type="file" id="btn-update-foto" name="produto-img" accept="image/jpeg, image/png, image/gif" required maxlength="5242880" oninput="displayFileName(this)">
                    <p id="file-name"></p>
                </div>

            </div>

            <div class="col-md-6">
                <h3 class="text-left">Locais:</h3>

                <h3 class="text-left ">Onde o pedido pode ser encontrado?</h3>
                <div class="form-row mt-2 mb-2 text-left">

                    <div class="form-group col-md-5">
                        <label for="pais">País:</label>
                        <input type="text" class="form-control" id="paisOrigem" name="paisOrigem" placeholder="">
                        <div id="destino-autocomplete" class="autocomplete-items"></div>
                    </div>

                    <div class="form-group col-md-5">
                        <label for="cidade">Cidade:</label>
                        <input type="text" class="form-control" id="cidadeOrigem" name="cidadeOrigem" placeholder="">
                        <div id="destino-autocomplete" class="autocomplete-items"></div>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="uf">UF:</label>
                        <input type="text" class="form-control" id="ufOrigem" name="ufOrigem" placeholder="">
                    </div>
                </div>

                <h3 class="text-left ">Onde voce vai estar pra receber o pedido</h3>
                <div class="form-row mt-2 mb-2 text-left">

                    <div class="form-group col-md-5">
                        <label for="pais">País:</label>
                        <input type="text" class="form-control" id="paisDestino" name="paisDestino" placeholder="">
                        <div id="destino-autocomplete" class="autocomplete-items"></div>
                    </div>

                    <div class="form-group col-md-5">
                        <label for="cidade">Cidade:</label>
                        <input type="text" class="form-control" id="cidadeDestino" name="cidadeDestino" placeholder="">
                        <div id="destino-autocomplete" class="autocomplete-items"></div>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="uf">UF:</label>
                        <input type="text" class="form-control" id="ufDestino" name="ufDestino" placeholder="">
                    </div>
                </div>
            </div>
        </div>


        <button class="btn btn-lg btn-primary btn-block" type="submit" name="btn-criar">Criar Pedido <i class="fa-solid fa-plus"></i></button>

    </form>
</div>

<script>
    function displayFileName(input) {
        let fileName = input.files[0].name;
        document.getElementById('file-name').innerText = "Arquivo selecionado: " + fileName;
    }
</script>



<script src="<?= $baseUrl ?>/js/responsive.js"></script>
<script src="<?= $baseUrl ?>/js/disclaimer.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="<?= $baseUrl ?>/js/autoCompleteUF.js"></script>
</body>

</html>