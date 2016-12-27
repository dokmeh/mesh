$(document).ready(function(){
    $('.pbox').arrangeable();
    $("#porderform").submit(function(){
        $("form input:submit").prop("disabled", true);
        var formData = new FormData(this);
        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            dataType: 'text',
            beforeSend: function ()
            {
                $('body').append('<div class="loader"></div>');
            },
            success: function (data)
            {
                $("form input:submit").prop("disabled", false);
                $('.loader').remove();
                alert(data);
            }
        });
        return false;
    });
});