<?php

session_start();

if(!isset($_SESSION['id'])){
    header("location: index.php");
};

//connection to sql
include "./php/connection.php";
$user_id = $_SESSION['id'];
$email = $_SESSION['email'];
$sql = "SELECT * FROM users WHERE id = $user_id";
$result = $conn->query($sql);
$count = $result->num_rows;
if($count == 1){
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $username = $row['username'];
    $email = $row['email'];
}else{
    echo "there was an error";
};

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">
    <title>My Notes</title>
    
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
            <li class="nav-item">
                <a class="nav-link" href="./profile.php">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">[PH]Help</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">[PH]Contact Us</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="./mainpageloggedin.php">My Notes</a>
            </li>
        </ul>
        <ul class="navbar-nav navbar-right">
           <li class="nav-item">
                <a class="nav-link" href="#" >Logged in as <b><?php echo $username; ?></b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./index.php?logout=1" >Log out</a>
            </li>
        </ul>
        

<!--        <button class="btn btn-secondary my-2 my-sm-0" type="submit">Login</button>-->

    </div>
</nav>


        <div class="container-fluid">
            
<!--            errors div-->
           <div id="alert" class="alert alert-danger collapse">
               <a class="close" data-dismiss="alert">&times;</a>
               <p id="alertcontent"></p>
           </div>
            
<!--            buttons section-->
            <div class="row mb-2">
                <div class="col-md-6 offset-md-3">
                   <div>
                       <button type="button" class="btn btn-primary float-left" id="addnote">
                       Add Note
                       </button>
                   </div>
                   <div>
                       <button type="button" class="btn btn-primary float-left d-none" id="allnotes">
                       All Notes
                       </button>
                   </div>
                   <div>
                       <button type="button" class="btn btn-primary float-right" id="edit">
                       Edit
                       </button>
                   </div>
                   <div>
                       <button type="button" class="btn btn-primary float-right d-none green" id="done">
                       Done
                       </button>
                   </div>
                </div>
            </div>
            
<!--            notes section-->
            <div class="row">
                <div class="col-md-6 offset-md-3 notes" id="notes">
                </div>
            </div>
            
<!--            notepad for new notes-->
            <div class="row">
                <div class="col-md-6 offset-md-3 d-none" id="notepad">
                    <textarea name="newnote" id="" rows="10"></textarea>
                </div>
            </div>
        </div>     

    
    
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
    <!--    ajax for managing notes-->
    <script src="./js/mynotes.js"></script>


</body>
</html>