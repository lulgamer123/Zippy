<?php

include '../includes/header.php';
?>

<div class="container-pedido">

    <form action="../actions/listar_pedidos.php" method="post">
        <h1>Veja pedidos disponiveis no seu trajeto</h1>
        <div class="form-row mt-5">
            <div class="form-row col-md-5">
                <input type="text" class="form-control" id="origem" name="origem" placeholder="De: New York - EUA">
                <div id="origem-autocomplete" class="autocomplete-items"></div>
            </div>
            <div class="form-group col-md-2 text-center"><i class="fa-solid fa-plane"></i></div>
            <div class="form-row col-md-5">
                <input type="text" class="form-control" id="destino" name="destino" placeholder="Para: São Paulo - Brasil">
                <div id="destino-autocomplete" class="autocomplete-items"></div>
            </div>

            <button class="btn btn-lg btn-primary btn-block mt-3" type="submit" name="btn-pesquisar">Pesquisar <i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
    </form>
</div>
<h2 class="text-center mt-3">Pedidos Disponíveis</h2>
<div class="container-pedido-disponiveis">


    <?php

    if (isset($_SESSION['pedidos']) && !empty($_SESSION['pedidos'])) {

        foreach ($_SESSION['pedidos'] as $pedido) { ?>
            <div id="pedido-disponivel" class="row">
                <div class="col-sm">

                    <div class="card">

                        <img src="../uploads/produtos/<?= $pedido['IMAGEM_PRODUTO'] ?>" class="img-fluid img-medium" alt="">


                        <div class="card-body">
                            <p>Pedido #<?= $pedido['ID_POSTAGEM'] ?></p>
                            <h5 class="card-title"><?= $pedido['PRODUTO_POSTAGEM'] ?></h5>
                            <p class="card-text"><strong>Link de referencia:</strong> <a target="_blank" href="<?= $pedido['LINK_REFERENCIA'] ?>">Ver Produto
                                </a></p>
                            <p class="card-text"><strong>Valor Estimado:</strong> R$: <?= $pedido['VALOR_POSTAGEM'] ?></p>
                            <p class="card-text"><strong>Pais de destino</strong> <?= $pedido['PAIS_DESTINO'] ?></p>
                            <p class="card-text"><strong>Cidade de destino:</strong> <?= $pedido['CIDADE_DESTINO'] ?>
                            </p>
                            <p class="card-text"><strong>Tipo de caixa:</strong> <?= $pedido['CAIXA'] ?></p>
                             
                            
                            <form action="../actions/chat/criar_chat.php" method="post">
                                <input type="hidden" name="remetente" value="<?= $_SESSION['id_usuario'] ?>">
                                <input type="hidden" name="destinatario" value="<?= $pedido['ID_CLIENTE'] ?>">
                                <input type="hidden" name="id_pedido" value="<?= $pedido['ID_POSTAGEM'] ?>">
                                <button type="submit" class="btn-primary btn-lg" name="btn-chat" style="width: 100%;">Iniciar Chat</button>
                            </form>
                        </div>



                    </div>
                    <div class="card-footer w-100">
                        <small class="text-muted">Criado em <?= $pedido['DTA_POSTAGEM'] ?></small>
                    </div>
                </div>
            </div>

    <?php
        }
    } else {
        echo "<p>Nenhum pedido disponível.</p>";
    }
    ?>


</div>

<h2 id="btn-top"><i class="fa-solid fa-up-long"></i></h2>

<script src="../js/listagemPedidos.js"></script>
<script src="../js/autoComplete.js"></script>
<script src="../js/responsive.js"></script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>