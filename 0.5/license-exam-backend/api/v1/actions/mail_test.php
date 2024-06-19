<?php


require_once 'config.php';
require_once 'db/db.php';
require_once 'utils/tasks.php';
require_once 'utils/general.php';
require_once 'utils/security.php';



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;



//echo __DIR__ . "/../../../vendor/autoload.php";
//echo __DIR__ . '/../lib/phpmailer/Exception.php';

// require __DIR__ . '/../lib/phpmailer/Exception.php';
// require __DIR__ . '/../lib/phpmailer/PHPMailer.php';
// require __DIR__ . '/../lib/phpmailer/SMTP.php';

///*

require_once __DIR__ . "/../../../vendor/autoload.php";


// create a new object
$mail = new PHPMailer();
// configure an SMTP
$mail->isSMTP();


$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = '';
$mail->Password = '';
$mail->Port = 587;
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

$mail->SMTPDebug = SMTP::DEBUG_SERVER;
//$mail->SMTPDebug  = 3;   

//$mail->setFrom(address: 'gellert@students.csik.sapientia.ro', name: 'Your Hotel');
//$mail->setFrom(address: 'zoldcsirke0@gmail.com', name: 'Your Hotel');
$mail->addAddress('zoldcsirke0@gmail.com', 'Me');
//$mail->addAddress('fileplevente@uni.sapientia.ro', 'Me');
$mail->addAddress('ferenczigellert@uni.sapientia.ro', 'Me');

$mail->Subject = 'Thanks for choosing Our Hotel!';

// Set HTML
$mail->isHTML(isHtml: TRUE);
$mail->Body = '<html>Hi there, we are happy to <b>confirm your booking.</b><br>now one.</html>';
$mail->AltBody = 'Hi there, we are happy to confirm your booking. Please check the document in the attachment.';

// add attachment
// just add the 'path/to/file.pdf', 'filename.pdf'
// $attachmentPath = '/confirmations/yourbooking.pdf';
// if (file_exists($attachmentPath)) {
//     $mail->addAttachment($attachmentPath, name: 'yourbooking.pdf');
// }

if (!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}



//*/

/*

SendEmail('ferenczigellert@uni.sapientia.ro', 'Ferencz Gellért', 'test', 'test');
SendEmail('zoldcsirke0@gmail.com', 'Ferencz Gellért', 'test', 'test');

*/





