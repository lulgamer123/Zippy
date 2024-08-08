
$(document).ready(function () {

    $('#aviso').hide();

    // Verifica se a barra de rolagem está próxima do final, e se deve rolar automaticamente
    var scrollAutomatically = true;

    $(".chat-body .mensagens").on('scroll', function () {
        var scrollTop = $(this).scrollTop();
        var scrollHeight = $(this)[0].scrollHeight;
        var windowHeight = $(this).outerHeight();

        // Verifica se a barra de rolagem está próxima do fundo
        if (scrollHeight - (scrollTop + windowHeight) < 50) {
            scrollAutomatically = true;
        } else {
            scrollAutomatically = false;
        }
    });



    let remetente = $("#dropdownMenuButton").text().trim();
    let idUsuario = $("#idUsuario").text().trim();

    //mostra a animação de carregamento
    $('.loading-animation').show();

    // Armazena os IDs das mensagens já presentes no chat
    var mensagensExistentes = [];

    function buscarNovasMensagens(chat_id) {



        $.ajax({
            url: '../actions/chat/busca_mensagens.php?chat_id=' + chat_id,
            method: 'GET',
            dataType: 'json',
            success: function (response) {

                // Esconde a animação de carregamento
                $('.loading-animation').hide();

                // Verifica se não há mensagens no chat
                if (response.mensagem === "Nenhuma mensagem encontrada para este chat.") {
                   $('.chat-body .mensagens').html('<div class="alert alert-info" role="alert">Nenhuma mensagem encontrada para este chat.</div>');
                }

                // Processa a resposta JSON e exibe as mensagens no chat
                for (var i = 0; i < response.length; i++) {

                    var mensagem = response[i];

                    // Verifica se o ID da mensagem já está presente no chat
                    if (!mensagensExistentes.includes(mensagem.ID_MSG)) {
                        // Adiciona o ID da mensagem à lista de mensagens existentes
                        mensagensExistentes.push(mensagem.ID_MSG);

                        //defina a classe CSS da mensagem com base no remetente
                        var classeMensagem = "mensagem-remetente";
                        if (mensagem.REMETENTE == idUsuario) {
                            classeMensagem = "mensagem-saida";
                        } else {
                            classeMensagem = "mensagem-entrada";
                        }



                        // Adiciona a mensagem ao chat com a classe CSS determinada
                        $(".chat-body .mensagens").append("<div class='mensagem " + classeMensagem + "'>" + mensagem.MENSAGEM + "</div>");

                    }
                }

                // Após adicionar as mensagens, rola a área de mensagens até o final
                if (scrollAutomatically) {
                    $(".chat-body .mensagens").animate({ scrollTop: $(".chat-body .mensagens")[0].scrollHeight }, 100);
                }


            },



            error: function (xhr, status, error) {
                // Lidar com o erro de resposta do servidor 
                console.error("Erro na requisição AJAX:", status, error);
                $(".chat-body .mensagens").html('<div>Erro ao carregar mensagens. Tente novamente.</div>');
            }

        });
    }

    $(".chat-body .mensagens").animate({ scrollTop: 20000000 }, "slow");

    function atualizarChat(chat_id) {
        setInterval(function () {
            buscarNovasMensagens(chat_id);
        }, 3000);
    }

    // Obtém o chat_id de onde você o armazena
    let chat_id = $(".chat-header").find("#id_chat").text();

   
    atualizarChat(chat_id);
});


