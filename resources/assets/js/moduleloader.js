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
            if(response.answer === true) {
                $(".window_wrapper").append('<div id="wnd_'+moduleName+'" class="dialog_window wnd_'+moduleName+'" title="'+response.title+'"></div>');
                $("#wnd_" + moduleName).html(response.view);

                $('#wnd_'+moduleName).dialog({
                    appendTo: ".window_wrapper",
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
                updateResourceBars();
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
            modname: moduleName,
            _token: window.Laravel.csrfToken
        },
        url: '/game/ajax/module/unload',
        success: function(response) {
            if(response.answer === true) {
                updateResourceBars();
            }
        }
    });
}

function setResourceBar(type, resval){
    $(".res_" + type + "_bar").progressbar("option", "value", resval);
}

function updateResourceBars(){
    $.ajax({
        type: 'POST',
        dataType: 'json',
        cache: false,
        data: {
            _token: window.Laravel.csrfToken
        },
        url: '/game/ajax/getresources',
        success: function(response) {
            if(response.answer === true) {
                setResourceBar("cpu", response.cpu);
                setResourceBar("ram", response.ram);
                setResourceBar("hdd", response.hdd);
            }
        }
    });
}

function updateApplicationMenu() {
    $.ajax({
        type: 'POST',
        dataType: 'json',
        cache: false,
        data: {
            _token: window.Laravel.csrfToken
        },
        url: '/game/ajax/module/list',
        success: function(response) {
            if(response.answer === true) {
                $('.appmenu').html(response.content);

                if($('.appmenu').html() != ''){
                    $(".applications-menu").css("color", "white");
                }else{
                    $(".applications-menu").css("color", "#4b4b4b");
                }

                $(".exec").unbind("click");
                $('.exec').click(function() {
                    loadModule($(this).attr("rel"));
                });
            }
        }
    });
}

$(document).ready(function() {
    $(".res_meter").progressbar();
    updateResourceBars();

    $('.exec').click(function() {
        loadModule($(this).attr("rel"));
    });
});
