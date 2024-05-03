<?php

ini_set('display_errors', 1); // Ativa a exibiчуo de erros
ini_set('display_startup_errors', 1); // Ativa a exibiчуo de erros durante a inicializaчуo
error_reporting(E_ALL); // Relata todos os tipos de erros

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';  // Certifique-se de que o caminho atщ o autoload estс correto

// Verifica se o formulсrio foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = isset($_POST['name']) ? $_POST['name'] : "Nome nуo informado";
    $email = isset($_POST['email']) ? $_POST['email'] : "email@example.com";
    $assunto = isset($_POST['subject']) ? $_POST['subject'] : "Sem assunto";
    $mensagem = isset($_POST['message']) ? $_POST['message'] : "Nenhuma mensagem fornecida";

    $mail = new PHPMailer(true);
    $mail->CharSet = 'UTF-8';

    try {
        // Configuraчуo do Servidor
        $mail->isSMTP();                                      // Definir o uso de SMTP
        $mail->Host = 'smtp.exemplo.com';                     // Especificar o servidor SMTP
        $mail->SMTPAuth = true;                               // Ativar autenticaчуo SMTP
        $mail->Username = 'usuario@exemplo.com';              // Usuсrio SMTP
        $mail->Password = 'senha';                            // Senha SMTP
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;      // Encriptaчуo SSL/TLS
        $mail->Port = 465;                                    // Porta do servidor SMTP


        // Remetentes e destinatсrios
        $mail->setFrom('atendimento@josedarci.com', 'Atendimento'); // remetente email e nome - conta que vai ser configurado para envio pelo servidor de hospedagem
        $mail->addAddress($email, $nome);                     // Adicionar um destinatсrio

        // Conteњdo do Email
        $mail->isHTML(true);                                  // Definir o formato do email para HTML
        $mail->Subject = $assunto;
        $mail->Body = $mensagem;
        $mail->AltBody = strip_tags($mensagem);

        // Lidar com o arquivo enviado
        if (isset($_FILES['fileUpload']) && $_FILES['fileUpload']['error'] == 0) {
            $uploadfile = $_FILES['fileUpload']['tmp_name'];
            $filename = $_FILES['fileUpload']['name'];
            // Anexa o arquivo
            $mail->addAttachment($uploadfile, $filename);
        }

        $mail->send();
        echo 'Mensagem enviada com sucesso';
    } catch (Exception $e) {
        echo "Mensagem nуo pєde ser enviada. Erro do PHPMailer: {$mail->ErrorInfo}";
    }
} else {
    echo "Requisiчуo invсlida. Acesso negado.";
}
?>