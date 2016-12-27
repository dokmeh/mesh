$(document).ready(function () {
    $('.menubt').click(function (argument) {
        menu();
    });
    setTimeout(function() {
        $('svg#Enter-logo').addClass('intro-logo-op-ef');
    })
    $('nav li a').click(function () {
        window.history.pushState(null, null, $(this).attr('href'));
        loadajax($(this).attr('href'));
        $('nav li').removeClass('menu-visited');
        $(this).parent().addClass('menu-visited');
        return false;
    });
    $(window).on('popstate', function(){
        url = window.location.href.replace($('base').attr('href'), '');
        loadAjax(url);
    });
    try {
        window[$('body').attr('data-page')]();
    }
    catch (err) {
        // Handle error(s) here
    }
    $("body").scrollTop(0);
});
var menuStatus = false;
function menu(argument) {
    if ($('.menu').hasClass('menu-open') == true) {
        menuStatus = false;
    } else {
        menuStatus = true;
    }
    $('.menu').toggleClass('menu-open');
    $('.identity').toggleClass('identity-open');
    $('.fa').toggleClass('fa-hide');
    $('body').toggleClass('body-after-enter');
}
function changearticles() {

    setInterval(function () {
        var nxl = $('.ar-op').eq(0).next('.home-articles').length;
        if (nxl != 0) {
            $('.ar-op').eq(0).removeClass('ar-op').next('.home-articles').addClass('ar-op').prev(".home-articles").addClass('ar-before');
            $('.article-num-op').eq(0).removeClass('article-num-op').next('.article-num').addClass('article-num-op');
        } else {
            $('.home-articles').removeClass('ar-op ar-before').first().addClass('ar-op');
            $('.article-num').removeClass('article-num-op').first('.article-num').addClass('article-num-op');
        }

    }, 3000);
}

function loadajax(url) {
    $.ajax({
        url: 'aj' + url,
        method: "GET",
        beforeSend: function (argument) {
            loading();
        },
        dataType: "json"
    }).done(function (data) {
        setTimeout(function () {
            $('title').text(data.title);
            $('body').attr('data-page', data.page)
            $('.content').empty().append(data.content);
            $('.content').removeAttr('class').addClass('content ' + data.page);
            $("body").scrollTop(0);
            loaded();
            try {
                window[$('body').attr('data-page')]();
            }
            catch (err) {
                // Handle error(s) here
            }
        }, 1000);

    });
}

function loading() {
    $('.maintransition').addClass('main-loading');
    $('.loading').addClass('loading-on');
    $('footer').hide();
}

function loaded() {
    if (menuStatus == true) {
        menu();
    }
    setTimeout(function () {
        $('.maintransition').removeClass('main-loading');
        $('.loading').removeClass('loading-on');
        $('footer').show();
        var hh = $('body').height();
        $('canvas').css('height', hh + 'px');
    }, 500);

}

function home() {
    console.log('home');
    var EnterSt = false;
    croc = Snap.select("#Enter-logo"),
        lefttextmask = croc.select("#SVGID_1_"),
        lefttext = croc.select("#left-text"),
        righttextmask = croc.select("#SVGID_3_"),
        righttext = croc.select("#right-text"),
        entertextmask = croc.select("#SVGID_5_"),
        entertext = croc.select("#entertext"),
        line = croc.select("#logo-line");
    $('#Enter-logo').mouseenter(function () {
        if (EnterSt == false) {
            lefttext.animate({
                transform: "t1200,0"
            }, 500, mina.easeinout);
            lefttextmask.animate({
                transform: "t-1200,0"
            }, 500, mina.easeinout);
            entertext.animate({
                transform: "t1190,0"
            }, 500, mina.easeinout);
            entertextmask.animate({
                transform: "t-1190,0"
            }, 500, mina.easeinout);
            righttext.animate({
                transform: "t-500,0"
            }, 500, mina.easeinout);
            righttextmask.animate({
                transform: "t500,0"
            }, 500, mina.easeinout);
        }
    });
    $('#Enter-logo').mouseleave(function () {
        if (EnterSt == false) {
            lefttext.animate({
                transform: "t0,0"
            }, 500, mina.easeinout);
            lefttextmask.animate({
                transform: "t0,0"
            }, 500, mina.easeinout);
            entertext.animate({
                transform: "t0,0"
            }, 500, mina.easeinout);
            entertextmask.animate({
                transform: "t0,0"
            }, 500, mina.easeinout);
            righttext.animate({
                transform: "t0,0"
            }, 500, mina.easeinout);
            righttextmask.animate({
                transform: "t0,0"
            }, 500, mina.easeinout);
        }
    });
    $('#Enter-logo').click(function () {
        EnterSt = true;
        setTimeout(function () {
            $("body").scrollTop(0);
        }, 100)
        loadajax('');
        $("body").removeClass('intro');
        lefttext.animate({
            transform: "t1200,0"
        }, 500, mina.easeinout);
        lefttextmask.animate({
            transform: "t-1200,0"
        }, 500, mina.easeinout);
        entertext.animate({
            transform: "t0,0"
        }, 500, mina.easeinout);
        entertextmask.animate({
            transform: "t0,0"
        }, 500, mina.easeinout);
        righttext.animate({
            transform: "t-500,0"
        }, 500, mina.easeinout);
        righttextmask.animate({
            transform: "t500,0"
        }, 500, mina.easeinout);
        setTimeout(function () {
            $('#Enter-logo').addClass('Enter-logo-rotate');
        }, 500);
        setTimeout(function () {
            $('#Enter-logo').addClass('Enter-logo-scale');
        }, 1400);
        setTimeout(function () {
            $('#Enter-logo').addClass('Enter-logo-up');
            $('.maintransition').addClass('main-open');
            $('body').addClass('body-after-enter');
            changearticles();
            $('.enter').remove();
        }, 1900);
    });
    if($('body').attr('data-device') !== 'computer')
    {
        setTimeout(function(){
            $('#Enter-logo').trigger('mouseenter');
        }, 1000);
    }
}

