$(function() {

    $('.test').hover(function() {
        $(this).css('max-height', '150px').children('.test-inside-informations').stop().slideDown(150);
        $(this).children('.test-name-inside').css('border-top', '1px solid var(--def-red-border)');
        // $(this).css('max-height', '150px');
        $('.test').animate(function() {
            $('.test').not(this).css('max-height', '50px');
        }, 150);
    }, function() {
        $(this).children('.test-inside-informations').stop().css('border-top', 'none').slideUp(150);
        $(this).children('.test-name-inside').css('border-top', 'none');
        $('.test').animate(function() {
            $(this).css('max-height', '50px');
        }, 150);
    });

});