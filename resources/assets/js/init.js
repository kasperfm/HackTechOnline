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

    // Handle resize of the browser window.
    setWindowWrapperSize();
    $(window).resize(function () {
        setWindowWrapperSize();
    });

    // The fade-in effect when you login.
    $('body').css('display', 'none');
    $('body').fadeIn(3000);
});
