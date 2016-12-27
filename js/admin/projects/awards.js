var aw;
$(document).ready(function(){
    aw = $('#pawardsform .award-box').length;
    $('#pawardsform .award-box .input-box:nth-of-type(2) .del_award').click(function(){
        $(this).parents('.award-box').remove();
    });
    $('#pawardsform .award-box').arrangeable();
    $('#add_award').click(function(){
        $('.award-boxes').append($('.new-award').html());
        aw++;
        $('#pawardsform .award-box').eq(aw - 1).find('.input-box:nth-of-type(1) .form-label').attr('for', 'prja_title' + aw);
        $('#pawardsform .award-box').eq(aw - 1).find('.input-box:nth-of-type(1) .form-text').attr('id', 'prja_title' + aw);
        $('#pawardsform .award-box').eq(aw - 1).find('.input-box:nth-of-type(2) .del_award').click(function(){
            $(this).parents('.award-box').remove();
        });
        $('#pawardsform .award-box').arrangeable();
    });
    $('#pawardsform').submit(function(){
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