$(document).ready(function () {
    // Função para lidar com o envio de mensagens
    function enviarMensagem() {
        let mensagem = $(".chat-footer input").val();
        let chat_id = $(".chat-header").find("#id_chat").text();

        if (mensagem.trim() !== '') { // Verifica se a mensagem não está vazia
            // Após adicionar as mensagens, rola a área de mensagens até o final
            $(".chat-body .mensagens").animate({ scrollTop: $(".chat-body .mensagens")[0].scrollHeight }, 100);
            // Limpa o campo de entrada de mensagem
            $(".chat-footer input").val('');

            // Envie a mensagem para o servidor usando AJAX
            $.ajax({
                url: '../actions/chat/enviar_mensagem.php',
                method: 'POST',
                data: {
                    mensagem: mensagem,
                    chat_id: chat_id
                },
                success: function (response) {
                    // Adiciona a mensagem de entrada à interface do usuário
                    $(".chat-body .mensagens").append('<div class="mensagem mensagem-saida mensagem-temporaria"><p>' + response + '</p></div>');

                    // Remove a mensagem temporária após 2 segundos (2000 milissegundos)
                    setTimeout(function () {
                        $(".chat-body .mensagens .mensagem-temporaria").remove();
                    }, 1000);
                }





            });

        }
    }



    // Lidar com o clique no botão "Enviar"
    $(".chat-footer button").click(function () {
        enviarMensagem();
    });

    // Permitir o envio de mensagens pressionando Enter
    $(".chat-footer input").keypress(function (event) {
        if (event.which == 13) {
            enviarMensagem();
        }
    });
});
