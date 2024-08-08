<?php
include '../actions/conexao_bd.php';
require_once '../includes/header.php';

?>
<main>
    <h1 id="pgto-title">Pagamento do pedido:</h1>

    <div class="checkout-container">

        <?php

        if (isset($_GET['PAGAMENTO']) && $_GET['PAGAMENTO'] == 'success') {
            echo '<img id="img-sucess" src="../img/layout/sucess.svg" alt="Sucesso" class="img-fluid img-small">';
        } else {

            if (isset($_GET['ID_PEDIDO']) && !empty($_GET['ID_PEDIDO'])) {
                $ID_PEDIDO = $_GET['ID_PEDIDO'];
                $sql = "SELECT * FROM tb_postagem WHERE ID_POSTAGEM = $ID_PEDIDO";
                $resultado = $pdo->query($sql);
                $pedidos = $resultado->fetchAll();

                foreach ($pedidos as $pedido) {
                    if ($pedido['ID_POSTAGEM'] == $ID_PEDIDO) {
        ?>

                        <div class="order-details">
                            <h2>Detalhes do Pedido:</h2>
                            <div class="order-item">
                                <img src="../uploads/produtos/<?= $pedido['IMAGEM_PRODUTO'] ?>" class="img-fluid img-medium" alt="Produto">
                                <div class="item-info">
                                    <p class="receipt-id">Pedido: <span id="idPedido"><?= $pedido['ID_POSTAGEM'] ?></span>#</p>
                                    <h5 class="card-title"><?= $pedido['PRODUTO_POSTAGEM'] ?></h5>
                                    <p class="receipt-info"><strong>País de destino:</strong> <?= $pedido['PAIS_DESTINO'] ?></p>
                                    <p class="receipt-info"><strong>Cidade de destino:</strong> <?= $pedido['CIDADE_DESTINO'] ?></p>
                                    <p class="receipt-info"><strong>Tipo de caixa:</strong> <?= $pedido['CAIXA'] ?></p>
                                    <hr>
                                    <p class="receipt-info"><strong>Valor Combinado: R$ <span id="valorCombinado"><?= $_GET['valorCombinado'] ?></span></strong></p>
                                    <p class="receipt-info"><strong>Porcentagem do viajante: R$ <span id="porcentViajante"></span></strong></p>
                                    <p class="receipt-info"><strong>Porcentagem da Zippy: R$<span id="porcentZippy"></span></strong></p>
                                    <p class="receipt-info"><strong>Valor total: R$<span id="valorTotal"></span></strong></p>
                                </div>
                            </div>
                        </div>

        <?php

                        break;
                    }
                }
            } else {
                echo "ID do pedido não fornecido ou sessão de pedidos vazia.";
            }
        }

        ?>



        <?php
        if (isset($_GET['PAGAMENTO']) && $_GET['PAGAMENTO'] == 'success') {

            echo '<div id="paga-success" class="alert alert-success" role="alert" style="background: #8C76DB;; border-color: #34D399; color: #fff; border-radius: 8px; padding: 20px;">
    <h2 style="margin-bottom: 10px; font-size: 24px; font-weight: bold;">Pagamento realizado com sucesso!</h2>
    <p style="margin-bottom: 5px; font-size: 16px;">Seu pagamento foi processado com sucesso.</p>   
    <p style="margin-bottom: 20px; font-size: 16px;">Obrigado por sua compra!</p>
    <a class="btn btn-success" href="chats.php" border-color: #06B6D4; color: #FFF; padding: 10px 20px; border-radius: 6px; text-decoration: none; font-size: 16px; font-weight: bold;">Voltar para o chat.</a>
</div>';
        } else {

        ?>

            <div class="payment-form">
                <h2>Forma de pagamento</h2>
                <div class="payment-methods">
                    <button id="pagamento_cartao" class="payment-method activee"><i class="fa-regular fa-credit-card"></i> Cartão de crédito</button>
                    <button id="pagamento_pix" class="payment-method" onclick="geraLink()"><i class="fa-brands fa-pix"></i> PIX</button>
                </div>

                <div class="payment-loader" style="display:none;">
                    <div class="pad">
                        <div class="chip"></div>
                        <div class="line line1"></div>
                        <div class="line line2"></div>
                    </div>
                    <div class="loader-text">
                        Aguarde, estamos processando seu pagamento...
                    </div>
                </div>

                <div id="cartao">


                    <form class="form-pay" method="post" action="../actions/pagamento/processa_cartao.php">
                        <div class="form-container">
                            <div class="field-container">
                                <label for="name">Nome do titular:</label>
                                <input id="name" maxlength="20" type="text">
                            </div>
                            <div class="field-container">
                                <label for="cardnumber">Numero do cartão:</label><span id="generatecard"></span>
                                <input id="cardnumber" type="text" inputmode="numeric">
                                <svg id="ccicon" class="ccicon" width="750" height="471" viewBox="0 0 750 471" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

                                </svg>
                            </div>
                            <div class="field-container">
                                <label for="expirationdate">Validade:</label>
                                <input id="expirationdate" type="text" inputmode="numeric">
                            </div>
                            <div class="field-container">
                                <label for="securitycode">CVV</label>
                                <input id="securitycode" type="text" pattern="[0-9]*" inputmode="numeric">
                            </div>
                            <div class="field-container">
                                <input type="hidden" name="idPedido" value="<?= $_GET['ID_PEDIDO'] ?>">
                                <input type="hidden" id="chatIdForm" name="chatID" value="<?= $_GET['ID_CHAT'] ?>">
                                <input type="hidden" id="destinatarioForm" name="destinatario" value="<?= $_GET['DESTINATARIO'] ?>">
                                <input type="hidden" id="remetenteForm" name="remetente" value="<?= $_GET['REMETENTE'] ?>">
                                <input type="hidden" id="pagadorForm" name="pagador" value="<?= $_GET['PAGADOR'] ?>">
                                <input type="hidden" name="valor" value="">
                            </div>
                        </div>
                        <button name="btn-cartao" class="btn btn-primary rounded mt-2 p-2 w-100">Pagar</button>
                    </form>


                    <div class="containerCard preload">
                        <div class="creditcard">
                            <div class="front">
                                <div id="ccsingle"></div>
                                <svg version="1.1" id="cardfront" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 750 471" style="enable-background:new 0 0 750 471;" xml:space="preserve">
                                    <g id="Front">
                                        <g id="CardBackground">
                                            <g id="Page-1_1_">
                                                <g id="amex_1_">
                                                    <path id="Rectangle-1_1_" class="lightcolor grey" d="M40,0h670c22.1,0,40,17.9,40,40v391c0,22.1-17.9,40-40,40H40c-22.1,0-40-17.9-40-40V40
                    C0,17.9,17.9,0,40,0z" />
                                                </g>
                                            </g>
                                            <path class="darkcolor greydark" d="M750,431V193.2c-217.6-57.5-556.4-13.5-750,24.9V431c0,22.1,17.9,40,40,40h670C732.1,471,750,453.1,750,431z" />
                                        </g>
                                        <text transform="matrix(1 0 0 1 60.106 295.0121)" id="svgnumber" class="st2 st3 st4">0123 4567 8910 1112</text>
                                        <text transform="matrix(1 0 0 1 54.1064 428.1723)" id="svgname" class="st2 st5 st6">Alex Xavier</text>
                                        <text transform="matrix(1 0 0 1 54.1074 389.8793)" class="st7 st5 st8">Titular</text>
                                        <text transform="matrix(1 0 0 1 479.7754 388.8793)" class="st7 st5 st8">Validade</text>
                                        <text transform="matrix(1 0 0 1 65.1054 241.5)" class="st7 st5 st8">Número do cartão:</text>
                                        <g>
                                            <text transform="matrix(1 0 0 1 574.4219 433.8095)" id="svgexpire" class="st2 st5 st9">01/23</text>
                                            <text transform="matrix(1 0 0 1 479.3848 417.0097)" class="st2 st10 st11">VALID</text>
                                            <text transform="matrix(1 0 0 1 479.3848 435.6762)" class="st2 st10 st11">THRU</text>
                                            <polygon class="st2" points="554.5,421 540.4,414.2 540.4,427.9 		" />
                                        </g>
                                        <g id="cchip">
                                            <g>
                                                <path class="st2" d="M168.1,143.6H82.9c-10.2,0-18.5-8.3-18.5-18.5V74.9c0-10.2,8.3-18.5,18.5-18.5h85.3
                c10.2,0,18.5,8.3,18.5,18.5v50.2C186.6,135.3,178.3,143.6,168.1,143.6z" />
                                            </g>
                                            <g>
                                                <g>
                                                    <rect x="82" y="70" class="st12" width="1.5" height="60" />
                                                </g>
                                                <g>
                                                    <rect x="167.4" y="70" class="st12" width="1.5" height="60" />
                                                </g>
                                                <g>
                                                    <path class="st12" d="M125.5,130.8c-10.2,0-18.5-8.3-18.5-18.5c0-4.6,1.7-8.9,4.7-12.3c-3-3.4-4.7-7.7-4.7-12.3
                    c0-10.2,8.3-18.5,18.5-18.5s18.5,8.3,18.5,18.5c0,4.6-1.7,8.9-4.7,12.3c3,3.4,4.7,7.7,4.7,12.3
                    C143.9,122.5,135.7,130.8,125.5,130.8z M125.5,70.8c-9.3,0-16.9,7.6-16.9,16.9c0,4.4,1.7,8.6,4.8,11.8l0.5,0.5l-0.5,0.5
                    c-3.1,3.2-4.8,7.4-4.8,11.8c0,9.3,7.6,16.9,16.9,16.9s16.9-7.6,16.9-16.9c0-4.4-1.7-8.6-4.8-11.8l-0.5-0.5l0.5-0.5
                    c3.1-3.2,4.8-7.4,4.8-11.8C142.4,78.4,134.8,70.8,125.5,70.8z" />
                                                </g>
                                                <g>
                                                    <rect x="82.8" y="82.1" class="st12" width="25.8" height="1.5" />
                                                </g>
                                                <g>
                                                    <rect x="82.8" y="117.9" class="st12" width="26.1" height="1.5" />
                                                </g>
                                                <g>
                                                    <rect x="142.4" y="82.1" class="st12" width="25.8" height="1.5" />
                                                </g>
                                                <g>
                                                    <rect x="142" y="117.9" class="st12" width="26.2" height="1.5" />
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                    <g id="Back">
                                    </g>
                                </svg>
                            </div>
                            <div class="back">
                                <svg version="1.1" id="cardback" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 750 471" style="enable-background:new 0 0 750 471;" xml:space="preserve">
                                    <g id="Front">
                                        <line class="st0" x1="35.3" y1="10.4" x2="36.7" y2="11" />
                                    </g>
                                    <g id="Back">
                                        <g id="Page-1_2_">
                                            <g id="amex_2_">
                                                <path id="Rectangle-1_2_" class="darkcolor greydark" d="M40,0h670c22.1,0,40,17.9,40,40v391c0,22.1-17.9,40-40,40H40c-22.1,0-40-17.9-40-40V40
                C0,17.9,17.9,0,40,0z" />
                                            </g>
                                        </g>
                                        <rect y="61.6" class="st2" width="750" height="78" />
                                        <g>
                                            <path class="st3" d="M701.1,249.1H48.9c-3.3,0-6-2.7-6-6v-52.5c0-3.3,2.7-6,6-6h652.1c3.3,0,6,2.7,6,6v52.5
            C707.1,246.4,704.4,249.1,701.1,249.1z" />
                                            <rect x="42.9" y="198.6" class="st4" width="664.1" height="10.5" />
                                            <rect x="42.9" y="224.5" class="st4" width="664.1" height="10.5" />
                                            <path class="st5" d="M701.1,184.6H618h-8h-10v64.5h10h8h83.1c3.3,0,6-2.7,6-6v-52.5C707.1,187.3,704.4,184.6,701.1,184.6z" />
                                        </g>
                                        <text transform="matrix(1 0 0 1 621.999 227.2734)" id="svgsecurity" class="st6 st7">985</text>
                                        <g class="st8">
                                            <text transform="matrix(1 0 0 1 518.083 280.0879)" class="st9 st6 st10">CVV</text>
                                        </g>
                                        <rect x="58.1" y="378.6" class="st11" width="375.5" height="13.5" />
                                        <rect x="58.1" y="405.6" class="st11" width="421.7" height="13.5" />
                                        <text transform="matrix(1 0 0 1 59.5073 228.6099)" id="svgnameback" class="st12 st13">Alexsandro</text>
                                    </g>
                                </svg>
                            </div>
                        </div>
                    </div>



                </div>

                <div id="pix">
                    <a id="chave" href="">Link para pagamento: <i class="fa-regular fa-copy"></i></a>
                </div>


            </div>
        <?php
        }
        ?>
    </div>
