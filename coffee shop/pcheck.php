<?php

session_start();
$mysqli = new mysqli('localhost', 'root', '', 'mywebsite');

if($mysqli->connect_error){    
    die('Error: ('.$mysqli->connect_error.') '.$mysqli->connect_error);
}

$email = mysqli_real_escape_string($mysqli, $_POST["email"]);
$password = mysqli_real_escape_string($mysqli, $_POST["password"]);
     
     $query = "SELECT * FROM members WHERE email='$email'";
     $result = mysqli_query($mysqli, $query) or die(mysqli_error());
     $num_row = mysqli_num_rows($result);
     $row = mysqli_fetch_array($result);
     
     if($num_row >= 1){
         
         if (password_verify($password, $row['password'])){
             $_SESSION["login"] = $row['id'];
             $_SESSION["fname"] = $row['fname'];
             $_SESSION["lname"] = $row['lname'];
             
             echo 'true';
            } else {
                echo 'false';
            }
     } else {
         echo 'false';
     }

?>