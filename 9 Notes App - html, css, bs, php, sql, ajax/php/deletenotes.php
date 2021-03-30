<?php
session_start();

//connect to database

include "../php/connection.php";

//get id of note from ajax
$deleteid = $_POST['deleteid'];

//sql to delete note or return error
$sql = "DELETE FROM notes WHERE id = '$deleteid'";
$result = $conn->query($sql);

if(!$result){
    echo "error";
    exit;
};

?>