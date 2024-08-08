//pegar as datas da tabela e colocar no gráfico
let datas = document.querySelectorAll('#dta');
let dataFormatada = [];

datas.forEach(data => {
    dataFormatada.push(data.innerText)
})

//pegar os valores da tabela e colocar no gráfico
let valores = document.querySelectorAll('#valor');
let valorFormatado = [];
valores.forEach(valor => {
    valorFormatado.push(valor.innerText)
})



// Dados do gráfico
var ctx = document.getElementById('valorTransferidoChart').getContext('2d');
var chart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: dataFormatada,
        datasets: [{
            label: 'Valores por data ',
            data: valorFormatado,
            backgroundColor: 'rgba(140,118,219, 0.9)',
            borderColor: 'rgba(140,118, 219, 1)',
            borderWidth: 4
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// função para alternar entre gráfico em linha e gráfico em barra

document.getElementById('tipoGrafico').addEventListener('click', function() {
    if (chart.config.type == 'line') {
        chart.config.type = 'bar';

        var oldButton = document.getElementById('tipoGrafico');
        var chartContainer = document.getElementById('chartContainer');

        var newButton = document.createElement('i');
        newButton.id = 'tipoGrafico';
        newButton.className = 'fa-solid fa-chart-column btn btn-primary mt-3';

        // Adiciona o novo botão antes do antigo botão
        chartContainer.insertBefore(newButton, oldButton);

        // Remove o antigo botão
        oldButton.remove();

        // Adiciona o listener ao novo botão
        newButton.addEventListener('click', arguments.callee);

        chart.update();
    } else {
        chart.config.type = 'line';
        var oldButton = document.getElementById('tipoGrafico');
        var chartContainer = document.getElementById('chartContainer');
        
        var newButton = document.createElement('i');
        newButton.id = 'tipoGrafico';
        newButton.className = 'fa-solid fa-chart-line btn btn-primary mt-3';
        
        // Adiciona o novo botão antes do antigo botão
        chartContainer.insertBefore(newButton, oldButton);
        
        // Remove o antigo botão
        oldButton.remove();
        
        // Adiciona o listener ao novo botão
        newButton.addEventListener('click', arguments.callee);
        chart.update();
        
    }
});



// Função para alternar entre tabela e gráfico
document.getElementById('toggleButton').addEventListener('click', function() {

    var tableContainer = document.getElementById('tableContainer');
    var chartContainer = document.getElementById('chartContainer');
    var button = document.getElementById('toggleButton');

    if (tableContainer.classList.contains('hidden')) {
        tableContainer.classList.remove('hidden');
        chartContainer.classList.add('hidden');
        button.textContent = 'Mostrar Gráfico';
    } else {
        tableContainer.classList.add('hidden');
        chartContainer.classList.remove('hidden');
        button.textContent = 'Mostrar Tabela';
    }
});


function updateChart() {
    // Pega as datas da tabela e coloca no gráfico
    let datas = document.querySelectorAll('#dta');
    let dataFormatada = [];
    datas.forEach(data => {
        dataFormatada.push(data.innerText);
    });

    // Pega os valores da tabela e coloca no gráfico
    let valores = document.querySelectorAll('#valor');
    let valorFormatado = [];
    valores.forEach(valor => {
        valorFormatado.push(valor.innerText);
    });

    // Atualiza os dados do gráfico
    chart.data.labels = dataFormatada;
    chart.data.datasets[0].data = valorFormatado;
    chart.update();
}