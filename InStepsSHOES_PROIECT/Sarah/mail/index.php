<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

function trimitemail($cui,$nume,$continut,&$pozanume){

require '../inc/phpmail/Exception.php';
require '../inc/phpmail/PHPMailer.php';
require '../inc/phpmail/SMTP.php';

$mail = new PHPMailer();

try {
//$mail->SMTPDebug = SMTP::DEBUG_SERVER;
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'srh.nemeth';
$mail->Password   = 'Ti19bi69';
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port       = 587;
$mail->setFrom('srh.nemeth@gmail.com', 'Sarah');
$mail->addAddress($cui,$nume);
$mail->addReplyTo('srh.nemeth@gmail.com', 'Sarah');
$mail->isHTML(true);
$mail->Subject = 'Comanda Dvs. de la InStepSHOES store';
$mail->Body = $continut;
$mail->AltBody = '';

//$file_to_attach = '../imagini/Logo.png';

//$mail->addAttachment( $file_to_attach,'Logo.png');
$mail->addEmbeddedImage('../imagini/Logo.png','logo');
for ($i = 0; $i < count($pozanume); $i++){
    $mail->addEmbeddedImage('../imagini/'.$pozanume[$i],'poza'.strval($i));
}
$mail->send();
echo 'Mesaj transmis!';
} 
catch (Exception $e) {
    echo "Mesajul nu a putut fi transmis! Eroare: {$mail->ErrorInfo}";
}
}
?>