</main>
<script>
    document.querySelector('[name="btn-cartao"]').addEventListener('click', function(event) {
        event.preventDefault(); 

        // Armazena os dados do formulário em cookies
        document.cookie = "chatID=" + document.querySelector('[name="chatID"]').value + "; path=/";
        document.cookie = "destinatario=" + document.querySelector('[name="destinatario"]').value + "; path=/";
        document.cookie = "remetente=" + document.querySelector('[name="remetente"]').value + "; path=/";
        document.cookie = "pagador=" + document.querySelector('[name="pagador"]').value + "; path=/";
        document.cookie = "idPedido=" + document.querySelector('[name="idPedido"]').value + "; path=/";
        document.cookie = "valor=" + document.querySelector('[name="valor"]').value + "; path=/";

       
        document.querySelector('#cartao').style.display = 'none';
        document.querySelector('.payment-loader').style.display = 'block';

        
        setTimeout(function() {
            document.querySelector('.form-pay').submit();
        }, 3000);
    });
</script>



<script>
    $(document).ready(function() {


        $('#pagamento_cartao').click(function() {
            const valorTotal = $('#valorTotal').text();
            let valor = $('#valorCombinado').text();
            $('input[name="valor"]').val(valor);
            $('#pagamento_cartao').addClass('activee');
            $('#pagamento_pix').removeClass('activee');
            $('#cartao').show();
            $('#pix').hide();
            $('#chave').hide();
        });

        $('#pagamento_pix').click(function() {
            const valorTotal = $('#valorTotal').text();
            $('input[name="valor"]').val(valorTotal);
            $('#pagamento_pix').addClass('activee');
            $('#pagamento_cartao').removeClass('activee');
            $('#cartao').hide();
            $('#pix').show();
            $('#chave').show();
        });

    });

    $(document).ready(function() {
        if ($('#paga-success').length > 0) {
            $('.checkout-container').addClass(' success');
            $('#pgto-title').hide();
        }
    });
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/imask/6.0.6/imask.min.js"></script>
<script src="../js/pagamento/calculaPreco.js"></script>
<script src="../js/pagamento/checkout.js"></script>
<script src="../js/pagamento/geraLink.js"></script>
<script src="../js/pagamento/verfica_pagamento.js"></script>
</body>