<?php

session_start();

//connect to database

include "../php/connection.php";

//error messages

$missingusername = "<p><strong>Please enter a username.</strong></p>";
$missingemail = "<p><strong>Please enter a email address.</strong></p>";
$invalidemail = "<p><strong>Please enter a valid email address.</strong></p>";
$missingpassword = "<p><strong>Please enter a password.</strong></p>";
$invalidpassword = "<p><strong>Password needs at least 6 characters, one capital letter and one number.</strong></p>";
$passwordmismatch = "<p><strong>Passwords do not match</strong></p>";
$missingpassword2 = "<p><strong>Please confirm password.</strong></p>";

//get user input

if(empty($_POST["username"])){
    $errors .= $missingusername;
}else{
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
}

if(empty($_POST['email'])){
    $errors .= $missingemail;
}else{
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors .= $invalidemail;
    }
}

if(empty($_POST['password'])){
    $errors .= $missingpassword;
}elseif(!(strlen($_POST['password'])>5 and preg_match('/[A-Z]/',$_POST['password']) and preg_match('/[0-9]/',$_POST['password']))){
    $errors .= $invalidpassword;
}else{
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    
}

if(empty($_POST['password2'])){
    $errors .= $missingpassword2;
}elseif($_POST['password2'] !== $_POST['password']){
    $errors .= $passwordmismatch;
}

if($errors){
    echo "<div class='alert alert-danger'>".$errors."</div>";
    exit;
}

$username = $conn->real_escape_string($username);
$email = $conn->real_escape_string($email);
$password = $conn->real_escape_string($password);
$password  = hash('sha256', $password);

//    check if user exists
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = $conn->query($sql);
if(!$result){
    echo "<div class='alert alert-danger'>An error occured connecting to the server, please try again later</div>";
    echo "<div class='alert alert-danger'>".$conn->error."</div>";
    exit;
}

if($result->num_rows > 0){
    echo "<div class='alert alert-danger'>username alreday registered, do you want to login?</div>";
    exit;
}

//check if email exists
$sql = "SELECT * FROM users WHERE email = '$email'";
$result = $conn->query($sql);
if(!$result){
    echo "<div class='alert alert-danger'>An error occured connecting to the server, please try again later</div>";
    echo "<div class='alert alert-danger'>".$conn->error."</div>";
    exit;
}

if($result->num_rows > 0){
    echo "<div class='alert alert-danger'>email alreday registered, do you want to login?</div>";
    exit;
}

//create activation code
$activationkey = bin2hex(openssl_random_pseudo_bytes(16));


//create user in db
$sql = "INSERT INTO users(username, email, password, activation) VALUES('$username','$email', '$password', '$activationkey')";

$result = $conn->query($sql);
if(!$result){
    echo "<div class='alert alert-danger'>An error occured connecting to the server, please try again later</div>";
    echo "<div class='alert alert-danger'>".$conn->error."</div>";
    exit;
}

//email activation key
$message = "Please click on this link to activate your account:\n\n";
$message .= "http://127.0.0.1/projects/9%20Notes%20App%20-%20html,%20css,%20bs,%20php,%20sql,%20ajax/php/activate.php?email=".urlencode($email)."&key=$activationkey";

if(mail($email, 'Confirm your registration', $message, 'From:'.'FWRTech@gmail.com')){
   echo "<div class='alert alert-success'>Thank you for registering, confirmation email has been sent to $email. Please click on the activation link</div>";
    exit;
}



?>