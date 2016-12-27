var im, ex;
$(document).ready(function(){
    ex = $('.extra_container .extra-box').length;

    tinymce.init({
        selector: '.form-textarea',
        menubar: false,
        statusbar : false,
        plugins: ['advlist link hr directionality textcolor colorpicker'],
        toolbar1: 'undo redo | formatselect fontsizeselect | bold italic underline strikethrough | subscript superscript blockquote | ltr rtl',
        toolbar2: 'bullist numlist outdent indent | alignleft aligncenter alignright alignjustify',
        toolbar3: 'forecolor backcolor | link unlink | hr | removeformat'
    });

    $('#add_category').click(function(){
        $('#newcategory').addClass('active');
    });

    $('#add_status').click(function(){
        $('#newstatus').addClass('active');
    });

    $('.extra_container .extra-box').arrangeable();

    $('#add_extra').click(function(){
        ex++;
        $('.extra_container').append($('.new-extra').html());
        $('.extra_container .extra-box:last-of-type .input-box:nth-of-type(1) .form-label').attr('for', 'prje_title' + ex);
        $('.extra_container .extra-box:last-of-type .input-box:nth-of-type(1) .form-text').attr('id', 'prje_title' + ex);
        $('.extra_container .extra-box:last-of-type .input-box:nth-of-type(2) .form-label').attr('for', 'prje_content' + ex);
        $('.extra_container .extra-box:last-of-type .input-box:nth-of-type(2) .form-text').attr('id', 'prje_content' + ex);
        $('.extra_container .extra-box:last-of-type .input-box:nth-of-type(3) .del_extra').click(function(){
            $(this).parents('.extra-box').remove();
        });
        $('.extra_container .extra-box').arrangeable();
    });

    $('.close-form').click(function(){
        $(this).parent().parent().removeClass('active');
    });

    $("form#newcategoryform").submit(function()
    {
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
                $.ajax({
                    type: 'get',
                    url: $('form#newcategoryform').attr('action'),
                    cache: false,
                    dataType: 'json',
                    success: function(data, textStatus, jqXHR){
                        var typeOp = '';
                        for(var i in data)
                        {
                            typeOp += '<option class="form-option" value="' + data[i].prjc_id + '">' + data[i].prjc_title + '</option>\n';
                        }
                        var selval = $('select#prj_category').val();
                        $('select#prj_category').html(typeOp);
                        $('select#prj_category').val(selval);
                        $('#newcategory').removeClass('active');
                        $("form#newcategoryform").get(0).reset();
                    }
                });
                $("form input:submit").prop("disabled", false);
                $('.loader').remove();
                alert(data);
            }
        });
        return false;
    });

    $("form#newstatusform").submit(function()
    {
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
                $.ajax({
                    type: 'get',
                    url: $('form#newstatusform').attr('action'),
                    cache: false,
                    dataType: 'json',
                    success: function(data, textStatus, jqXHR){
                        var typeOp = '';
                        for(var i in data)
                        {
                            typeOp += '<option class="form-option" value="' + data[i].prjs_id + '">' + data[i].prjs_title + '</option>\n';
                        }
                        var selval = $('select#prj_status').val();
                        $('select#prj_status').html(typeOp);
                        $('select#prj_status').val(selval);
                        $('#newstatus').removeClass('active');
                        $("form#newstatusform").get(0).reset();
                    }
                });
                $("form input:submit").prop("disabled", false);
                $('.loader').remove();
                alert(data);
            }
        });
        return false;
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