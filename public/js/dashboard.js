$(function() {

    var informations = $('.test-inside-informations');
    var testName = $('.test-name-inside');

    $('.test').hover(function() {
        informations.stop().slideDown(200);
        testName.css('border-top', '1px solid var(--def-red-border)');
    }, function() {
        informations.stop().css('border-top', 'none').slideUp(200);
        testName.css('border-top', 'none');
    });

});