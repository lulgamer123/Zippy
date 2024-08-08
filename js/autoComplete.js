// Função para carregar opções de países
function carregarPaises() {
    fetch('https://restcountries.com/v3.1/all')
        .then(response => response.json())
        .then(data => {
            const paises = data.map(country => country.name.common);
            const origemInput = document.getElementById('origem');
            const destinoInput = document.getElementById('destino');

            // Autocompletar para o campo de origem
            autocomplete(origemInput, paises);

            // Autocompletar para o campo de destino
            autocomplete(destinoInput, paises);
        })
        .catch(error => console.error('Erro ao carregar os países:', error));
}

// Função para autocompletar
function autocomplete(input, listaPaises) {
    input.addEventListener('input', function() {
        const valorDigitado = this.value;
        let sugeridos = [];
        if (valorDigitado.length > 0) {
            sugeridos = listaPaises.filter(pais =>
                pais.toLowerCase().includes(valorDigitado.toLowerCase())
            );
        }
        mostrarSugestoes(input, sugeridos);
    });
}

// Função para exibir sugestões
function mostrarSugestoes(input, sugestoes) {
    const autocompleteContainer = input.nextElementSibling;
    autocompleteContainer.innerHTML = '';
    sugestoes.forEach(sugestao => {
        const sugestaoItem = document.createElement('div');
        sugestaoItem.textContent = sugestao;
        sugestaoItem.addEventListener('click', function() {
            input.value = sugestao;
            autocompleteContainer.innerHTML = '';
        });
        autocompleteContainer.appendChild(sugestaoItem);
    });
}

// Chama a função para carregar os países quando a página carrega
window.onload = carregarPaises;