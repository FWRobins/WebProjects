<?php

session_start();

//connection to sql
include "./php/connection.php";

                $newpassword = "Overlord1!";
                $newpassword = filter_var($newpassword, FILTER_SANITIZE_STRING);
                $newpassword = $conn->real_escape_string($newpassword);
                $newpassword = hash('sha256', $newpassword);
                echo $newpassword;

?>