function projects() {
    window.sr = ScrollReveal().reveal('.a-w-d',{ duration: 1000, reset:true}, 100);
    $('.thumb a').click(function(){
        window.history.pushState(null, null, $(this).attr('href'));
        loadajax($(this).attr('href'));
        return false;
    });
    $('.projects-category-list li').click(function functionName() {
        var cat = $(this).attr('data-cat');
        if (cat == 'all') {
            $('.projects-category-list li').removeClass('cat-hide');
            $(this).addClass('cat-hide');
            $('.projects-boxes').removeClass('pr-hide');
        } else {

            $('.projects-category-list li').removeClass('cat-hide');
            $(this).addClass('cat-hide');
            $('.projects-boxes').addClass('pr-hide');
            $('.projects-boxes[data-cat="' + cat + '"]').removeClass('pr-hide');
        }
    });
}

function project() {
    console.log('project');
    $('body').find('.project .leftarrow').click(function () {
        imageNav('next');
    });
    $("body").keydown(function (e) {
        if (e.keyCode == 37) { // left
            imageNav('next');
        }
        else if (e.keyCode == 39) { // right
            imageNav('next');
        }
    });
    function imageNav(argument) {
        if (argument == "next") {
            $('#c').is(':last-child')
            if ($('.project .slides.slideop').is(":last-child")) {
                $('.project .slides').removeClass('slideop slidebefore').addClass('slideafter').eq(0).addClass('slideop').removeClass('slideafter');
            } else {
                $('.project .slides.slideop').removeClass('slideop').addClass('slidebefore').next('.slides').removeClass('slideafter').addClass('slideop');
            }
        } else if (argument == "prev") {
            if ($('.project .slides.slideop').is(":first-child")) {
                $('.project .slides').removeClass('slideop slidebefore').addClass('slideafter').last().addClass('slideop').removeClass('slideafter');
            } else {
                $('.project .slides.slideop').removeClass('slideop').addClass('slidebefore').prev('.slides').removeClass('slideafter').addClass('slideop');
            }
        }
    }

    var elementsOffset = [];
    for (var i = 0; i < $('.page').length; i++) { ///aside function
        elementsOffset.push($('.page').eq(i).offset().top);
    }
    ;
    $('body').find('.categorys li').click(function () {
        var attr = $(this).index();
        $('body').animate({scrollTop: elementsOffset[attr]}, 1000);
        attr = '';
    });
}

function events() {
    projects();
}

function event() {
    project();
}

function studio() {
    var elementsOffset = [];
    for (var i = 0; i < $('.page').length; i++) { ///aside function
        elementsOffset.push($('.page').eq(i).offset().top);
    }
    ;
    $('body').find('.categorys li').click(function () {
        var attr = $(this).index();
        $('body').animate({scrollTop: elementsOffset[attr]}, 1000);
        attr = '';
    });
}

function research() {
    console.log('research');
}
