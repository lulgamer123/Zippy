// Função para extrair o valor do acordo de pagamento
function extrairValorAcordo() {
    var mensagens = document.querySelectorAll(".mensagem");

    var ultimaMensagem = mensagens[mensagens.length - 1];

    var padrao = /combinado:\s*\[?(\d+)\]?/;

    var mensagem = ultimaMensagem.textContent;

    // Procurar pelo padrão na última mensagem
    var resultado = mensagem.match(padrao);
    if (resultado) {
        var valorAcordo = parseInt(resultado[1]);
        return valorAcordo;
    }

    return null;
}

// Função para verificar se todas as mensagens foram carregadas
function verificarMensagensCarregadas() {
    var mensagens = document.querySelectorAll(".mensagem");
    if (mensagens.length > 0) {
        // Se as mensagens foram carregadas, extrair o valor do acordo
        var valorAcordo = extrairValorAcordo();

        if (valorAcordo !== null) {
            document.querySelector("#disclaimerDois").style.display = "none";
            document.querySelector("#disclaimer").style.display = "block";
            document.querySelector("#valorCombinado").textContent = valorAcordo;
            var linkPagamento = document.querySelector(".btn-success");
            var ultimoValorAcordo = null;

            // Verificar se o valor do acordo mudou desde a última verificação
            if (valorAcordo !== null && valorAcordo !== ultimoValorAcordo) {
                // Atualizar o link apenas se o valor do acordo mudou
                var linkPagamento = document.querySelector(".btn-success");
                if (linkPagamento) {
                    linkPagamento.href = linkPagamento.href.replace(/&valorCombinado=\d+/, ""); // Remover o parâmetro anterior, se existir
                    linkPagamento.href += "&valorCombinado=" + valorAcordo; 
                }

                // Atualizar o último valor do acordo
                ultimoValorAcordo = valorAcordo;
            }


            setTimeout(verificarMensagensCarregadas, 1000); 
        } else {
            console.log("Nenhum valor de acordo encontrado nas mensagens do chat.");
            setTimeout(verificarMensagensCarregadas, 1000);
        }
    } else {
        // Se as mensagens ainda não foram carregadas carrega dnv a bagaça
        setTimeout(verificarMensagensCarregadas, 1000); 
    }
}








// Chamar a função de verificação inicialmente
verificarMensagensCarregadas();
