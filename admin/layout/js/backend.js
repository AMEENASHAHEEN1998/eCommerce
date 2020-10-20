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

    $('.show-pass').hover(function(){
        $('.password').attr("type" , "text");
    },function(){
        $('.password').attr("type" , "password");
    });

    // confirmation button when delete

    $('.confirm').click(function(){
        return confirm("Are you sure ?");
    });

    $('.cat h3').click(function(){
        $(this).next('.full_view').fadeToggle(500);
    });

    $('.option span').click(function(){
        $(this).addClass('active').siblimgs('span').removeClass('active');
        if($(this).data('view') == 'full'){
            $('.cat .full_view').fadeIn(200);
        }else{
            $('.cat .full_view').fadeOut(200);
        }
    });
});
