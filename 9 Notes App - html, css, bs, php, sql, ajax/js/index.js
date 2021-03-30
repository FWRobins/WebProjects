//easy print to console
const print = function(text){
    console.log(text);
}


//ajax for sign up
$('#signupform').submit(function(event){
//    prevent defaul php of 'action' atribute
    event.preventDefault();
//    collect inputs
    var datatopost = $(this).serializeArray();
//    send data to signup.php
    $.ajax({
        url:"./php/signup.php",
        type:"POST",
        data:datatopost,
        success:function(data){
            if(data){
                $("#signupmessage").html(data);
            };           
        },
        error:function(){
            $("#signupmessage").html("<div class='alert alert-danger'>There was an erro with the AJAX call. Please try again later.</div>");
        }
        
    });
    
})

//ajax for login
$('#loginform').submit(function(event){
//    prevent defaul php of 'action' atribute
    event.preventDefault();
//    collect inputs
    var datatopost = $(this).serializeArray();
//    send data to signup.php
    $.ajax({
        url:"./php/login.php",
        type:"POST",
        data:datatopost,
        success:function(data){
            if(data){
                if(data == "success"){
                        window.location = "./mainpageloggedin.php";
                   }else{
                       $("#loginmessage").html(data);
                   };
            };           
        },
        error:function(){
            $("#loginmessage").html("<div class='alert alert-danger'>There was an erro with the AJAX call. Please try again later.</div>");
        }
        
    });
    
})


//ajax for forgot password
$('#forgotpasswordform').submit(function(event){
//    prevent defaul php of 'action' atribute
    event.preventDefault();
//    collect inputs
    var datatopost = $(this).serializeArray();
//    send data to signup.php
    $.ajax({
        url:"./php/forgot_password.php",
        type:"POST",
        data:datatopost,
        success:function(data){
            if(data){
                $("#forgotpasswordmessage").html(data);
            };           
        },
        error:function(){
            $("#loginmessage").html("<div class='alert alert-danger'>There was an erro with the AJAX call. Please try again later.</div>");
        }
        
    });
    
})