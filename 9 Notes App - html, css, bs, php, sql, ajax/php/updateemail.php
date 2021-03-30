<?php

session_start();

//connect to database

include "./connection.php";

//get userid
$user_id = $_SESSION['id'];
$newemail = $_POST['newemail'];

$sql = "SELECT * FROM users WHERE email = '$newemail'";
$result = $conn->query($sql);
$count = $result->num_rows;

if($count > 0){
    echo "<div class='alert alert-danger'>This email address already exists</div>";
    exit;
};

$sql = "SELECT * FROM users WHERE id = $user_id";
$result = $conn->query($sql);
$count = $result->num_rows;
if($count == 1){
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $username = $row['username'];
    $email = $row['email'];
}else{
    echo "<div class='alert alert-danger'>There was an error getting data from database</div>";
    exit;
};

//create activation code
$activationkey = bin2hex(openssl_random_pseudo_bytes(16));

$sql = "UPDATE users SET activation2 = '$activationkey' WHERE ID = '$user_id'";
$result = $conn->query($sql);

if(!$result){
    echo "<div class='alert alert-danger'>An error occured connecting to the server, please try again later</div>";
    echo "<div class='alert alert-danger'>".$conn->error."</div>";
    exit;
}

//email activation key
$message = "Please click on this link to activate your new email address:\n\n";
$message .= "http://127.0.0.1/projects/9%20Notes%20App%20-%20html,%20css,%20bs,%20php,%20sql,%20ajax/php/activateemail.php?email=".urlencode($email)."&newemail=".urlencode($newemail)."&key=$activationkey";

if(mail($newemail, 'Confirm your new email address', $message, 'From:'.'FWRTech@gmail.com')){
   echo "<div class='alert alert-success'>A confirmation email has been sent to $email. Please click on the activation link</div>";
    exit;
};

?>