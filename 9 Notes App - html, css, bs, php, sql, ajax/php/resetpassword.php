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
        <title>Password Reset</title>
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
                    <h1>Enter New Password:</h1>
                    <?php
                    //check if key and email recieved
                    if(!isset($_GET['user_id']) or !isset($_GET['key'])){
                        echo "<div class='alert alert-danger'>There was an error, please click on activation link received by email.</div>";
                        exit;
                    }

                    //set and prep keys for sql
                    $user_id = $_GET['user_id'];
                    $key = $_GET['key'];
                    $time = time()-24*60*60;

                    $user_id = $conn->real_escape_string($user_id);
                    $key = $conn->real_escape_string($key);
                    
                    $sql = "SELECT * FROM forgotpassword WHERE (user_id = '$user_id' and resetkey = '$key' and time > '$time' and status = 'pending')";

                    $result = $conn->query($sql);
                    
                    if(!$result){
                        echo "<div class='alert alert-danger'>An error occured connecting to the server, please try again later</div>";
                        exit;
                    };
                    
                    $count = $result->num_rows;
                    
                    if($count !== 1){
                        echo "<div class='alert alert-danger'>Please try again later</div>";
                        exit;
                    };
                    
                    echo "<form action='' method='post' id='resetpasswordform'>
                        <div class='form-group'>
                           <div id='resetpasswordmessage'></div>
                           
                           <input type='hidden' name='key' value=$key>
                            <input type='hidden' name='user_id' value=$user_id>

                            <label for='resetpassword'>
                              Enter your new password:
                            </label>
                            <input type='password' name='resetpassword' id='resetpassword' class='form-control' maxlength='30'>

                            <label for='resetpassword2'>
                              Re-enter Password:
                            </label>
                            <input type='password' name='resetpassword2' id='resetpassword2' class='form-control' maxlength='30'>
                        </div>
                            <input type='submit' name='resetpw' class='btn btn-success mb-2' value='Reset Password'>
                          
                    </form>"
                    
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
        <script>
//        ajax call to store_reset_password.php for from data
            $('#resetpasswordform').submit(function(event){
            //    prevent defaul php of 'action' atribute
                event.preventDefault();
            //    collect inputs
                var datatopost = $(this).serializeArray();
            //    send data to signup.php
                $.ajax({
                    url:"./store_reset_password.php",
                    type:"POST",
                    data:datatopost,
                    success:function(data){
                        if(data){
                            $("#resetpasswordmessage").html(data);
                        };           
                    },
                    error:function(){
                        $("#resetpasswordmessage").html("<div class='alert alert-danger'>There was an erro with the AJAX call. Please try again later.</div>");
                    }

                });

            })
        </script>
    </body>
</html>