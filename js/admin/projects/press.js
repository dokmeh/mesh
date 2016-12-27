var pr;
$(document).ready(function(){
    pr = $('#ppressform .press-box').length;
    $('#ppressform .press-box .input-box:nth-of-type(2) .del_press').click(function(){
        $(this).parents('.press-box').remove();
    });
    $('#pawardsform .press-box').arrangeable();
    $('#add_press').click(function(){
        $('.press-boxes').append($('.new-press').html());
        pr++;
        $('#ppressform .press-box').eq(pr - 1).find('.input-box:nth-of-type(1) .form-label').attr('for', 'prjp_title' + pr);
        $('#ppressform .press-box').eq(pr - 1).find('.input-box:nth-of-type(1) .form-text').attr('id', 'prjp_title' + pr);
        $('#ppressform .press-box').eq(pr - 1).find('.input-box:nth-of-type(2) .del_press').click(function(){
            $(this).parents('.press-box').remove();
        });
        $('#ppressform .press-box').arrangeable();
    });
    $('#ppressform').submit(function(){
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
            beforeSend: function(){
                $('body').append('<div class="loader"></div>');
            },
            success: function (data, textStatus, jqXHR)
            {
                $("form input:submit").prop("disabled", false);
                $('.loader').remove();
                alert(data);
            }
        });
        return false;
    });
});