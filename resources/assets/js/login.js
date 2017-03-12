$(document).ready(function() {
    $('#login_window').dialog({
        width: 820,
        height: 530,
        autoOpen : true,
        resizable: false,
        closeOnEscape: false,
        open: function(){
            $(".ui-dialog-titlebar-close").hide();
            $(".ui-dialog-titlebar-min").hide();
        },
        position: {my: "center", at: "center", of: $("body"),within: $("body") }
    });

    //$('#login_window').dialog("widget").draggable("option", "containment", "#window_wrapper");
    $(".ui-dialog-titlebar-min").hide();
});
