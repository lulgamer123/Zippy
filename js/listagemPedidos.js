//botao pra subir a pagina

var fomrPesquisa = document.querySelector('.container-pedido');
let btnTop = document.querySelector('#btn-top');

btnTop.addEventListener('click', function () {
    fomrPesquisa.scrollIntoView({
        behavior: 'smooth',
        block: 'start'
    });
});

// Função para rolar para a seção de pedidos disponíveis
function scrollToPedidos() {
    var pedidosSection = document.querySelector('#pedido-disponivel');
    var pedidoSectionVazio = document.querySelector('.container-pedido-disponiveis');



    if (pedidosSection) {
        pedidosSection.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    } else {
        pedidoSectionVazio.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    }
}

// Chame a função scrollToPedidos quando a página for carregada
window.addEventListener('load', scrollToPedidos);