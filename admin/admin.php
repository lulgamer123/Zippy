<?php

include 'headerAdmin.php';

?>



    <!-- Main Content -->
    <div class="container">
        <?php include '../includes/mensagens.php'; ?>
        <h1 class="mt-4">Usuários Denunciados</h1>
        <hr>
        <div class="container">
            <div class="row">
                <div class="col">
                    <form action="">
                        <div class="form-group d-flex align-items-center">
                            <label for="search" class="mr-2">Pesquisar pelo ID</label>
                            <input type="text" id="search" name="searchID" class="form-control mr-2" placeholder="Pesquisar por ID">
                            <button type="submit" class="btn btn-success">Pesquisar</button>
                        </div>
                    </form>
                </div>
                <div class="col">
                    <form action="">
                        <div class="form-group d-flex align-items-center">
                            <label for="status" class="mr-2">Filtrar por Status</label>
                            <select name="status" id="status" class="form-control mr-2">
                                <option value="0">Selecione</option>
                                <option value="Pendente">Pendente</option>
                                <option value="Atendido">Atendido</option>
                            </select>
                            <button type="submit" class="btn btn-success">Filtrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="thead text-light" style="background-color: #8C76DB;">
                    <tr>
                        <th>ID da denuncia</th>
                        <th>Status Denuncia</th>
                        <th>Nome</th>
                        <th>Motivo da Denúncia</th>
                        <th>Data</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    include '../actions/busca_denuncias.php';

                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>