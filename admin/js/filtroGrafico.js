$(document).ready(function() {

    $('#btn-data').click(function(e) {
        e.preventDefault();
        $.ajax({
            url: 'actionsAdmin/somaTotal.php',
            type: 'POST',
            data: {
                agrupar: 1
            },
            success: function(response) {
                console.log(response);
                let data = JSON.parse(response);
                updateTable(data);
            }


        });
    });

    $('#btn-entrada').click(function(e) {
        e.preventDefault();
        $.ajax({
            url: 'actionsAdmin/somaTotal.php',
            type: 'POST',
            data: {
                agrupar: 2
            },
            success: function(response) {
                console.log(response);
                let data = JSON.parse(response);
                updateTable(data);
            }
        });
    });

    $('#visaoGeral').click(function(e) {
        e.preventDefault();
        $.ajax({
            url: 'actionsAdmin/somaTotal.php',
            type: 'POST',
            data: {
                agrupar: 3
            },
            success: function(response) {
                console.log(response);
                let data = JSON.parse(response);

                var tableBody = $('table tbody');
                var tableHead = $('table thead');

                tableHead.empty(); // Limpa o conteúdo existente
                tableBody.empty(); // Limpa o conteúdo existente

                var newHead = `
            <tr>
                    <th>ID</th>
                    <th>ID Pedido</th>
                    <th>Valor Transferido</th>
                    <th>Data da Transferência</th>
                    <th>ID Transação</th>
                    <th>Observações</th>
            </tr>
        `;

                tableHead.append(newHead); // Adiciona a nova linha de cabeçalho

                // Itera sobre os dados recebidos e cria novas linhas na tabela
                data.forEach(function(row) {

                    var newRow = `
            <tr>
                <td>${row.ID}</td>
                <td>${row.ID_PEDIDO}</td>
                <td id="valor">${row.VALOR_TRANSFERIDO}</td>
                <td id="dta">${row.DATA_TRANSFERENCIA}</td>
                <td>${row.ID_TRANSACAO}</td>
                <td>${row.OBSERVACOES}</td>
            </tr>
        `;

                    tableBody.append(newRow);

                });

            }

        });


        // Atualiza o gráfico com os dados da tabela
        updateChart();
    });

    function updateTable(data) {
        var tableBody = $('table tbody');
        var tableHead = $('table thead');

        tableHead.empty(); // Limpa o conteúdo existente
        tableBody.empty(); // Limpa o conteúdo existente

        var newHead = `
            <tr>
                    <th>Data</th>
                    <th>Total Transferido</th>
            </tr>
        `;

        tableHead.append(newHead); // Adiciona a nova linha de cabeçalho

        // Itera sobre os dados recebidos e cria novas linhas na tabela
        data.forEach(function(row) {

            var newRow = `
            <tr>
                <td id="dta">${row.DATA}</td>
                <td id="valor">${row.TOTAL_TRANSFERIDO}</td>
            </tr>
        `;

            tableBody.append(newRow);

        });

        // Atualiza o gráfico com os dados da tabela
        updateChart();


    }
});