<?php

session_start();
$mysqli = new mysqli('localhost', 'root', '', 'mywebsite');

if($mysqli->connect_error){    
    die('Error: ('.$mysqli->connect_error.') '.$mysqli->connect_error);
}

$fname = mysqli_real_escape_string($mysqli, $_POST["fname"]);
$lname = mysqli_real_escape_string($mysqli, $_POST["lname"]);
$email = mysqli_real_escape_string($mysqli, $_POST["email"]);
$password = mysqli_real_escape_string($mysqli, $_POST["password"]);

//validate and return to ajax
if(strlen($fname) < 2){
    echo 'fname';
} elseif (strlen($lname) < 2){
    echo 'lname';
} elseif (strlen($email) <= 4){
    echo 'eshort';
} elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false){
    echo 'eformat';
} elseif (strlen($password) < 2){
    echo 'pshort';
} else {
     $password = password_hash($password, PASSWORD_BCRYPT, array('cost'=>12));
     
     $query = "SELECT * FROM members WHERE email='$email'";
     $result = mysqli_query($mysqli, $query) or die(mysqli_error());
     $num_row = mysqli_num_rows($result);
     $row = mysqli_fetch_array($result);
     
     if($num_row < 1){
         $insert_row = $mysqli->query("INSERT INTO members (fname, lname, email, password) VALUES ('$fname', '$lname', '$email', '$password')");
         
         if ($insert_row){
             $_SESSION["login"] = $mysqli->insert_id;
             $_SESSION["fname"] = $fname;
             $_SESSION["lname"] = $lname;
             
             echo 'true';
            }
     } else {
         echo 'false';
     }
 }
?>