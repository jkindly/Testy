$(function(){

    // Animacja bocznej nawigacji
    $('nav').hover(function() {
        $(this).stop().animate({
            'width': '200px'
        }, function() {
            $('.nav-links').css('display', 'block');
        });
    }, function() {
        $(this).stop().animate({
            'width': '50px'
        });
        $('.nav-links').css('display', 'none');
    });
});