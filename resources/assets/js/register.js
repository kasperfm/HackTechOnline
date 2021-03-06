$(document).ready(function() {
    $('#register_window').dialog({
        width: 450,
        height: 650,
        autoOpen: true,
        hide: {duration: 225},
        resizable: false,
        closeOnEscape: false,
        open: function(){
            $(".ui-dialog-titlebar-close").hide();
            $(".ui-dialog-titlebar-min").hide();
        },
        close: function (event, ui) {
            $(this).remove();
        }
    });
    $('#register_window').dialog("widget").draggable("option", "containment", "#window_wrapper");

    $('#register-form').on("submit", function (e) {
        $('.register-btn').prop("disabled", true);
    });
});
