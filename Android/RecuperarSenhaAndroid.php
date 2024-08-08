<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';



include("conexao_bdMSQLI.php");


$email = $_POST["email"];
//$email = "aluiz5342@gmail.com";

// Consulta SQL para verificar se o e-mail existe na tabela de usuários
$sql = "SELECT * FROM tb_usuario WHERE EMAIL_USUARIO = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    $usuario = $result->fetch_assoc();
    $senha = $usuario['SENHA_USUARIO'];

    $mail = new PHPMailer(true);
    try {
        // Configurações do servidor SMTP 
        $mail->setLanguage('br');                                    // Habilita as saídas de erro em Português
        $mail->CharSet = 'UTF-8';                                    // Habilita o envio do email como 'UTF-8'

        //$mail->SMTPDebug = 1;                                      // Habilita a saída do tipo "verbose"

        $mail->isSMTP();                                             // Configura o disparo como SMTP
        $mail->Host = 'email-ssl.com.br';                               // Especifica o enderço do servidor SMTP da Locaweb
        $mail->SMTPAuth = true;                                      // Habilita a autenticação SMTP
        $mail->Username = 'suporteaocliente@zippyinternacional.com'; // Usuário do SMTP
        $mail->Password = 'C0dingd3vs@';                             // Senha do SMTP
        $mail->SMTPSecure = 'ssl';                                   // Habilita criptografia TLS | 'ssl' também é possível
        $mail->Port = 465;                                           // Habilita criptografia TLS | 'ssl' também é possível


        // Configurações do e-mail
        $mail->setFrom('suporteaocliente@zippyinternacional.com', 'Recuperação de Senha - Zippy');
        $mail->addAddress($email);
        $mail->Subject = 'Recuperação de Senha';
        $mail->Body = "Olá,\r\n\r\nVocê solicitou a recuperação de senha. Sua senha é: $senha\r\n\r\nSe você não solicitou essa recuperação, ignore este e-mail.\r\n\r\nAtenciosamente,\r\nSua Equipe";


        $mail->send();

        // Resposta para o app com json 
        $response = array("status" => "ok", "message" => "Um e-mail de recuperação de senha foi enviado para $email");
        echo json_encode($response);
    } catch (Exception $e) {

        $response = array("status" => "error1", "message" => "Erro ao enviar e-mail de recuperação de senha: {$mail->ErrorInfo}");
        echo json_encode($response);
    }
} else {
    // E-mail não encontrado 
    $response = array("status" => "error2", "message" => "O e-mail $email não está registrado");
    echo json_encode($response);
}


$conn->close();
?>