<?php

global $pdo;
require_once 'conexao_bd.php';

//verifica se botao btn-login foi clicado
if (isset($_POST['btn-login'])) {

    $email = $_POST['loginEmail'];
    $senha = $_POST['loginSenha'];


    try {
        $sql = "SELECT * FROM tb_usuario WHERE EMAIL_USUARIO = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        //se encontrou o email no banco
        if ($stmt->rowCount() > 0) {
           
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            $id_usuario = $usuario['ID_USUARIO'];

            $sql2 = "SELECT * FROM tb_cliente WHERE ID_CLIENTE = :id_usuario";
            $stmt2 = $pdo->prepare($sql2);
            $stmt2->bindParam(':id_usuario', $id_usuario);
            $stmt2->execute();
                
            $sql3 = "SELECT * FROM tb_endereco WHERE ID_USUARIO = :id_usuario";

            $stmt3 = $pdo->prepare($sql3);
            $stmt3->bindParam(':id_usuario', $id_usuario); 
            $stmt3->execute();

            $edereco = $stmt3->fetch(PDO::FETCH_ASSOC);

            $cliente = $stmt2->fetch(PDO::FETCH_ASSOC);

            //se a senha bate
            if (password_verify($senha, $usuario['SENHA_USUARIO'])) {
                session_start();

                //informações do usuario
                $_SESSION['id_usuario'] = $usuario['ID_USUARIO'];
                $_SESSION['email'] = $usuario['EMAIL_USUARIO'];
                $_SESSION['status'] = $usuario['STATUS_USUARIO'];
                $_SESSION['dtaNasc'] = $cliente['DTA_NASC_CLIENTE'];
                $_SESSION['foto_perfil'] = $usuario['FOTO_PERFIL'];

                //informações do cliente
                $_SESSION['id_cliente'] = $cliente['ID_CLIENTE'];
                $_SESSION['nome'] = $cliente['NOME_CLIENTE'];
                $_SESSION['sobrenome'] = $cliente['SOBRENOME_CLIENTE'];
                $_SESSION['fone'] = $cliente['FONE_CLIENTE'];
                $_SESSION['identidade'] = $cliente['IDENTIDADE_CLIENTE'];
                $_SESSION['saldo'] = $cliente['SALDO'] ?? 0;

                //informações do endereço
                $_SESSION['rua'] = $edereco['RUA_ENDERECO'] ?? '';
                $_SESSION['bairro'] = $edereco['BAIRRO_ENDERECO'] ?? '';
                $_SESSION['uf'] = $edereco['ESTADO_ENDERECO'] ?? '';
                $_SESSION['pais'] = $edereco['PAIS_ENDERECO'] ?? '';
                $_SESSION['cidade'] = $edereco['CIDADE_ENDERECO'] ?? '';
                $_SESSION['complemento'] = $edereco['COMPLEMENTO_ENDERECO'] ?? '';
                
                

                header('Location: ../pages/home.php?sucesso=Logado com sucesso');
            } else {
                //se a senha não bate
                header('Location: ../pages/autenticacao/login.php?erro=Senha incorreta');
            }
            //se não encontrou o email no banco
        } else {
            header('Location: ../pages/autenticacao/login.php?erro=Email não cadastrado');
        }
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
        exit();
        header('Location: ../pages/autenticacao/login.php?erro=Erro ao logar');
       
    }
}
