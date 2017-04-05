function loadModule(moduleName){
    $.ajax({
        type: 'POST',
        dataType: 'json',
        cache: false,
        url: '/game/ajax/module/load',
        data: {
            modname: moduleName,
            _token: window.Laravel.csrfToken
        },
        success: function(response) {
            if(response.answer != null) {
                $("#window_wrapper").append('<div id="wnd_'+moduleName+'" class="dialog_window wnd_'+moduleName+'" title="'+response.title+'"></div>');
                $("#wnd_" + moduleName).html(response.view);

                $('#wnd_'+moduleName).dialog({
                    width: response.width,
                    height: response.height,
                    hide: { effect: window.closeEffect, duration: window.closeDuration },
                    close: function(event, ui){
                        unloadModule(moduleName);
                        $("#wnd_"+moduleName).remove();
                    },
                    focus: function(event, ui){
                        $(this).dialog( "moveToTop" );
                    }
                });

                $('#wnd_'+moduleName).dialog("widget").draggable("option","containment","#window_wrapper");
                //updateResourceBars();
            }
        }
    });
}

function unloadModule(moduleName){
    $.ajax({
        type: 'POST',
        dataType: 'json',
        cache: false,
        data: {
            modname: moduleName
        },
        url: '/game/ajax/module/unload',
        success: function(response) {
            if(response.answer == true) {
                //updateResourceBars();
            }
        }
    });
}

$(document).ready(function() {
    //updateResourceBars();

    $('.exec').click(function() {
        loadModule($(this).attr("rel"));
    });
});
