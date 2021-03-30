$(function(){
//  define vars
    var activeNote = 0;
    var editmode = false;
    
//    ajax call to load all notes
    $.ajax({
        url: "./php/loadnotes.php",
        success: function(data){
            $("#notes").html(data);
            clickonnote();
        },
        error: function(){
            $('#alertcontent').html('There was an error with the ajax call');
            $('#alert').fadeIn();
        }
    });
    
//    ajax to create note
    $('#addnote').click(function(){
        
        $.ajax({
            url: "./php/createnotes.php",
            success: function(data){
                if(data == 'error'){
                   $('#alertcontent').html('There was an issue inserting new note into database');
                    $('#alert').fadeIn();
                   }else{
                       activeNote = data;
                       $('textarea').attr('id', activeNote);
                       $('textarea').val('');
                       
//                       show/hide buttons
                       showHide(['#allnotes', '#notepad'], ['#addnote', '#edit', '#notes']);
                       
                       $('textarea').focus();
                   };
            },
            error: function(){
                $('#alertcontent').html('There was an error with the ajax call');
                $('#alert').fadeIn();
            }
        });
        
    });
    
//    click allnotes button and load main page
    $('#allnotes').click(function(){
        $.ajax({
            url: "./php/loadnotes.php",
            success: function(data){
                $("#notes").html(data);
                showHide(['#addnote', '#edit', '#notes'],['#allnotes', '#notepad']);
                clickonnote();
            },
            error: function(){
                $('#alertcontent').html('There was an error with the ajax call');
                $('#alert').fadeIn();
            }
        });
        
    });
    
//    update new note data
        $('textarea').keyup(function(){
            datatopost = {notetext: $('textarea').val(), note_id: activeNote};
            $.ajax({
                url: "./php/updatenotes.php",
                type: "POST",
                data: datatopost,
                success: function(data){
                    if(data == 'error'){
                       $('#alertcontent').html('There was an issue inserting new note into database');
                        $('#alert').fadeIn();
                       }
                },
                error: function(){
                    $('#alertcontent').html('There was an error with the ajax call');
                    $('#alert').fadeIn();
                }
            });

        });
    
//    go to edit / delete notes layout
    $('#edit').click(function(){
        editmode = true;
//        reduce width of notes
        $('.noteheader').addClass("col-7 col-sm-9");
        showHide(['#done', '.delete'], ['#edit']);
        clickonnote();
        clickondelete();
    });
    
    
//    done deleting notes, revert to main screen
    $('#done').click(function(){
        editmode = false;
//        reduce width of notes
        $('.noteheader').removeClass("col-7 col-sm-9");
        showHide(['#edit'], ['#done', '.delete']);
    });


    
//    functions section
    function clickondelete(){
        $(".delete").click(function(){
            var deletebutton = $(this);
            $.ajax({
                url: "./php/deletenotes.php",
                type: "POST",
                data: {deleteid: deletebutton.next().attr('id')},
                success: function(data){
                    if(data == 'error'){
                       $('#alertcontent').html('There was an issue deleting note from database');
                        $('#alert').fadeIn();
                       }else{
                           deletebutton.parent().remove();
                       };
                },
                error: function(){
                    $('#alertcontent').html('There was an error with the ajax call');
                    $('#alert').fadeIn();
                }
            });
        })
    };
    
    function clickonnote(){
        $(".noteheader").click(function(){
            if(!editmode){
                activeNote = $(this).attr('id');
                $('textarea').attr('id', activeNote);
                $("textarea").val($.trim($(this).find('.text').text()));
                showHide(['#allnotes', '#notepad'], ['#addnote', '#edit', '#notes']);
                $('textarea').focus();
            }else{
                activeNote = $(this).attr('id');
                $('textarea').attr('id', activeNote);
                $("textarea").val($.trim($(this).find('.text').text()));
                showHide(['#allnotes', '#notepad'], ['#addnote', '#done', '#notes', '.delete']);
                $('textarea').focus();
            };
        });
    };
    
    
    function showHide(arr1, arr2){
        for(i=0; i<arr1.length; i++){
            $(arr1[i]).removeClass('d-none');
        };
        for(i=0; i<arr2.length; i++){
            $(arr2[i]).addClass('d-none');
        };
    };
  
});