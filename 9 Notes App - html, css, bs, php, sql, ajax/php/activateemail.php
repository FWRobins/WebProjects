<?php

session_start();

//connect to database

include "./connection.php";



?>


<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="veiwport" content="width=device-width, initial-scale=1">
        <title>Activate New Email</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <style>
            h1{
                color:purple;
            }
            .contactform{
                border: 1px solid #7c73f6;
                margin-top: 50px;
                border-radius: 15px;
            }
        </style>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-10 offset-sm-1 contactform">
                    <h1>Activate New Email:</h1>
                    <?php
                    //check if key and email recieved
                    if(!isset($_GET['email']) or !isset($_GET['key']) or !isset($_GET['newemail'])){
                        echo "<div class='alert alert-danger'>There was an error, please click on activation link received by email.</div>";
                        exit;

                    };

                    //set and prep keys for sql
                    $email = $_GET['email'];
                    $newemail = $_GET['newemail'];
                    $key = $_GET['key'];

                    $email = $conn->real_escape_string($email);
                    $newemail = $conn->real_escape_string($newemail);
                    $key = $conn->real_escape_string($key);
                    $sql = "UPDATE users SET activation2 = 'activated', email = '$newemail' WHERE (email = '$email' AND activation2 = '$key') LIMIT 1";

                    $conn->query($sql);

                    if($conn->affected_rows == 1){
                        session_destroy();
                        setcookie("rememberme", "", time()-999, "/");
                        echo "<div class='alert alert-success'>Your email address has been updated</div>";
                        echo "<a href='../index.php' type='button' class='btn btn-success'>Log in</a>";

                    }else{


                        echo "<div class='alert alert-danger'>There was an error, please click on activation link received by email.</div>";
                        exit;

                    }
                    ?>
                </div>
                
            </div>
        </div>
        
        <script
          src="https://code.jquery.com/jquery-3.5.1.js"
          integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
          crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js">
        </script>
    </body>
</html>