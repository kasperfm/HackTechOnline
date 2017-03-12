$(document).ready(function() {
    $('#register_window').dialog({
        width: 945,
        height: 570,
        autoOpen: true,
        hide: {duration: 225},
        close: function (event, ui) {
            $(this).remove();
        }
    });
    $('#register_window').dialog("widget").draggable("option", "containment", "#window_wrapper");
});