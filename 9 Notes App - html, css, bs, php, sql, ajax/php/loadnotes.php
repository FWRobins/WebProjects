<?php
session_start();

//connect to database

include "../php/connection.php";

//get user id
$user_id = $_SESSION['id'];

//sql to delete empty notes
$sql = "DELETE FROM notes WHERE note = ''";
$result = $conn->query($sql);

if(!$result){
    echo "<div class='alert alert-warning'>An error occured</div>";
    exit;
};

//sql call user_id notes
$sql = "SELECT * FROM notes WHERE user_id = '$user_id' ORDER BY time DESC";
$result = $conn->query($sql);

if(!$result){
    echo "<div class='alert alert-warning'>An error occured getting notes</div>";
    exit;
};

$count = $result->num_rows;

if($count == 0){
    echo "
    <div class='noteheader'>
            <div class='text'>
                You have not created any notes yet.
            </div>";
    exit;
};

$rowcount = 0;
while($rowcount < $count){
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $rowtime = date("d M, Y H:i:s A", $row['time']);
    echo "
    <div class='note row'>
    <div class='col-5 col-sm-3 delete d-none py-1'>
    <button class='btn-lg btn-danger w-100 text-center '>Delete</button>
    </div>
    <div class='noteheader w-100' id=".$row['id'].">
            <div class='text'>
                ".$row['note']."
            </div>
            <div class='timetext'>
                ".$rowtime."
            </div>        
        </div></div>";
    $rowcount ++;
};

//show notes or error



?>