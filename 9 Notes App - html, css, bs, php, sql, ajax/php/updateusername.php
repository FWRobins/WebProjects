<?php

session_start();

//connect to database

include "./connection.php";

//get userid
$user_id = $_SESSION['id'];

//get new user name
$newusername = $_POST['newusername'];

$sql = "UPDATE users SET username = '$newusername' WHERE id = '$user_id'";
$result = $conn->query($sql);

if(!$result){
    echo "error";
    exit;
};

?>