<?php

session_start();

//connect to database

include "./connection.php";

//error messages
$missingpassword = "<p><strong>Please enter your current password.</strong></p>";
$missingnewpassword = "<p><strong>Please enter a new password.</strong></p>";
$invalidpassword = "<p><strong>Password needs at least 6 characters, one capital letter and one number.</strong></p>";
$passwordmismatch = "<p><strong>New passwords do not match</strong></p>";
$missingpassword2 = "<p><strong>Please confirm password.</strong></p>";


//get userid
$user_id = $_SESSION['id'];

//get form data


if(empty($_POST['currentpassword'])){
    $errors .= $missingpassword;
}else{
    $currentpassword = $_POST['currentpassword'];
    $currentpassword = filter_var($currentpassword, FILTER_SANITIZE_STRING);
    $currentpassword = $conn->real_escape_string($currentpassword);
    $currentpassword = hash('sha256', $currentpassword);
};

if(empty($_POST['newpassword'])){
    $errors .= $missingnewpassword;
}elseif(!(strlen($_POST['newpassword'])>5 and preg_match('/[A-Z]/',$_POST['newpassword']) and preg_match('/[0-9]/',$_POST['newpassword']))){
    $errors .= $invalidpassword;
}else{
    $newpassword = $_POST['newpassword'];
};

if(empty($_POST['confirmpassword'])){
    $errors .= $missingpassword2;
}elseif($_POST['confirmpassword'] !== $_POST['confirmpassword']){
    $errors .= $passwordmismatch;
}else{
    $confirmpassword = $_POST['confirmpassword'];
    $newpassword = filter_var($newpassword, FILTER_SANITIZE_STRING);
    $newpassword = $conn->real_escape_string($newpassword);
    $newpassword = hash('sha256', $newpassword);
};

//return errors
if($errors){
    echo "<div class='alert alert-danger'>".$errors."</div>";
    exit;
}


//prep for sql

$sql = "SELECT * FROM users WHERE id = '$user_id' AND password = '$currentpassword'";
$result = $conn->query($sql);
$count = $result->num_rows;

if($count !== 1){
    echo "<div class='alert alert-danger'>An error occured matching your account</div>";
    exit;
};

$sql = "UPDATE users SET password = '$newpassword' WHERE id = '$user_id'";
$result = $conn->query($sql);

if(!$result){
    echo "<div class='alert alert-danger'>An error occured updating your password</div>";
}else{
    echo "<div class='alert alert-success'>Password updated</div>";
};



?>