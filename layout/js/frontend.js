$( document ).ready(function() {


    
    'use strict';

    // select box it pulign
    $('select').selectBoxIt();
    $("select").selectBoxIt({ autoWidth: false });
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

    

    // confirmation button when delete

    $('.confirm').click(function(){
        return confirm("Are you sure ?");
    });

    //-------------------------------------------
    $('.login-page h2 span').click(function(){
        $(this).addClass('selected').siblings().removeClass('selected');
        $('.login-page form').hide();
        $('.' +$(this).data('class')).fadeIn(500);
    })

    
});
