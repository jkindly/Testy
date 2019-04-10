$(function(){
    // Funkcja zamieniająca formularz w obiekt
    $.fn.serializeObject = function()
    {
        let o = {};
        let a = this.serializeArray();
        $.each(a, function() {
            if (o[this.name] !== undefined) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    };

    // Tworzenie nowego Testu (ajax)
    $('.create-new-test').on('click', '.new-test-btn', function(e) {
        e.preventDefault();
        let form = $('#new-test-form');
        let content = $('.create-new-test');
        let formData = $(this).parent().serializeObject();
        let loading = '<div class="loading"><img src="../img/loading.gif" alt="Ładowanie"></div>';
        $.ajax({
           url: '/ajaxAction/new/test',
            dataType: 'json',
            method: 'POST',
            data: formData,
            async: true,
            cache: false,
            beforeSend: function() {
               form.html(loading);
               // loading.show();
            },
            success: function(data) {
               if (data['status'] === 'form_valid') content.addClass('test-editing');
               content.html(data['content']);
               console.log(data);
            },
            error: function() {
               form.html('Wystąpił błąd, spróbuj ponownie');
               console.log(data);

            },
            complete: function() {

            }
        });
    });

    // let addNewQuestion = $('<div class="add-next-question"><i class="fas fa-plus"></i>Dodaj kolejne pytanie</div>');

    $('.add-next-question').on('click', function() {
        var prototype = $('.test-questions').data('prototype');
        $(this).before(prototype);
    });


    $('#questions-form').on('click', '#add-new-test-btn', function(e) {
        e.preventDefault();
        let formData = $('.input-test-answer').val();
        console.log(formData);
        $.ajax({
            url: '/ajaxAction/add/questions',
            dataType: 'json',
            method: 'POST',
            data: formData,
            async: true,
            cache: false,
            success: function(data) {
                console.log(data)
            }
        });
    });

});