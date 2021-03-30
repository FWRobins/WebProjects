<?php

session_start();

//connection to sql
include "./php/connection.php";

//logout
include "./php/logout.php";

//check remember me cookie and login
include "./php/rememberme.php"

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">
    <title>My Notes App</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Arvo&display=swap" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Place your stylesheet here-->
    <link href="./css/stylesheet.css" rel="stylesheet" type="text/css">
</head>

<body>

<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top navbar-custom">
    <a class="navbar-brand" href="#">Online Notes</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsColapse" >
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsColapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">[PH]Help</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">[PH]Contact Us</a>
            </li>
        </ul>
        <ul class="navbar-nav navbar-right">
            <li class="nav-item">
                <a class="nav-link" href="#loginmodal" data-toggle="modal">Login</a>
            </li>
        </ul>
        

<!--        <button class="btn btn-secondary my-2 my-sm-0" type="submit">Login</button>-->

    </div>
</nav>

    <main role="main" class="container">

        <div class="text-center jumbotron" id="mycontainer">
            <h1>Online Notes App</h1>
            <p class="lead">Your notes with you wherever you go.<br> Easy to use, protects all your notes.</p>
        <button class="btn btn-lg green signup" type="button" data-target="#signupmodal" data-toggle="modal">Sign up - It's free</button>
        </div>     

<!-- Signup modal -->
    <?php include "./modals/signupmodal.html"; ?>
        
<!--login modal-->
     <?php include "./modals/loginmodal.html"; ?>

<!--forgotpassword modal-->
     <?php include "./modals/forgotpasswordmodal.html"; ?>
        
        
    </main><!-- /.container -->
    
    
    <div class="footer fixed-bottom text-center">
        <div class="container">
            <p>Developed by FWRTech &copy; <?php $today = date("Y"); echo $today ?>.</p>
        </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
<!--    js file with our ajax scripts-->
    <script src="js/index.js"></script>

</body>
</html>