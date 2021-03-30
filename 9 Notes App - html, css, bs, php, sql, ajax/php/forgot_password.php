<?php

session_start();

//connect to database
include "../php/connection.php";

$missingemail = "<p><strong>Please enter a email address.</strong></p>";
$invalidemail = "<p><strong>Please enter a valid email address.</strong></p>";
$notregistered = "<p><strong>This email address is not registered in our system.</strong></p>";

if(empty($_POST['forgotpasswordemail'])){
    $errors .= $missingemail;
}else{
    $email = filter_var($_POST['forgotpasswordemail'], FILTER_SANITIZE_EMAIL);
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors .= $invalidemail;
    }
};

if($errors){
    echo "<div class='alert alert-danger'>".$errors."</div>";
    exit;
}

//prep vars for sql
$email = $conn->real_escape_string($email);

$sql = "SELECT * FROM users WHERE email = '$email'";

$result = $conn->query($sql);

//check if user email exist
if($result->num_rows !== 1){
    $errors .= $notregistered;
    echo "<div class='alert alert-danger'>".$errors."</div>";
    exit;
};


//get data and set vars for new sql call
$row = $result->fetch_array(MYSQLI_ASSOC);
$user_id = $row['id'];
$key = bin2hex(openssl_random_pseudo_bytes(16));
$time = time();
$status = 'pending';

$sql = "INSERT INTO forgotpassword(user_id, resetkey, time, status) VALUES ('$user_id', '$key', '$time', '$status')";

$result = $conn->query($sql);

if(!$result){
    echo "<div class='alert alert-danger'>An error occured sending data to the server, please try again later</div>";
    echo "<div class='alert alert-danger'>".$conn->error."</div>";
    exit;
};

//send activation link
$message = "Please click on this link to reset your password:\n\n";
$message .= "http://127.0.0.1/projects/9%20Notes%20App%20-%20html,%20css,%20bs,%20php,%20sql,%20ajax/php/resetpassword.php?user_id=$user_id&key=$key";

if(mail($email, 'Confirm your password reset', $message, 'From:'.'FWRTech@gmail.com')){
   echo "<div class='alert alert-success'>A confirmation email has been sent to $email. Please click on the activation link</div>";
    exit;
};



?>