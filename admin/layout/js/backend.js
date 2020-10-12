$( document ).ready(function() {

    'use strict';

    // hidden placeholder in login form
    $('[placeholder]').focus(function(){
        $(this).attr("data-text" , $(this).attr("placeholder"));
        $(this).attr("placeholder" , "");

    }).blur(function(){
        $(this).attr("placeholder" , $(this).attr("data-text"));

    });
    
    $('input').each(function(){
        if($(this).attr('required') === 'required'){
            $(this).after("<span class = 'asterisk'>*</span>");
        }
    });

    $('.show-pass').hover(function(){
        $('.password').attr("type" , "text");
    },function(){
        $('.password').attr("type" , "password");
    });

    // confirmation button when delete

    $('.confirm').click(function(){
        return confirm("Are you sure ?");
    });

});
