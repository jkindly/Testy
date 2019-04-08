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
        let content = $('.create-new-test');
        let form = $(this).parent().serializeObject();
        let loading = $('.loading');
        $.ajax({
           url: '/ajaxAction/new/test',
            dataType: 'json',
            method: 'POST',
            data: form,
            async: true,
            cache: false,
            beforeSend: function() {
               content.html('');
               loading.show();
            },
            success: function(data) {
               content.html(data);
               console.log(data);
            },
            error: function(data) {
               console.log(data);
            }
        });
    });

});