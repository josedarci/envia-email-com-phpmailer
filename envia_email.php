<?php

ini_set('display_errors', 1); // Ativa a exibi��o de erros
ini_set('display_startup_errors', 1); // Ativa a exibi��o de erros durante a inicializa��o
error_reporting(E_ALL); // Relata todos os tipos de erros

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';  // Certifique-se de que o caminho at� o autoload est� correto

// Verifica se o formul�rio foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = isset($_POST['name']) ? $_POST['name'] : "Nome n�o informado";
    $email = isset($_POST['email']) ? $_POST['email'] : "email@example.com";
    $assunto = isset($_POST['subject']) ? $_POST['subject'] : "Sem assunto";
    $mensagem = isset($_POST['message']) ? $_POST['message'] : "Nenhuma mensagem fornecida";

    $mail = new PHPMailer(true);

    try {
        // Configura��o do Servidor
        $mail->isSMTP();                                      // Definir o uso de SMTP
        $mail->Host = 'smtp.exemplo.com';                     // Especificar o servidor SMTP
        $mail->SMTPAuth = true;                               // Ativar autentica��o SMTP
        $mail->Username = 'usuario@exemplo.com';              // Usu�rio SMTP
        $mail->Password = 'senha';                            // Senha SMTP
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;   // Ativar criptografia TLS
        $mail->Port = 587;                                    // Porta TCP para conectar

        // Remetentes e destinat�rios
        $mail->setFrom($email, $nome);
        $mail->addAddress('para@exemplo.com', 'Joe User');    // Adicionar um destinat�rio

        // Conte�do do Email
        $mail->isHTML(true);                                  // Definir o formato do email para HTML
        $mail->Subject = $assunto;
        $mail->Body = $mensagem;
        $mail->AltBody = strip_tags($mensagem);

        $mail->send();
        echo 'Mensagem enviada com sucesso';
    } catch (Exception $e) {
        echo "Mensagem n�o p�de ser enviada. Erro do PHPMailer: {$mail->ErrorInfo}";
    }
} else {
    echo "Requisi��o inv�lida. Acesso negado.";
}
?>