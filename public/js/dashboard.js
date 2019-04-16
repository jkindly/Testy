$(function() {

    $('.test').hover(function() {
        $(this).css('max-height', '150px').children('.test-inside-informations').stop().slideDown(200);
        $(this).children('.test-name-inside').css('border-top', '1px solid var(--def-red-border)');
        // $(this).css('max-height', '150px');
        $('.test').not(this).css('max-height', '50px');
    }, function() {
        $(this).children('.test-inside-informations').stop().css('border-top', 'none').slideUp(200);
        $(this).children('.test-name-inside').css('border-top', 'none');
    });

});