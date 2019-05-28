$(function(){

    // Animacja bocznej nawigacji
    $('nav').hover(function() {
        $(this).stop().animate({
            'width': '280px'
        }, function() {
            $('.nav-links').css('display', 'block');
        });
    }, function() {
        $(this).stop().animate({
            'width': '50px'
        });
        $('.nav-links').css('display', 'none');
    });

    // Dodawanie nowej kategorii
    let categoryInput = $('.new-category-input');
    $('.add-new-category').click(function(){
        if ($('.new-category').length > 0) {
            $('.new-category').remove();
        } else {
            $(this).after('' +
                '<div class="new-category">' +
                    '<input type="text" class="new-category-input">' +
                    '<span class="confirm-new-category"><i class="fas fa-check-circle"></i></span>' +
                    '<span class="decline-new-category"><i class="fas fa-times-circle"></i></span>' +
                '</div>' +
            '');
            // anulowanie dodawania nowej kategorii, usuwanie inputu
            $('.decline-new-category').click(function() {
                $('.new-category').remove();
            })
        }
    });

    // Potwierdzenie dodania nowej kategorii
    $('body').on('click', '.confirm-new-category', function() {
        let categoryName = $(this).prev().val();
        // console.log(categoryName);
        $.ajax({
            url: '/ajaxAction/new-category',
            dataType: 'json',
            method: 'POST',
            data: {categoryName: categoryName},
            async: true,
            success: function(data) {
                console.log(data);
                if (data === 'success') {
                    $('.your-categories-container').prepend('' +
                        '<div class="category">'+categoryName+'</div>' +
                    '');
                }
            }
        });
    });

});