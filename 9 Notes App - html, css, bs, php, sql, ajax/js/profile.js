$(function(){
//ajax to update username
//ajax for sign up
$('#updateusernameform').submit(function(event){
//    prevent defaul php of 'action' atribute
    event.preventDefault();
//    collect inputs
    var datatopost = $(this).serializeArray();
//    send data to signup.php
    $.ajax({
        url:"./php/updateusername.php",
        type:"POST",
        data:datatopost,
        success:function(data){
            if(data){
                $("#updateusernamemessage").html("<div class='alert alert-danger'>There was an erro updating your username.</div>");
            }else{
                location.reload();
            };           
        },
        error:function(){
            $("#updateusernamemessage").html("<div class='alert alert-danger'>There was an erro with the AJAX call. Please try again later.</div>");
        }
        
    });
    
});
    
//ajax to update password
$('#updatepasswordform').submit(function(event){
//    prevent defaul php of 'action' atribute
    event.preventDefault();    
//    collect inputs
    var datatopost = $(this).serializeArray();
//    send data to signup.php
    $.ajax({
        url:"./php/updatepassword.php",
        type:"POST",
        data:datatopost,
        success:function(data){
            if(data){
                $("#updatepasswordmessage").html(data);
            }else{
                $("#updatepasswordmessage").html("<div class='alert alert-danger'>There was an erro updating your password.</div>");
            };           
        },
        error:function(){
            $("#updatepasswordmessage").html("<div class='alert alert-danger'>There was an erro with the AJAX call. Please try again later.</div>");
        }
        
    });
    
})

//ajax to update email
$('#updateemailform').submit(function(event){
//    prevent defaul php of 'action' atribute
    event.preventDefault();    
//    collect inputs
    var datatopost = $(this).serializeArray();
//    send data to signup.php
    $.ajax({
        url:"./php/updateemail.php",
        type:"POST",
        data:datatopost,
        success:function(data){
            if(data){
                $("#updateemailmessage").html(data);
            }else{
                $("#updateemailmessage").html("<div class='alert alert-danger'>There was an erro updating email.</div>");
            };           
        },
        error:function(){
            $("#updateemailmessage").html("<div class='alert alert-danger'>There was an erro with the AJAX call. Please try again later.</div>");
        }
        
    });
    
})
    
});

