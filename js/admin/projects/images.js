$(document).ready(function(){
    $('#porderimagesform .pbox').arrangeable();
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
                $('#pthumbimg').attr('src', e.target.result);
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
                $('#prj_images').val('');
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

    $('#pthumbform, #pnewimagesform').submit(function(){
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
            success: function(data, textStatus, jqXHR){
                $("form input:submit").prop("disabled", false);
                $('.loader').remove();
                alert(data);
                if(data == "Saved.")
                {
                    location.reload(true);
                }
            }
        });
        return false;
    });

    $('.del_img').click(function(){
        $(this).parents('.pbox').remove();
    });

    $('#porderimagesform').submit(function(){
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