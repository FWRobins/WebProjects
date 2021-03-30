<?php

if(isset($_SESSION['id']) and $_GET['logout']==1){
    session_destroy();
    setcookie('rememberme', "", time()-999, "/");
}

?>