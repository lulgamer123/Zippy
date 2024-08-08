
<?php

// Aumenta o tempo máximo de execução para 300 segundos
ini_set('max_execution_time', 300);

require_once 'conexao_bd.php';
require '../vendor/autoload.php'; // Inclui o autoload do Composer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_GET['NOME'])) {

    try{
        $nome = $_GET['NOME'];
    $descricao = $_GET['MOTIVO'];
    $idDenuncia = $_GET['IdDenuncia'];

    $sql = "SELECT * FROM tb_cliente WHERE NOME_CLIENTE = :nome";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->execute();

    $result = $stmt->fetchAll();
    $idUsuario = $result[0]['ID_CLIENTE'];

    $sql = "SELECT * FROM tb_usuario WHERE ID_USUARIO = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $idUsuario);
    $stmt->execute();

    $resultDois = $stmt->fetchAll();

    $email = $resultDois[0]['EMAIL_USUARIO'];

    //atualiza a denuncia para atendida
    $sql = "UPDATE tb_denuncia SET STATUS_DENUNCIA = 'Atendido' WHERE ID_DENUNCIA = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $idDenuncia);
    $stmt->execute();

    } catch (Exception $e) {
        echo "Erro ao notificar o usuário. Erro: {$e->getMessage()}";
    }
    

    
    $mail = new PHPMailer(true);

    try {
        // Configurações do servidor
        $mail->isSMTP();
        $mail->Host = 'email-ssl.com.br'; // Defina o servidor SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'suporteaocliente@zippyinternacional.com'; // Seu endereço de email
        $mail->Password = 'C0dingd3vs@Email'; // Sua senha
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

         // Define a codificação de caracteres para UTF-8
         $mail->CharSet = 'UTF-8';
        

        // Configurações do email
        $mail->setFrom('suporteaocliente@zippyinternacional.com', 'Voce foi denunciado || Zippy Internacional');
        $mail->addAddress($email); 

        // Conteúdo do email
        $mail->isHTML(true);
        $mail->Subject = 'Notificação de Denúncia';
        $mail->Body = '
        <html>
        <head>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f4;
                    margin: 0;
                    padding: 0;
                }
                .email-container {
                    background-color: #ffffff;
                    margin: 20px auto;
                    padding: 20px;
                    border-radius: 8px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    max-width: 600px;
                }
                .header {
                    text-align: center;
                    padding-bottom: 20px;
                }
                .header img {
                    max-width: 150px;
                }
                .content {
                    color: #333333;
                    line-height: 1.6;
                }
                .footer {
                    text-align: center;
                    font-size: 12px;
                    color: #777777;
                    padding-top: 20px;
                }
            </style>
        </head>
        <body>
            <div class="email-container">
                <div class="header">
                   
                    <img src="https://zippyinternacional.com/img/logoZippy.png" alt="Logo da Empresa">
                    <h1>Zippy || Notificação de Denuncia</h1>
                </div>
                <div class="content">
                    <p>Olá,</p>
                    <p>Você recebeu uma denúncia na nossa plataforma.</p>
                    <p><strong>Motivo da denúncia:</strong> ' . htmlspecialchars($descricao, ENT_QUOTES, 'UTF-8') . '</p>
                    <p>Entre em contato com o suporte para mais informações e informe o ID da denúncia <strong>#' . htmlspecialchars($idDenuncia, ENT_QUOTES, 'UTF-8') . '</strong>.</p>
                    <p>Se você receber mais denúncias, sua conta será bloqueada.</p>
                </div>
                <div class="footer">
                    <p>&copy; ' . date('Y') . ' Zippy Internacional. Todos os direitos reservados.</p>
                </div>
            </div>
        </body>
        </html>';

        $mail->AltBody = 'Você recebeu uma denúncia na nossa plataforma. Se você receber mais denúncias, sua conta será bloqueada.';

        $mail->send();
        header('Location: ../admin/admin.php?notificado=success&status=Pendente');

    } catch (Exception $e) {
        echo "A mensagem não pôde ser enviada. Mailer Error: {$mail->ErrorInfo}";
    }
}   
