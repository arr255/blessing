<?php
header("Content-Type: text/html;charset=utf-8");
$frommail=$_POST['frommail'];
$password=$_POST['password'];
$mailnumber=$_COOKIE['mailnumber'];
$tomail=array();
for($i=1;$i<=$mailnumber;$i++){
    array_push($tomail,$_POST['tomail_'.(string)$i]);
}
$message=$_POST['message'];
$pic=$_POST['pic'];
$file=$_POST['file'];

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load composer's autoloader
require 'vendor/autoload.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.163.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = $frommail;                 // SMTP username
    $mail->Password = $password;                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 25;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom($frommail, 'Mailer');
    // $mail->addAddress('1269680819@qq.com');     // Add a recipient
    // $mail->addAddress('1685316406@qq.com');               // Name is optional
    for($i=0;$i<$mailnumber;$i++){
        $mail->addAddress($tomail[$i]);
    }

    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
//    $mail->addAttachment($file);         // Add attachments
//    $mail->addAttachment($pic, 'new.jpg');    // Optional name

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Happy New Year';
    $mail->Body    = $message;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}