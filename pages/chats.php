<?php

include '../actions/conexao_bd.php';
include '../includes/header.php';
include '../includes/mensagens.php';
include '../actions/chat/buscar_chats.php';



?>


<div class="container-chat">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <!-- lista de todos os chats iniciados -->
                <h2>Chats</h2>
                <ul class="nomeChat">
                    <?php
                    // Verifica se existem chats na sessão
                    if (isset($_SESSION["chats"]) && !empty($_SESSION["chats"])) {
                        // Exibe os chats na lista
                        foreach ($_SESSION["chats"] as $chat) {
                            $chat_id = $chat['ID_CHAT'];
                            $remetente = $chat['REMETENTE'];
                            $destinatario = $chat['DESTINATARIO'];
                            $nome_remetente = $chat['NOME_REMETENTE'];
                            $nome_destinatario = $chat['NOME_DESTINATARIO'];
                            $id_pedido = $chat['ID_PEDIDO'];

                            // Define o nome a ser exibido com base no papel do usuário no chat
                            $nome_chat = ($nome_destinatario == $_SESSION["nome"]) ? $nome_remetente : $nome_destinatario;

                            if (isset($_SESSION['pedidos']) && !empty($_SESSION['pedidos'])) {
                                foreach ($_SESSION['pedidos'] as $pedido) {
                                    if ($pedido['ID_POSTAGEM'] == $id_pedido) {
                                        $id_postagem = $pedido['ID_POSTAGEM'];
                                    }
                                }
                            } else {
                                $id_postagem = $id_pedido;
                            }


                    ?>

                            <li class='list-group-item'>
                                <a href="<?= $baseUrl ?>/pages/chats.php?ID_POSTAGEM=<?= $id_postagem ?>&ID_CHAT=<?= $chat_id ?>&destinatario=<?= $nome_destinatario ?>&remetente=<?= $nome_remetente ?>" data-remetente='$remetente' data-destinatario='$destinatario'>
                                    Chat <?= $nome_chat ?>
                                </a>
                            </li>

                    <?php
                        }
                    } else {
                        // Se não houver chats na sessão, exibe uma mensagem
                        echo "<li class='list-group-item'>Nenhum chat encontrado.</li>";
                    }
                    ?>
                </ul>



            </div>
            <!-- Chat Atual -->
            <div class="col-lg-8">
                <div class="chat">
                    <div class="chat-header">
                        <h2>Chat com
                            <span style="display: none;" id="id_chat"><?= $_GET['ID_CHAT'] ?? "" ?></span>

                            <?php
                            $destinatario = $_GET['destinatario'] ?? "";
                            if ($destinatario == $_SESSION["nome"]) : ?>
                                <span id="nome_usuario">
                                    <?= $_GET['remetente'] ?? "" ?> <!-- Exibe o nome do remetente -->
                                </span>
                            <?php else : ?>
                                <span id="destinatario"><?= $_GET['destinatario'] ?? "" ?></span>
                            <?php endif; ?>
                        </h2>



                    </div>
                    <div class="chat-body">

                        <?php
                        if (isset($_GET['ID_POSTAGEM'])) {
                            // Escapar o ID de pedido para evitar injeção de SQL
                            $id_postagem = $_GET['ID_POSTAGEM'];

                            // Consulta SQL para buscar o pedido com o ID correspondente
                            $sql = "SELECT * FROM tb_postagem WHERE ID_POSTAGEM = '$id_postagem'";
                            $result = $pdo->query($sql);

                            //verifica se o pedido foi encontrado

                            if ($result->rowCount() > 0) {
                                // Exibir as informações do pedido
                                while ($row = $result->fetchAll(PDO::FETCH_ASSOC)) {

                                    echo "<div class='info-pedido'>
                                                <p>Status do pedido: <span class='badge badge-success'>{$row[0]['STATUS_POSTAGEM']}</span>
                                                <span>Pedido: {$row[0]['PRODUTO_POSTAGEM']}</span>
                                                <span>Número do Pedido: #{$row[0]['ID_POSTAGEM']}</span>
                                                </p>
                                              </div>";
                                    echo "<p id='disclaimerDois' class='alert alert-primary' role='alert'>Por favor, utilize o seguinte modelo de mensagem para combinar o valor de pagamento: <span class='alert-link'> 'combinado: [valor]'</span>. O valor combinado deve ser expresso em sua moeda local. Obrigado!</p>";
                                }
                            } else {

                                echo "<p>Pedido não encontrado.</p>";
                            }
                        }
                        ?>


                        <p id='disclaimer' class='alert alert-primary' role='alert'>O valor combinado foi de R$ <span class="badge badge-success" id="valorCombinado"></span> Vá para o checkout para finalizar o pagamento!</p>
                        <div class="mensagens">
                            <p id="aviso">Selecione um chat:</p>
                            <div class="loading-animation">
                                <img class="caixa-img" src="<?= $baseUrl ?>/img/logoZippy.png" alt="Carregando...">
                                <p>Carregando...</p>
                            </div>
                        </div>
                    </div>

                    <div class="chat-footer">
                        <input type="text" class="form-control mb-1" placeholder="Digite sua mensagem...">
                        <button class="btn btn-primary">Enviar</button>

                        <?php
                        if (isset($_GET['ID_POSTAGEM'])) {
                            // Captura o ID_POSTAGEM da URL
                            $id_postagem = $_GET['ID_POSTAGEM'];

                            // Consulta SQL para buscar o pedido com o ID correspondente
                            $sql = "SELECT * FROM tb_postagem WHERE ID_POSTAGEM = :id_postagem";
                            $stmt = $pdo->prepare($sql);
                            $stmt->bindParam(':id_postagem', $id_postagem, PDO::PARAM_INT);
                            $stmt->execute();

                            // Verifica se o pedido foi encontrado
                            if ($stmt->rowCount() > 0) {
                                // Procura chat na sessão com base no $_GET['ID_CHAT']
                                if (isset($_SESSION['chats']) && !empty($_SESSION['chats'])) {
                                    foreach ($_SESSION['chats'] as $chat) {
                                        if ($chat['ID_CHAT'] == $_GET['ID_CHAT']) {
                                            $destinatario = $chat['DESTINATARIO'];
                                            $remetente = $chat['REMETENTE'];
                                        }
                                    }
                                }

                                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                foreach ($rows as $row) {
                                    echo "<a class='btn btn-success' href='checkout.php?ID_PEDIDO={$row['ID_POSTAGEM']}&ID_CHAT={$_GET['ID_CHAT']}&DESTINATARIO={$destinatario}&REMETENTE={$remetente}&PAGADOR={$_SESSION['id_usuario']}'>Ir para pagamento</a>";
                                    echo "<button class='btn btn-danger ml-2' id='denunciarBtn'>Denunciar Usuário</button>";
                                }
                            }
                        }
                        ?>
                    </div>

                    <!-- Pop-up Modal -->
                    <div id="denunciarModal" class="modal">
                        <div class="modal-content">
                            <span class="close">&times;</span>
                            <h2>Denunciar Usuário</h2>
                            <form action="../actions/denuncia.php" method="POST">
                                <div class="form-group">
                                    <label for="mensagem">Por que você está denunciando este usuário?</label>
                                    <textarea class="form-control" id="mensagem" name="mensagem" rows="4" required></textarea>
                                </div>
                                <input type="hidden" name="nome_denuciado" value="<?php echo $chat['NOME_REMETENTE']?>">
                                <input type="hidden" name="id_postagem" value="<?php echo $id_postagem; ?>">
                                <button type="submit" name="btn-denuncia" class="btn btn-danger">Enviar Denúncia</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <?php
    // Verifica se o ID do chat está presente na URL
    if (isset($_GET['ID_CHAT'])) {
        // Obtém o ID do chat da URL
        $chat_id = $_GET['ID_CHAT'];

        // Inclui o arquivo JavaScript apenas quando um chat está selecionado
        echo "<script src='../js/chats/busca_mensagens.js'></script>";
        echo "<script src='../js/chats/extraiValor.js'></script>";
    }
    ?>

    <script>
        var modal = document.getElementById("denunciarModal");
        var btn = document.getElementById("denunciarBtn");
        var span = document.getElementsByClassName("close")[0];

        btn.onclick = function() {
            modal.style.display = "block";
        }

        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>   

    <script>
        $(".loading-animation").hide();
    </script>


    <script src="../js/responsive.js"></script>
    <script src="../js/chats/enviar_mensagem.js"></script>
    <!-- SCRIPTS BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>



    </body>

    </html>