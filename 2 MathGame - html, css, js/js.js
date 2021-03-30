var playing = false;
var score = 0;
var correctanswer = 0;
var correctbox = 0;

document.getElementById("start").onclick = 
function() {
    if (playing == true) {
        location.reload();
    } else {
        playing = true;
        document.getElementById("start").innerHTML = "Reset Game";
        document.getElementById("scorevalue").innerHTML = score;
        document.getElementById("timer").style.display = "block";
        var counter = document.getElementById("time");
        var timeleft = 60;
        var timecounter = setInterval(function() {
            timeleft--; counter.innerHTML = timeleft;
             if (timeleft == 0) {
                 clearInterval(timecounter);
                 document.getElementById("scorevalue2").innerHTML = score;
                 document.getElementById("endgame").style.display = "block";
                 document.getElementById("timer").style.display = "none";
                 document.getElementById("correct").style.display = "none";
                 document.getElementById("wrong").style.display = "none";
             }}, 1000);
        genQA();
    }
}

document.getElementById("box1").onclick = 
    function(){
    if (playing == true){
        if(this.innerHTML == correctanswer){
            score += 1;
            document.getElementById("scorevalue").innerHTML = score;
            document.getElementById("wrong").style.display = "none";
            document.getElementById("correct").style.display = "block";
            setTimeout(function(){document.getElementById("correct").style.display = "none";},1000);
            genQA();
           } else {
               document.getElementById("correct").style.display = "none";
               document.getElementById("wrong").style.display = "block";
               setTimeout(function(){document.getElementById("wrong").style.display = "none";},1000)
           }
    }
}
document.getElementById("box2").onclick = 
    function(){
    if (playing == true){
        if(this.innerHTML == correctanswer){
            score += 1;
            document.getElementById("scorevalue").innerHTML = score;
            document.getElementById("wrong").style.display = "none";
            document.getElementById("correct").style.display = "block";
            setTimeout(function(){document.getElementById("correct").style.display = "none";},1000);
            genQA();            
           } else {
               document.getElementById("correct").style.display = "none";
               document.getElementById("wrong").style.display = "block";
               setTimeout(function(){document.getElementById("wrong").style.display = "none";},1000)
           }
    }
}
document.getElementById("box3").onclick = 
    function(){
    if (playing == true){
        if(this.innerHTML == correctanswer){
            score += 1;
            document.getElementById("scorevalue").innerHTML = score;
            document.getElementById("wrong").style.display = "none";
            document.getElementById("correct").style.display = "block";
            setTimeout(function(){document.getElementById("correct").style.display = "none";},1000) ;
            genQA();           
           } else {
               document.getElementById("correct").style.display = "none";
               document.getElementById("wrong").style.display = "block";
               setTimeout(function(){document.getElementById("wrong").style.display = "none";},1000)
           }
    }
}
document.getElementById("box4").onclick = 
    function(){
    if (playing == true){
        if(this.innerHTML == correctanswer){
            score += 1;
            document.getElementById("scorevalue").innerHTML = score;
            document.getElementById("wrong").style.display = "none";
            document.getElementById("correct").style.display = "block";
            setTimeout(function(){document.getElementById("correct").style.display = "none";},1000)  ;
            genQA();          
           } else {
               document.getElementById("correct").style.display = "none";
               document.getElementById("wrong").style.display = "block";
               setTimeout(function(){document.getElementById("wrong").style.display = "none";},1000)
           }
    }
}

var myArray = []

function genQA(){
    var x  = twonums()[0];
    var y  = twonums()[1];
    correctanswer = x*y;
    myArray.push(correctanswer)
    correctbox = Math.floor(Math.random()*4+1);
    document.getElementById("area").innerHTML = x+ " x " +y;
    for (i=1; i<5; i++) {
        if (i == correctbox) {
            document.getElementById("box"+i).innerHTML = correctanswer;
        } else {
            var a  = twonums()[0];
            var b  = twonums()[1];
            document.getElementById("box"+i).innerHTML = a*b;
        }
        
    }
}

function twonums(){
    var num1 = Math.floor(Math.random()*5);
    var num2 = Math.floor(Math.random()*12);
    return [num1, num2];
}