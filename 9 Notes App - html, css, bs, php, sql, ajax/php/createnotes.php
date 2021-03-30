<?php
session_start();

//connect to database
include "../php/connection.php";

//get user id
$user_id = $_SESSION['id'];

//get current time
$time = time();

//sql to create new note or return error
$sql = "INSERT INTO notes (user_id, note, time) VALUES ('$user_id', '', '$time')";
$result = $conn->query($sql);

if(!$result){
    echo 'error';
    exit;
};

//return id of last sql call
echo $conn->insert_id;

?>