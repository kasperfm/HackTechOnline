$(document).ready(function() {
    $('#login_window').dialog({
        width: 820,
        height: 570,
        autoOpen : true,
        resizable: false,
        closeOnEscape: false,
        open: function(){
            $(".ui-dialog-titlebar-close").hide();
            $(".ui-dialog-titlebar-min").hide();
        },
        position: {my: "center", at: "center", of: $("body"),within: $("body") }
    });
    $('#login_window').css('background-color', 'black');
    $(".ui-dialog-titlebar-min").hide();
    glitch("login-logo-canvas", "img/logo.png");
});
