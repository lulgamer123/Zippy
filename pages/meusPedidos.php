<?php
include '../includes/header.php';
include '../actions/meuPedidos.php';
?>


<div class="container-pedido">
        <img class="img-pedidos" src="../img/layout/web-shoping.svg" alt="">
        <span id="linha"></span>
        <div class="meusPedidos">
                <h1>Meus Pedidos</h1>
                <ul class="lista-pedidos">
                        <?php
                        if(isset($_SESSION['meusPedidos']) && !empty($_SESSION['meusPedidos'])) {
                                foreach ($_SESSION['meusPedidos'] as $pedido) {
                                        echo "<li class='pedido'>
                                                        <img src='../uploads/produtos/{$pedido['IMAGEM_PRODUTO']}' alt='Produto'>
                                                        <span id='linha'></span>
                                                        <div class=''>
                                                                <h3>Pedido #{$pedido['ID_POSTAGEM']}</h3>
                                                                <p>Nome Produto: {$pedido['PRODUTO_POSTAGEM']}</p>
                                                                <p>Status: {$pedido['STATUS_POSTAGEM']}</p>
                                                                <p>Destino: <span>{$pedido['CIDADE_DESTINO']}</span>{$pedido['PAIS_DESTINO']}</p>
                                                                <p class=' text-muted w-100'>Criado: {$pedido['DTA_POSTAGEM']}</p>
                                                        </div>
                                                </li>";
                                }
                        } else {
                                echo "<li class='pedido'>
                                                <p>Você ainda não fez nenhum pedido</p>
                                        </li>";
                        }
                        
                        ?>
                </ul>
        </div>
</div>



<script src="<?= $baseUrl ?>/js/responsive.js"></script>
<script src="<?= $baseUrl ?>/js/disclaimer.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>