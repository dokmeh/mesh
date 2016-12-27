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

    $('#eve_thumb').ezdz({
        text: 'Drag & drop thumbnail here or click to choose it',
        previewImage: false,
        reject: function(file, errors){
            if (errors.mimeType)
            {
                alert(file.name + ' must be an image.');
                $('#eve_thumb').val('');
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

    $('#eve_images').ezdz({
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
            for(var i = 0 ; i < $('#eve_images')[0].files.length ; i++)
            {
                str += $('#eve_images')[0].files[i].name;
                if(i < $('#eve_images')[0].files.length - 1)
                {
                    str += ", ";
                }
            }
            $('#eve_images').siblings('div:first-of-type').text(str);
            $('#eve-imgs-box').empty();
            im = 0;
            load_imgs();
        }
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
                    $('#eve-imgs-box').empty();
                    $('.extra_container').empty();
                    $('.award_container').empty();
                    $('#eve_thumb').siblings('div:first-of-type').html('Drag & drop thumbnail here or click to choose it');
                    $('#eve_images').siblings('div:first-of-type').html('Drag & drop images here or click to choose them');
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
        $('#eve-imgs-box').append($('<img class="up-imgs">').attr('src', e.target.result));
        im++;
        if(im < $('#eve_images')[0].files.length)
        {
            load_imgs();
        }
    };
    reader.readAsDataURL($('#eve_images')[0].files[im]);
}