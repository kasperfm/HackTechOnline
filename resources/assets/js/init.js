var closeEffect = "drop";
var closeDuration = 225;

function setWindowWrapperSize() {
    $('#window_wrapper').css('height', ($(window).height() - 44) + 'px');
}

function updateCredits() {
    $.ajax({
        type: 'POST',
        dataType: 'json',
        cache: false,
        data: {
            _token: window.Laravel.csrfToken
        },
        url: '/game/ajax/economy/getcredits',
        success: function(response) {
            if(response.answer === true) {
                $('.credits-display').html('$ ' + response.credits);
            }
        }
    });
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

    $(".credits-display").click(function() {
        updateCredits();
    });

    // Open the demo window (for testing purpose only).
    $('#demo_window').dialog({
        width: 945,
        height: 515,
        autoOpen : true,
        hide: { effect: closeEffect, duration: 225 },
        close: function(event, ui){
            $(this).remove();
        }
    });
    $('#demo_window').dialog("widget").draggable("option", "containment", "parent");
    $('#demo_window').dialog("widget").draggable("option", "scroll", false);

    // Handle resize of the browser window.
    setWindowWrapperSize();
    $(window).resize(function () {
        setWindowWrapperSize();
    });

    $('.logout-btn').on('click', function(){
        window.location.href = '/game-logout';
    });

    updateCredits();

    // The fade-in effect when you login.
    // $('body').css('display', 'none');
    // $('body').fadeIn(3000);
    $('#footer').fadeIn(3000);
    $('#top-wrapper').fadeIn(3000);

    window.closeEffect = closeEffect;
    window.closeDuration = closeDuration;
});
