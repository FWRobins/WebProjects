<?php

session_start();

//connect to database

include "../php/connection.php";

//error messages
$missingemail = "<p><strong>Please enter a email address</strong></p>";
$invalidemail = "<p><strong>Please enter a valid email address</strong></p>";
$missingpassword = "<p><strong>Please enter a password</strong></p>";


//check data
if(empty($_POST['loginemail'])){
    $errors .= $missingemail;
}elseif(!filter_var($_POST['loginemail'], FILTER_VALIDATE_EMAIL)){
    $errors .= $invalidemail;
}else{
    $email = filter_var($_POST['loginemail'], FILTER_SANITIZE_EMAIL);
}

if(empty($_POST['loginpassword'])){
    $errors .= $missingpassword;
}else{
    $password = filter_var($_POST['loginpassword'], FILTER_SANITIZE_STRING);
}

//return errors
if($errors){
    echo "<div class='alert alert-danger'>".$errors."</div>";
    exit;
}


//prep variables for sql
$email = $conn->real_escape_string($email);
$password = $conn->real_escape_string($password);
$password  = hash('sha256', $password);

//query sql and check results
$sql = "SELECT * FROM users WHERE (email = '$email' AND password = '$password' AND activation = 'activated')";

$result = $conn->query($sql);

if(!$result){
    echo "<div class='alert alert-danger'>An error occured connecting to the server, please try again later</div>";
    echo "<div class='alert alert-danger'>".$conn->error."</div>";
    exit;
}

if($result->num_rows !== 1){
    echo "<div class='alert alert-danger'>Email and password not found</div>";
    exit;
}else{
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $_SESSION['id'] = $row['id']; 
    $_SESSION['username'] = $row['username']; 
    $_SESSION['email'] = $row['email']; 
    
    
//    remeber me checkbox handeling
//    no check = return and log in
    if(empty($_POST['rememberme'])){
        echo "success";
    }else{
//        rememer me checked
//        prep all variables
//        different bytes for more complication
        $authenticator1 = bin2hex(openssl_random_pseudo_bytes(10));
        $authenticator2 = openssl_random_pseudo_bytes(20);
        $user_id = $_SESSION['id'];

        function f1($code1, $code2){
            $code3 = $code1.",".bin2hex($code2);
            return $code3;
        };
        
        function f2($code){
            $code = hash('sha256', $code);
            return $code;
        };
        
        $cookieValue = f1($authenticator1, $authenticator2);
        $f2authenticator2 = f2($authenticator2);
        $cookieexpiration = time()+15*24*60*60;
        $sqlexpiration = date('Y-m-d H:i:s', $cookieexpiration);
        
//        store in coockie (name, value, expiration)        
        setcookie('rememberme', $cookieValue, $cookieexpiration, "/");
        
        
//        store data en sql
        $sql = "INSERT INTO rememberme (authenticator1, f2authenticator2, user_id, expires) VALUES ('$authenticator1', '$f2authenticator2', '$user_id', '$sqlexpiration')";
        
        $result = $conn->query($sql);
        
        if(!$result){
            echo "<div class='alert alert-danger'>There was an error storing data to remeber you next time</div>";
        }else{
            echo "success";
        };
        
        
    };

}


?>