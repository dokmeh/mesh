var li;
$(document).ready(function(){
    li = $('#plinksform .link-box').length;
    $('#plinksform .link-box .input-box:nth-of-type(2) .del_link').click(function(){
        $(this).parents('.link-box').remove();
    });
    $('#plinksform .link-box').arrangeable();
    $('#add_link').click(function(){
        $('.link-boxes').append($('.new-link').html());
        li++;
        $('#plinksform .link-box').eq(li - 1).find('.input-box:nth-of-type(1) .form-label').attr('for', 'prja_title' + li);
        $('#plinksform .link-box').eq(li - 1).find('.input-box:nth-of-type(1) .form-text').attr('id', 'prja_title' + li);
        $('#plinksform .link-box').eq(li - 1).find('.input-box:nth-of-type(2) .form-label').attr('for', 'prja_url' + li);
        $('#plinksform .link-box').eq(li - 1).find('.input-box:nth-of-type(2) .form-text').attr('id', 'prja_url' + li);
        $('#plinksform .link-box').eq(li - 1).find('.input-box:nth-of-type(3) .del_link').click(function(){
            $(this).parents('.link-box').remove();
        });
        $('#plinksform .link-box').arrangeable();
    });
    $('#plinksform').submit(function(){
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