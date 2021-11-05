<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = '';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'contato@wishaudiovisual.com.br';                     //SMTP username
    $mail->Password   = '';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('contato@wishaudiovisual.com.br', 'Contato Wish Audiovisual');
    $mail->addAddress('jonatasgamasouza@hotmail.com',);     //Add a recipient
    //$mail->addReplyTo('info@example.com', 'Information');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Novo Contato';
    $mail->Body    = 'Nome: '.$_POST['name'].'<br>'.
					 'E-mail: '.$_POST['email'].'<br>'.
					 'Telefone: '.$_POST['phone'].'<br>'.
					 'Mensagem: '.$_POST['message'];
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if($mail->send()){
		$msg = array("message" => "E-mail enviado com sucesso");
		header('Content-Type: application/json; charset=utf-8');
		return json_encode($msg);
	}
	
} catch (Exception $e) {
    //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	$msg = array("message" => "Falha ao enviar o e-mail: {$mail->ErrorInfo}");
	header('Content-Type: application/json; charset=utf-8');
	return json_encode($msg);
}