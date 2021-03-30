<?php
session_start();

//connect to database
include "../php/connection.php";

//get id of note from ajax
$note_id = $_POST['note_id'];

//get new content of note from ajax
$notetext = $_POST['notetext'];


//get current time
$time = time();

//sql to update note
$sql = "UPDATE notes SET note = '$notetext', time = '$time' WHERE id = '$note_id'";
$result = $conn->query($sql);

if(!$result){
    echo 'error';
    exit;
};

?>