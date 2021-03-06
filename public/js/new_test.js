$(function(){

    var createNewTest = $('.create-new-test');
    var content = $('.create-new-test');
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
    createNewTest.on('click', '#new-test-btn', function(e) {
        e.preventDefault();
        let form = $('#new-test-form');
        let formData = $(this).parent().serializeObject();
        let loading = '<div class="loading"><img src="../img/loading.gif" alt="Ładowanie"></div>';
        $.ajax({
           url: '/ajaxAction/test/new',
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
               console.log(data['status']);
               if (data['status'] === 'form_valid') content.addClass('test-editing');
               content.html(data['content']).slideDown(300);
            },
            error: function() {
               form.html('Wystąpił błąd, spróbuj ponownie');
               console.log(data);

            },
            complete: function() {

            }
        });
    });

    var questionCount;

    createNewTest.on('click', '.add-next-question', function() {
        // $collectionHolder.data('index', $('.question-edit-mode').length);
        // console.log($collectionHolder.data('index'));
        questionCount = $('.question-edit-mode').length;
        addQuestionForm();
    });

    createNewTest.on('click', '.remove-question', function() {
        $(this).parent().remove();
        questionCount -= 1;
    });

    function addQuestionForm() {
        // let prototype = $('.test-questions').data('prototype');
        // let index = $collectionHolder.data('index');
        let newForm = $('.test-questions').data('prototype');
        // console.log('Index ' + questionCount);
        // let newForm = prototype;

        newForm = newForm.replace(/__name__/g, questionCount);

        // $collectionHolder.data('index', index + 1);
        questionCount += 1;
        $('.add-next-question').before(newForm);
    }

    createNewTest.on('click', '#add-new-test-btn', function(e) {
        e.preventDefault();
        let formData = $(this).parent().serializeObject();
        console.log(formData);

        $.ajax({
            url: '/ajaxAction/insert/new-test',
            dataType: 'json',
            method: 'POST',
            data: formData,
            async: true,
            cache: false,
            success: function(data) {
                console.log(data);
                if (data === 'form_valid') {
                    content.html('Pomyślnie utworzono, nastąpi przekierowanie');
                    window.setTimeout(function(){
                        window.location.href = "http://localhost:8000";
                    }, 2000);
                } else {
                    $('.name-error').html('Wprowadź nazwę');
                }
            }
        });
    });

});