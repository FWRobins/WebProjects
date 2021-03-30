<?php

//if user not logged in and cookie exists
if(!isset($_SESSION['id']) and !empty($_COOKIE['rememberme'])){
//    cookie value = $code3 = $code1.",".bin2hex($code2)
    
//    extract from cookie
    list($authenticator1, $authenticator2) = explode(',', $_COOKIE['rememberme']);
    $authenticator2 = hex2bin($authenticator2);
    $f2authenticator2 = hash('sha256', $authenticator2);
    
//    FIND MATCH IN DATABASE
    $sql = "SELECT * FROM rememberme WHERE (authenticator1 = '$authenticator1')";
    
    $result = $conn->query($sql);
    $count = $result->num_rows;
    
    if(!$result){
        echo "<div class='alert alert-danger'>There was an error connecting to the server</div>";
        exit;
    }
    if($count !== 1){
        echo "<div class='alert alert-danger'>Remember me process failed</div>";
        exit;
    };
    
    $row = $result->fetch_array(MYSQLI_ASSOC);
        
    if(!hash_equals($f2authenticator2, $row['f2authenticator2'])){
        echo "<div class='alert alert-danger'>hash_equals retun false</div>";
    }else{
//        create new cookie
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
        };
        
//        log user in and redirect to loggedinpage
        $_SESSION['id'] = $row['user_id'];
        header("location:./mainpageloggedin.php");
        
    };
        
};

?>