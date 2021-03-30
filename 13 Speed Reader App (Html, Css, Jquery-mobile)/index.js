$(function(){
    
//    variables
    var wordsarray;
    var wordsarraylength;
    var reading = false;
    var counter = 0;
    var action; //store result of set_interval
    var frequency = 200;
    
//    hide elements on page load
    $("#new").hide();
    $("#resume").hide();
    $("#pause").hide();
    $(".ui-grid-a").hide(); //sliders
    $("#result").hide(); //reading box
    $("#error").hide();
    
//    start reading
    $("#start").click(function(){
////    initial setup
//        get text and convert to array
        // \s matches spaces, new lines ect
        // + matches with repeated elements
        wordsarray = $("#userinput").val().split(/\s+/);
        wordsarraylength = wordsarray.length;
        if(wordsarraylength > 1){
            reading = true;
            $("#start").hide();
            $("#error").hide();
            $("#userinput").hide();
            $("#new").show();
            $("#pause").show();
            $(".ui-grid-a").show(); //sliders
            $("#result").show(); //reading box
//            set progress slider max
            $("#progressslider").attr('max', wordsarraylength-1);
            $("#result").html(wordsarray[counter]);
            
//            start loop
            action = setInterval(read, frequency);
            
        }else{
            $("#error").show();
        };
    });
    
//    new
//    reload page
    $('#new').click(function(){
                    location.reload();
                    });
    
//    pause
    $('#pause').click(function(){
        $("#resume").show();
        $("#pause").hide();
        reading = false;
        clearInterval(action);
    });
    
//    resume
    $('#resume').click(function(){
        $("#resume").hide();
        $("#pause").show();
        reading = true;
        action = setInterval(read, frequency);
    });    
    
//    change font size
    $('#fontsizeslider').on("slidestop", function(event, ui){
        $('#fontsizeslider').slider('refresh');
        var fontslidervalue = $('#fontsizeslider').val()
        $('#fontsize').html(fontslidervalueslidervalue);
        $('#result').css('fontSize', fontslidervalue+'px');
    });
    
//    change speed
    $('#wpmslider').on("slidestop", function(event, ui){
       $("#wpmslider").slider('refresh');
        var speedslidervalue = $("#wpmslider").val();
        $("#wpm").html(speedslidervalue);
        frequency = Math.floor(60000/speedslidervalue);
        clearInterval(action);
        action = setInterval(read, frequency);
    });
    
//    progress slider
    $("#progressslider").on("slidestop", function(event, ui){
        $("#progressslider").slider("refresh");
        var progressvalue = $("#progressslider").val();
        counter = progressvalue;
        $("#result").html(wordsarray[counter]);
        clearInterval(action);
        $("#resume").show();
        $("#pause").hide();
    });
    
//    functions
    function read(){
        if(counter == wordsarraylength-1){
            clearInterval(action);
            reading = false;
            $("#resume").hide();
            $("#pause").hide();
           }else{
               counter ++;
               $("#result").html(wordsarray[counter]);
//               change slider value and refresh slider
               $("#progressslider").val(counter);
               $("#progressslider").slider('refresh');
               $('#progress').html(Math.round(counter/(wordsarraylength-1)*100));
           };
    };
});