<?php

$conn = new mysqli("localhost", "notes_user", "pw@notes_user", "onlinenotes");

if($conn->connect_error){
    die("error conecting to database: ".$conn->connect_error);
}

?>
