let qrCodeGenerated = false; // Variável para rastrear se o QR code já foi gerado

function geraLink() {
   
    if (qrCodeGenerated) {
        return;
    }

    let idPedidoElement = document.getElementById('idPedido');
    let chave = document.getElementById('chave');
    let valorTotalElement = document.getElementById('valorTotal');
    let divPix = document.getElementById("pix");
    let remetente = document.getElementById('remetenteForm').value;
    let destinatario = document.getElementById('destinatarioForm').value;
    let chatIdForm = document.getElementById('chatIdForm').value;
    let pagador = document.getElementById('pagadorForm').value;

    let idPedido = idPedidoElement.textContent;
    let valorTotal = valorTotalElement.textContent;

    let link = "https://zippyinternacional.com/actions/pagamento/processaPix.php?valorTotal=" + valorTotal + "&PIX=true&ID_PEDIDO=" + idPedido + "&remetente=" + remetente + "&destinatario=" + destinatario + "&chatIdForm=" + chatIdForm + "&pagador=" + pagador;

    chave.href = link;

    console.log(link);
    console.log(remetente + " " + destinatario + " " + chatIdForm + " " + pagador);
    // Gerar o QR Code
    new QRCode(divPix, {
        text: link,
        width: 350,
        height: 350
    });

   
    chave.addEventListener('click', function(event) {
        event.preventDefault(); // Prevenir o comportamento padrão do link

        document.querySelector('#pix').style.display = 'none';
        document.querySelector('.payment-loader').style.display = 'block';

        setTimeout(function() {
                window.location.href = link;
            }, 3000);
    });

    console.log(link);

    qrCodeGenerated = true;
}
