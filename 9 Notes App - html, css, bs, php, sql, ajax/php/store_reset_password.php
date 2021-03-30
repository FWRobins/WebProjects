<?php

session_start();

//connect to database

include "./connection.php";

//check if key and email recieved
if(!isset($_POST['user_id']) or !isset($_POST['key'])){
    echo "<div class='alert alert-danger'>There was an error, please click on activation link received by email.</div>";
    exit;
}

//set and prep keys for sql
$user_id = $_POST['user_id'];
$key = $_POST['key'];
$time = time()-24*60*60;

$user_id = $conn->real_escape_string($user_id);
$key = $conn->real_escape_string($key);

$sql = "SELECT * FROM forgotpassword WHERE (user_id = '$user_id' and resetkey = '$key' and time > '$time' and status = 'pending')";

$result = $conn->query($sql);

if(!$result){
    echo "<div class='alert alert-danger'>An error occured connecting to the server, please try again later</div>";
    exit;
};

$count = $result->num_rows;

if($count !== 1){
    echo "<div class='alert alert-danger'>Please try again later 1 </div>";
    echo $user_id;
    echo $key;
    exit;
};


//errors
$missingpassword = "<p><strong>Please enter a password.</strong></p>";
$invalidpassword = "<p><strong>Password needs at least 6 characters, one capital letter and one number.</strong></p>";
$passwordmismatch = "<p><strong>Passwords do not match</strong></p>";
$missingpassword2 = "<p><strong>Please confirm password.</strong></p>";

if(empty($_POST['resetpassword'])){
    $errors .= $missingpassword;
}elseif(!(strlen($_POST['resetpassword'])>5 and preg_match('/[A-Z]/',$_POST['resetpassword']) and preg_match('/[0-9]/',$_POST['resetpassword']))){
    $errors .= $invalidpassword;
}else{
    $password = filter_var($_POST['resetpassword'], FILTER_SANITIZE_STRING);
    
}

if(empty($_POST['resetpassword2'])){
    $errors .= $missingpassword2;
}elseif($_POST['resetpassword2'] !== $_POST['resetpassword']){
    $errors .= $passwordmismatch;
}

if($errors){
    echo "<div class='alert alert-danger'>".$errors."</div>";
    exit;
}

$password = $conn->real_escape_string($password);
$password  = hash('sha256', $password);

$sql = "UPDATE users SET password='$password' WHERE id='$user_id' LIMIT 1";

$conn->query($sql);

if($conn->affected_rows !== 1){
    echo "<div class='alert alert-danger'>There was an error creating new password.</div>";
    exit;
};

    
$sql = "UPDATE forgotpassword SET status = 'used' WHERE (user_id = '$user_id' and resetkey = '$key' and time > '$time' and status = 'pending')";

$result = $conn->query($sql);

if(!$result){
    echo "<div class='alert alert-danger'>An error occured connecting to the server, please try again later</div>";
    exit;
};


echo "<div class='alert alert-success'>Your password has been updated. </div>";
echo "<a href='../index.php' type='button' class='btn btn-success'>Log in</a>";


?>