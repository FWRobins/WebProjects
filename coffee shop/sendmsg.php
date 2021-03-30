<?php

session_start();
$mysqli = new mysqli('localhost', 'root', '', 'mywebsite');

if($mysqli->connect_error){    
    die('Error: ('.$mysqli->connect_error.') '.$mysqli->connect_error);
}

$fname = mysqli_real_escape_string($mysqli, $_POST["fname"]);
$email = mysqli_real_escape_string($mysqli, $_POST["email"]);
$message = mysqli_real_escape_string($mysqli, $_POST["message"]);


$email2 = "it@pnastrandgroup.co.za";
$subject = "test email";

//validate and return to ajax 
if(strlen($fname) < 2){
    echo 'fname_short';
} elseif (strlen($fname) > 50){
    echo 'fname_long';
} elseif (strlen($email) < 2){
    echo 'email_short';
} elseif (strlen($email) > 50){
    echo 'email_long';
} elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false){
    echo 'eformat';
} elseif (strlen($message) < 3){
    echo 'message_short';
} elseif (strlen($message) > 500){
    echo 'message_long';
} else {

    
    require 'phpmailer/PHPMailerAutoLoad.php';
    
    $mail = new PHPMailer;
    
    $mail->isSMTP();
    $mail->Host = "smtp-mail.outlook.com";
    $mail->SMTPAuth = true;
    $mail->Username = "it@pnastrandgroup.co.za";
    $mail->Password = "DDA.xhp.136";
    $mail->SMTPSecure = "starttls";
    $mail->Port = "587";
    
    $mail->AddReplyTo($email);
    $mail->From = $email2;
    $mail->FromName = $fname;
//    $mail->setFrom($email, $fname);
    $mail->addAddress("it@pnastrandgroup.co.za", "IT");
    
    $mail->isHTML(true);
    
    $mail->Subject = $subject;
    $mail->Body = $message;
    $mail->AltBody = "This is the body in plaintext for non-HTML mail clients";
    
    if(!$mail->send()){
        echo 'message could not be sent';
        echo "Mailer Error: ".$mail->ErrorInfo;
    } else {
        echo 'true';
    }
    
 }
?>