var closeEffect = "scale";
var closeDuration = 225;

function setWindowWrapperSize() {
    $('#window_wrapper').css('height', ($(window).height() - 44) + 'px');
}

$(document).ready(function() {
    //Register the top menus.
    $(".menubar-item").hover(function() {
        $(this).find('ul').stop(true, true).fadeIn("fast");
    }, function() {
        $(this).find('ul').stop(true, true).fadeOut("fast");
    });
    $(".menubar-item").find('li').click(function(e){
        e.stopPropagation();
    });

    // Openthe demo window (for testing purpose only).
    $('#demo_window').dialog({
        width: 945,
        height: 570,
        autoOpen : true,
        hide: { effect: closeEffect, duration: 225 },
        close: function(event, ui){
            $(this).remove();
        }
    });
    $('#demo_window').dialog("widget").draggable("option","containment","#window_wrapper");

    // Handle resize of the browser window.
    setWindowWrapperSize();
    $(window).resize(function () {
        setWindowWrapperSize();
    });

    $('.logout-btn').on('click', function(){
        window.location.href = '/logout';
    });

    // The fade-in effect when you login.
    $('body').css('display', 'none');
    $('body').fadeIn(3000);
    $('#footer').fadeIn(3000);
    $('#top-wrapper').fadeIn(3000);
});
