$(function() {

    var informations = $('.test-inside-informations');
    var testName = $('.test-name-inside');

    $('.test').hover(function() {
        $(this).find('.test-inside-informations').stop().slideDown(200);
        $(this).children('.test-name-inside').css('border-top', '1px solid var(--def-red-border)');
        $('.test').not(this).css('max-height', '50px');
        // informations.stop().slideDown(200);
        // testName.css('border-top', '1px solid var(--def-red-border)');
    }, function() {
        informations.stop().css('border-top', 'none').slideUp(200);
        testName.css('border-top', 'none');
        $('.test').not(this).css('max-height', '150px');
    });

});