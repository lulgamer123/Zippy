    <?php
    require '../vendor/autoload.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require_once 'conexao_bd.php';

    //verifica se o botao btn-recupera foi clicado e se o email foi preenchido
    if (isset($_POST['btn-recupera']) && !empty($_POST['emailCadastrado'])) {

        $email = $_POST['emailCadastrado'];



        try {
            //verifica se o email existe no banco de dados
            $sql = "SELECT * FROM tb_usuario WHERE EMAIL_USUARIO = '$email'";
            $stmt = $pdo->query($sql);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                $mail = new PHPMailer(true);


                try {
                    // Configurações do servidor
                    $mail->isSMTP();
                    $mail->Host = 'email-ssl.com.br';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'suporteaocliente@zippyinternacional.com';
                    $mail->Password = 'C0dingd3vs@Email'; // Sua senha
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                    $mail->Port = 465;

                    // Define a codificação de caracteres para UTF-8
                    $mail->CharSet = 'UTF-8';


                    // Configurações do email
                    $mail->setFrom('suporteaocliente@zippyinternacional.com', 'Recupere sua Senha || Zippy Internacional');
                    $mail->addAddress($email);



                    // Conteúdo do email
                    $mail->isHTML(true);
                    $mail->Subject = 'Recuperação de Senha || Zippy Internacional';
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
                    <h1>Zippy || Recuperação de Senha</h1>
                </div>
                <div class="content">
                    <p>Olá,</p>
                    <p>Recebemos uma solicitação para recuperação de senha para o email cadastrado em nosso sistema.</p>
                    <p>Se você não solicitou a recuperação de senha, por favor, ignore este email.</p>
                    <p>Caso tenha solicitado, clique no link abaixo para redefinir sua senha:</p>
                    <p><a href="https://zippyinternacional.com/pages/recuperaSenha.php?email=' . $email . '">Redefinir Senha</a></p>
                    <p>Atenciosamente,</p>
                    <p>Equipe Zippy Internacional</p>
                </div>
                <div class="footer">
                    <p>&copy; ' . date('Y') . ' Zippy Internacional. Todos os direitos reservados.</p>
                </div>
            </div>
        </body>
        </html>';

                    $mail->send();
                    header("Location: ../pages/autenticacao/login.php?sucesso=emailEnviado");
                } catch (Exception $e) {
                    echo "Erro Email: {$e->getMessage()}";
                }
            } else {
                echo "<script>alert('Email não cadastrado!')</script>";
            }
        } catch (PDOException $e) {
            echo "Error buscar email: " . $e->getMessage();
        }
    }
