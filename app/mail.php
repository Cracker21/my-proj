<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/*require ROOT. '/mail/Exception.php';
require ROOT. '/mail/PHPMailer.php';
require ROOT. '/mail/SMTP.php';*/
require ROOT.'/config.php';

$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 0; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
$mail->Host = "smtp.gmail.com";
$mail->Port = 587; // TLS only
$mail->SMTPSecure = 'tls'; // ssl is deprecated
$mail->CharSet = "utf-8";
$mail->SMTPAuth = true;
$mail->Username = $EMAIL; // email
$mail->Password = $EMAIL_PASS; // password
$mail->setFrom('no-reply@pent.com', 'Pentagram'); // From email and name
//$mail->addAddress($EMAIL, 'Mr. Brown'); // to email and name
//$mail->Subject = '';
$mail->msgHTML("test body"); 
$mail->AltBody = 'HTML messaging not supported'; // If html emails is not supported by the receiver, show this body
$mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );
