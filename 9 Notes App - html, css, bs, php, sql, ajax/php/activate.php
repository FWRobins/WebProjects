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
        <title>Contact Form</title>
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
                    <h1>Contact Us:</h1>
                    <?php
                    //check if key and email recieved
                    if(!isset($_GET['email']) or !isset($_GET['key'])){
                        echo "<div class='alert alert-danger'>There was an error, please click on activation link received by email.</div>";
                        exit;

                    }

                    //set and prep keys for sql
                    $email = $_GET['email'];
                    $key = $_GET['key'];

                    $email = $conn->real_escape_string($email);
                    $key = $conn->real_escape_string($key);

                    $sql = "UPDATE users SET activation = 'activated' WHERE (email = '$email' and activation = '$key') LIMIT 1";

                    $conn->query($sql);

                    if($conn->affected_rows == 1){

                        echo "<div class='alert alert-success'>Your account has been activated</div>";
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