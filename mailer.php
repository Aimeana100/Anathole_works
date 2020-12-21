<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
$successMessage = "";

function send_email($pemail,$pmsg,$pname,$subject){
// Load Composer's autoloader
require 'PhpMailer/vendor/autoload.php';

// Instantiation and passing `true` enables exceptions

$mail = new PHPMailer(true);

    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'sees02100@gmail.com';                     // SMTP username
    $mail->Password   = 'Aimeana12345';                             // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('munyemanaalexis@gmail.com', 'URSTMS');
    $mail->addAddress($pemail,$pname);     // Add a recipient
    $mail->addAddress($pemail);               // Name is optional
    $mail->addReplyTo('aimeanathole@gmail.com', 'Information');
    $mail->addCC('munyemanaalexis@gmail.com');
    $mail->addBCC('Aimeanathole@gmail.com');

    // Attachments
    // $mail->addAttachment('../../images/mess.png');         // Add attachments
    // $mail->addAttachment('images/mess.png', 'mess.png');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $pmsg;
   // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    return $mail->send();
}

 ?>