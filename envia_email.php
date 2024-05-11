<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

define('RECAPTCHA_SECRET_KEY', '6LdGYNEpAAAAAKUwbYDjjZVWNysO2nGyf-dzhCfP');

header('Content-Type: application/json');

function jsonResponse($status, $message)
{
    http_response_code($status);
    echo json_encode(['message' => $message]);
    exit;
}

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['g-recaptcha-response'])) {
    $recaptchaResponse = $_POST['g-recaptcha-response'];
    $verifyResponse = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . RECAPTCHA_SECRET_KEY . "&response={$recaptchaResponse}");

    $responseData = json_decode($verifyResponse);

    if ($responseData->success) {  // Verificação do reCAPTCHA foi um sucesso
        $nome = isset($_POST['name']) ? $_POST['name'] : "Nome não informado";
        $email = isset($_POST['email']) ? $_POST['email'] : "email@example.com";
        $assunto = isset($_POST['subject']) ? $_POST['subject'] : "Sem assunto";
        $mensagem = isset($_POST['message']) ? $_POST['message'] : "Nenhuma mensagem fornecida";

        $mail = new PHPMailer(true);
        $mail->CharSet = 'UTF-8';

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.titan.email'; // Servidor SMTP do Titan
            $mail->SMTPAuth = true;
            $mail->Username = 'atendimento@josedarci.com'; // Seu e-mail do Titan
            $mail->Password = 'Jdti@142536'; // Senha do e-mail do Titan
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // EncriptaÃ§Ã£o SSL/TLS
            $mail->Port = 465; // Porta do servidor SMTP

            // Destinatários
            $mail->setFrom('atendimento@josedarci.com', 'Atendimento Jose Darci');
            $mail->addAddress($email, $nome); // Adiciona um destinatário

            $mail->isHTML(true);
            $mail->Subject = $assunto;
            $mail->Body = $mensagem;
            $mail->AltBody = strip_tags($mensagem);

            if (isset($_FILES['fileUpload']) && $_FILES['fileUpload']['error'] == 0) {
                $uploadfile = $_FILES['fileUpload']['tmp_name'];
                $filename = $_FILES['fileUpload']['name'];
                $mail->addAttachment($uploadfile, $filename);
            }

            $mail->send();
            jsonResponse(200, 'Mensagem enviada com sucesso');
        } catch (Exception $e) {
            jsonResponse(500, "Mensagem não pôde ser enviada. Erro do PHPMailer: {$mail->ErrorInfo}");
        }
    } else {
        jsonResponse(400, "Falha ao marcar o reCAPTCHA. Por favor, tente novamente.");
    }
} else {
    jsonResponse(403, "Requisição inválida. Acesso negado.");
}