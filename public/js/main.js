$(function(){

    $('nav').hover(function() {
        $(this).stop().animate({
            'width': '150px'
        });
        $('.nav-links').css('display', 'block');
    }, function() {
        $(this).stop().animate({
            'width': '50px'
        });
        $('.nav-links').css('display', 'none');
    });

});