$(document).ready(function(){
    $('#pdeleteform').submit(function(){
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
            success: function(data, textStatus, jqXHR){
                $("form input:submit").prop("disabled", false);
                $('.loader').remove();
                alert(data);
                if(data == 'Deleted.')
                {
                    location.href = 'admin/events';
                }
            }
        });
        return false;
    });
});