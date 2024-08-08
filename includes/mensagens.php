<?php

//ADICIONA UMA MENSAGEM DE STATUS DA INSERÇÃO NO BANCO DE DADOS

//cadastro com sucesso ou erro
if (isset($_GET['sucesso']) && $_GET['sucesso'] === 'Cadastrado com sucesso') {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Cadastro realizado com sucesso! Faça login agora
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>';
} else if (isset($_GET['erro']) && $_GET['erro'] == 'Erro ao cadastrar') {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Erro ao Registrar, tente novamente!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>';
}

//login com sucesso ou erro
if (isset($_GET['erro']) && $_GET['erro'] == 'Senha incorreta') {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Senha incorreta, tente novamente!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>';
} else if (isset($_GET['erro']) && $_GET['erro'] == 'Email não cadastrado') {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Email não cadastrado, Crie uma conta!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>';
} else if (isset($_GET['erro']) && $_GET['erro'] == 'Erro ao logar') {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Erro ao logar, tente novamente!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>';
}

//atualização dos dados do perfil com sucesso ou erro
if (isset($_GET['sucesso']) && $_GET['sucesso'] == 'Atualizado com sucesso') {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Atualizado com sucesso!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>';
} else if (isset($_GET['erro']) && $_GET['erro'] == 'Erro ao atualizar') {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Erro ao atualizar, tente novamente!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>';
}

//atualização da foto do perfil com sucesso ou erro
if (isset($_GET['erro']) && $_GET['erro'] == 'Erro no upload') {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Erro no upload, tente novamente!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>';
} else if (isset($_GET['erro']) && $_GET['erro'] == 'Nenhum arquivo foi enviado') {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Nenhum arquivo foi enviado, tente novamente!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>';
} else if (isset($_GET['erro']) && $_GET['erro'] == 'Tamanho do arquivo excedido') {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Tamanho do arquivo excedido, tente novamente!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>';
} else if (isset($_GET['erro']) && $_GET['erro'] == 'extensao_invalida') {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Extensão inválida, tente novamente!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>';
} else if (isset($_GET['erro']) && $_GET['erro'] == 'Erro desconhecido') {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Erro desconhecido, tente novamente!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>';
} else if (isset($_GET['erro']) && $_GET['erro'] == 'Erro no banco de dados') {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Erro no banco de dados, tente novamente!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>';
}

//criação de pedido com sucesso ou erro
if (isset($_GET['sucesso']) && $_GET['sucesso'] == 'Pedido criado com sucesso') {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Pedido criado com sucesso!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>';
} else if (isset($_GET['erro']) && $_GET['erro'] == 'Erro ao criar pedido') {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Erro ao criar pedido, tente novamente!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>';
} else if (isset($_GET['erro']) && $_GET['erro'] == 'Erro ao fazer upload da imagem') {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Erro ao fazer upload da imagem, tente novamente
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>';
}

//cadastro de endereço com sucesso ou erro
if (isset($_GET['sucesso']) && $_GET['sucesso'] == 'endereco cadastrado') {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Endereço cadastrado com sucesso!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>';
} else if (isset($_GET['erro']) && $_GET['erro'] == 'endereco não cadastrado') {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Endereço não cadastrado, tente novamente!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>';
}

//confirmação de entrega com sucesso ou erro
if (isset($_GET['entrega']) && $_GET['entrega'] == 'success') {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Entrega confirmada com sucesso!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>';
} else if (isset($_GET['entrega']) && $_GET['entrega'] == 'error') {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Erro ao confirmar entrega, tente novamente!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>';
} else if (isset($_GET['entrega']) && $_GET['entrega'] == 'error?ierro=identidade errada') {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Identidade errada, tente novamente!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>';
} else if (isset($_GET['entrega']) && $_GET['entrega'] == 'error?ierro=cliente não encontrado') {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Cliente não encontrado, tente novamente!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>';
} else if (isset($_GET['entrega']) && $_GET['entrega'] == 'error?erro=pedido não encontrado') {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Pedido não encontrado, tente novamente!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>';
}

//denuncia com sucesso ou erro
if (isset($_GET['denuncia']) && $_GET['denuncia'] == 'success') {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Denúncia realizada com sucesso! Obrigado por ajudar a manter a comunidade segura. o ID da sua denúncia é #' . $_GET['idDenuncia'] . '
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>';
} else if (isset($_GET['denuncia']) && $_GET['denuncia'] == 'error') {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Erro ao denunciar, tente novamente! Obrigado por ajudar a manter a comunidade segura.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>';
}

//cadastro de admin com sucesso ou erro
if (isset($_GET['cadastrado']) && $_GET['cadastrado'] == 'true') {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Admin cadastrado com sucesso! Faça login agora
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>';
} else if (isset($_GET['cadastrado']) && $_GET['cadastrado'] == 'false') {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Erro ao cadastrar admin, tente novamente!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>';
}


//notificação com sucesso ou erro
if (isset($_GET['notificado']) && $_GET['notificado'] == 'success') {
    echo '<div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
           
            Notificação enviada com sucesso! ' . '
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>';
} else if (isset($_GET['notificado']) && $_GET['notificado'] == 'error') {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Erro ao enviar notificação, tente novamente!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>';
}

//bloqueio de usuário com sucesso ou erro
if (isset($_GET['bloqueado']) && $_GET['bloqueado'] == 'true') {
    echo '<div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
            Usuário bloqueado com sucesso!  
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>';
} else if (isset($_GET['bloqueado']) && $_GET['bloqueado'] == 'false') {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Erro ao bloquear usuário, tente novamente! 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>';
}

//senha auterada com sucesso
if (isset($_GET['sucesso']) && $_GET['sucesso'] == 'senhaCadastrada') {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Senha cadastrada com sucesso! Faça login agora
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>';
}

//email enviado com sucesso
if (isset($_GET['sucesso']) && $_GET['sucesso'] == 'emailEnviado') {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Email enviado com sucesso! Verifique sua caixa de entrada e siga as instruções para redefinir sua senha.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>';
}