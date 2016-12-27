var im, ex;
$(document).ready(function(){
    tinymce.init({
        selector: '.form-textarea',
        menubar: false,
        statusbar : false,
        plugins: ['advlist link hr directionality textcolor colorpicker'],
        toolbar1: 'undo redo | formatselect fontsizeselect | bold italic underline strikethrough | subscript superscript blockquote | ltr rtl',
        toolbar2: 'bullist numlist outdent indent | alignleft aligncenter alignright alignjustify',
        toolbar3: 'forecolor backcolor | link unlink | hr | removeformat'
    });

    $("form#pinfoform").submit(function()
    {
        tinyMCE.triggerSave();
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