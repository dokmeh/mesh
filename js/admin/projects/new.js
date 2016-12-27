var im, ex, li, pr;
$(document).ready(function(){
    ex = 0, aw = 0, li = 0, pr = 0;

    tinymce.init({
        selector: '.form-textarea',
        menubar: false,
        statusbar : false,
        plugins: ['advlist link hr directionality textcolor colorpicker'],
        toolbar1: 'undo redo | formatselect fontsizeselect | bold italic underline strikethrough | subscript superscript blockquote | ltr rtl',
        toolbar2: 'bullist numlist outdent indent | alignleft aligncenter alignright alignjustify',
        toolbar3: 'forecolor backcolor | link unlink | hr | removeformat'
    });

    $('#prj_thumb').ezdz({
        text: 'Drag & drop thumbnail here or click to choose it',
        previewImage: false,
        reject: function(file, errors){
            if (errors.mimeType)
            {
                alert(file.name + ' must be an image.');
                $('#prj_thumb').val('');
            }
        },
        accept: function(file){
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#prthumb-box').append($('<img id="prthumb">').attr('src', e.target.result));
            };
            reader.readAsDataURL(file);
        }
    });

    $('#prj_images').ezdz({
        text: 'Drag & drop images here or click to choose them',
        previewImage: false,
        reject: function(file, errors) {
            if (errors.mimeType)
            {
                alert(file.name + ' must be an image.');
            }
        },
        accept: function(file){
            var str = "";
            for(var i = 0 ; i < $('#prj_images')[0].files.length ; i++)
            {
                str += $('#prj_images')[0].files[i].name;
                if(i < $('#prj_images')[0].files.length - 1)
                {
                    str += ", ";
                }
            }
            $('#prj_images').siblings('div:first-of-type').text(str);
            $('#prj-imgs-box').empty();
            im = 0;
            load_imgs();
        }
    });

    $('#add_category').click(function(){
        $('#newcategory').addClass('active');
    });

    $('#add_status').click(function(){
        $('#newstatus').addClass('active');
    });

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

    $('#add_award').click(function(){
        aw++;
        $('.award_container').append($('.new-award').html());
        $('.award_container .award-box:last-of-type .input-box:nth-of-type(1) .form-label').attr('for', 'prja_title' + aw);
        $('.award_container .award-box:last-of-type .input-box:nth-of-type(1) .form-text').attr('id', 'prja_title' + aw);
        $('.award_container .award-box:last-of-type .input-box:nth-of-type(2) .del_award').click(function(){
            $(this).parents('.award-box').remove();
        });
        $('.award_container .award-box').arrangeable();
    });

    $('#add_link').click(function(){
        li++;
        $('.link_container').append($('.new-link').html());
        $('.link_container .link-box:last-of-type .input-box:nth-of-type(1) .form-label').attr('for', 'prjl_title' + aw);
        $('.link_container .link-box:last-of-type .input-box:nth-of-type(1) .form-text').attr('id', 'prjl_title' + aw);
        $('.link_container .link-box:last-of-type .input-box:nth-of-type(2) .form-label').attr('for', 'prjl_url' + aw);
        $('.link_container .link-box:last-of-type .input-box:nth-of-type(2) .form-text').attr('id', 'prjl_url' + aw);
        $('.link_container .link-box:last-of-type .input-box:nth-of-type(3) .del_link').click(function(){
            $(this).parents('.link-box').remove();
        });
        $('.link_container .link-box').arrangeable();
    });

    $('#add_press').click(function(){
        pr++;
        $('.press_container').append($('.new-press').html());
        $('.press_container .press-box:last-of-type .input-box:nth-of-type(1) .form-label').attr('for', 'prjp_title' + aw);
        $('.press_container .press-box:last-of-type .input-box:nth-of-type(1) .form-text').attr('id', 'prjp_title' + aw);
        $('.press_container .press-box:last-of-type .input-box:nth-of-type(2) .del_press').click(function(){
            $(this).parents('.press-box').remove();
        });
        $('.press_container .press-box').arrangeable();
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
                        $('select#prj_category').html(typeOp);
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
                        $('select#prj_status').html(typeOp);
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

    $("form#pnewform").submit(function()
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
                $('body').append('<div class="loader"><p>0%</p></div>');
            },
            xhr: function() {
                var myXhr = $.ajaxSettings.xhr();
                if(myXhr.upload){
                    myXhr.upload.addEventListener('progress',function (e) {
                        if(e.lengthComputable){
                            var max = e.total;
                            var current = e.loaded;
                            var Percentage = Math.round((current * 100)/max);
                            $('.loader p').text(Percentage + '%');
                        }

                    }, false);
                }
                return myXhr;
            },
            success: function (data, textStatus, jqXHR)
            {
                $("form input:submit").prop("disabled", false);
                $('.loader').remove();
                alert(data);
                if(data == 'Saved.')
                {
                    $("form#pnewform").get(0).reset();
                    $('#prthumb-box').empty();
                    $('#prj-imgs-box').empty();
                    $('.extra_container').empty();
                    $('.award_container').empty();
                }
            }
        });
        return false;
    });
});

function load_imgs()
{
    var reader = new FileReader();
    reader.onload = function (e) {
        $('#prj-imgs-box').append($('<img class="up-imgs">').attr('src', e.target.result));
        im++;
        if(im < $('#prj_images')[0].files.length)
        {
            load_imgs();
        }
    };
    reader.readAsDataURL($('#prj_images')[0].files[im]);
}