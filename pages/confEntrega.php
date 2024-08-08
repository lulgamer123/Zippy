<?php

require_once '../includes/header.php';
require_once '../includes/mensagens.php';

?>

<div class="container">
    <img src="../img/layout/entrega.svg" alt="">
    <div class="text">
        <h1 class="display-4">Confirmar entrega</h1>
        <p class="text-center">Para confirmar a entrega, digite a identidade do comprador.</p>
        <form action="../actions/confEntrega.php" method="post">
            <input class="form-control-lg mb-3" type="text" name="idPedido" id="idPedido" placeholder="ID do pedido">
            <input class="form-control-lg" type="text" name="identidade" id="identidade" placeholder="Identidade">
            <button type="submit" name="btn-conf" style="background: #8C76DB !important; color:#fff;" class="btn w-100 mt-2">Confirmar</button>
        </form>
        
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


<script src="../js/responsive.js"></script>
