<?php

include 'headerAdmin.php';
include 'actionsAdmin/buscaTransacoes.php';
?>



<div class="container mt-5">
    <h1>Dashboard de Transações</h1>
    
    <form id="form" action="" method="post">
        <div class="form-group d-flex">
            <button class="btn btn-success" id="btn-data">Agrupar por data</button>
            <button class="btn btn-success" id="btn-entrada">Agrupar por mais entrada</button>
            <button class="btn btn-success" id="visaoGeral">Visao Geral</button>

        </div>
    </form>

    <button id="toggleButton" class="btn btn-primary">Mostrar Gráfico</button>
    <!-- mostrar valores agrupados por data -->

    <div class="table-responsive" id="tableContainer">
        <table class="table table-striped">
            <thead class="thead text-light" style="background-color: #8C76DB;">
                <tr>
                    <th>ID</th>
                    <th>ID Pedido</th>
                    <th>Valor Transferido</th>
                    <th>Data da Transferência</th>
                    <th>ID Transação</th>
                    <th>Observações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($caixa as $row) :

                    $data = $row['DATA_TRANSFERENCIA'];
                    $dataFormatada = date('d/m/Y', strtotime($data));
                ?>

                    <tr>
                        <td><?php echo $row['ID']; ?></td>
                        <td><?php echo $row['ID_PEDIDO']; ?></td>
                        <td id="valor"><?php echo $row['VALOR_TRANSFERIDO']; ?></td>
                        <td id="dta"><?php echo $dataFormatada ?></td>
                        <td><?php echo $row['ID_TRANSACAO']; ?></td>
                        <td><?php echo $row['OBSERVACOES']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div id="chartContainer" class="hidden">
        <i id="tipoGrafico" class="fa-solid fa-chart-column btn btn-primary mt-3"></i>
        <canvas id="valorTransferidoChart"></canvas>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="js/geraGrafico.js"></script>
<script src="js/filtroGrafico.js"></script>


<script>
   
</script>


</body>

</html>