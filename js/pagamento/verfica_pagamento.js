
$(document).ready(function () {

    setInterval(verifica_pagamento, 2000);

});


function verifica_pagamento() {
    let idPedido = $("#idPedido").text().trim();
    $.ajax({
        url: '../actions/pagamento/verifica_status.php?id_pedido=' + idPedido,
        method: 'GET',
        dataType: 'json',
        success: function (response) {

            if (response.status == "success") {
                let valor = $("#valorTotal").text().trim();
                let idPedido = $("#idPedido").text().trim();
                let newUrl = 'http://localhost/zippyLocal/pages/checkout.php?ID_PEDIDO=' + idPedido + '&PAGAMENTO=success' + '&VALOR=' + valor;
                window.location.href = newUrl;
            }


        },


        error: function (response) {
            console.log(response);
        }
    });
}