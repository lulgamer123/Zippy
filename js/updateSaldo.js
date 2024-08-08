
$(document).ready(function () {

    setInterval(verfica_saldo, 1000);

});


function verfica_saldo() {

    let idUsuario = $("#idUsuario").text().trim();


    $.ajax({
        url: '../actions/update_saldo.php?id_usuario=' + idUsuario,
        method: 'GET',
        dataType: 'json',
        success: function (response) {

            let saldo = response.saldo;
            let saldoFormatado = saldo.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });

            $("#saldo").text(saldoFormatado);

        },
        error: function (response) {
            // Handle AJAX error
            console.log("Error:", response);
        }
    });
}
