function buscarChats() {
    var usuarioId = document.getElementById('id-usuario').value;
    

    var xhr = new XMLHttpRequest();
    xhr.open('GET', '../actions/buscar_chats.php?usuario_id=' + usuarioId, true);

    xhr.onload = function () {
        if (xhr.status >= 200 && xhr.status < 300) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
                var listaChats = document.getElementById('nomeChat');
                listaChats.innerHTML = '';
                response.chats.forEach(function (chat) {
                    var listItem = document.createElement('li');


                    listItem.textContent = chat.usuario_id;
                    listItem.className = 'list-group-item';
                    listItem.addEventListener('click', function () {
                        document.getElementById('chat-atual').textContent = chat.id;
                        document.getElementById('num-pedido').textContent = chat.pedido_id;
                        buscarEMostrarMensagens(chat.id);
                    });

                    listaChats.appendChild(listItem);

                });
            } else {
                alert(response.message);
            }
        } else {
            alert('Erro ao buscar os chats. Por favor, tente novamente mais tarde.');
        }
    };
    xhr.send();
}

// Adiciona um evento de clique ao botão "Enviar Mensagem"
document.getElementById('btn-enviar').addEventListener('click', function () {
    // Obtém o chatID do chat selecionado (você pode obter de onde quiser)
    var chatId = document.getElementById('chat-atual').textContent
    var numPedido = document.getElementById('num-pedido').textContent
    var usuarioId = document.getElementById('dropdownMenuButton').value;

    // Chama a função enviarMensagem com o chatID e o conteúdo da mensagem
    enviarMensagem(chatId, numPedido, usuarioId);
});

function enviarMensagem(chatId, numPedido, usuarioId) {
    var mensagemConteudo = document.getElementById('conteudoMensagem').value;
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../actions/enviar_mensagem.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        if (xhr.status >= 200 && xhr.status < 300) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
                // Mensagem enviada com sucesso
                buscarEMostrarMensagens(chatId);
            } else {
                alert(response.message);
            }
        } else {
            alert('Erro ao enviar a mensagem. Por favor, tente novamente mais tarde.');
        }
    };

    var dados = 'chat_id=' + chatId + '&usuarioId=' + usuarioId + '&numPedido=' + numPedido + '&mensagem=' + encodeURIComponent(mensagemConteudo);

    xhr.send(dados);
}


// Função para buscar e exibir as mensagens mais recentes associadas ao chat
function buscarEMostrarMensagens(chatId) {

   
    // Faça uma nova solicitação AJAX para buscar as mensagens associadas ao chatId
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '../actions/buscar_mensagens.php?chat_id=' + chatId, true);

    xhr.onload = function () {
        if (xhr.status >= 200 && xhr.status < 300) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
                // Limpe a lista de mensagens
                var mensagemChat = document.getElementById('mensagem-chat');
                mensagemChat.innerHTML = '';

                // Adicione as mensagens à lista
                response.mensagens.forEach(function (mensagem) {
                    // Crie um novo elemento de caixa de mensagem
                    var messageBox = document.createElement('div');
                    messageBox.classList.add('message-box');
                
                    // Adicione o conteúdo da mensagem à caixa de mensagem
                    var remetente = mensagem.remetente;
                    var destinatario = mensagem.destinatario; // Adicionando o nome do destinatário
                    var texto = mensagem.texto;
                    
                    // Exiba o remetente, destinatário e o texto da mensagem na caixa de mensagem
                    messageBox.textContent = 'Remetente: ' + remetente + '\nDestinatário: ' + destinatario + '\nMensagem: ' + texto;
                
                    // Adicione a caixa de mensagem à div de mensagens
                    mensagemChat.appendChild(messageBox);
                });
                

            } else {
                alert(response.message);
            }
        } else {
            alert('Erro ao buscar mensagens. Por favor, tente novamente mais tarde.');
        }
    };

    xhr.send();
}


buscarChats();
