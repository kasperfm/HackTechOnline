$(".toggle-install-state").bind( "click", function() {
    var thisElement = $(this);
    var appID = $(this).attr("rel");
    var appState = $(this).attr("app-state");

    if(appState === "installed") {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            cache: false,
            url: '/game/module/mysoftware/ajax/remove',
            data: {
                _token: window.Laravel.csrfToken,
                softwareId: appID
            },
            success: function(response) {
                if (response.answer === true) {
                    refreshHTML();
                    updateApplicationMenu();
                    updateResourceBars();
                }
            }
        });
    }else if(appState === "removed"){
        $.ajax({
            type: 'POST',
            dataType: 'json',
            cache: false,
            url: '/game/module/mysoftware/ajax/install',
            data: {
                _token: window.Laravel.csrfToken,
                softwareId: appID
            },
            success: function (response) {
                if (response.answer === true) {
                    refreshHTML();
                    updateApplicationMenu();
                    updateResourceBars();
                }
            }
        });
    }
});

function refreshHTML() {
    $.ajax({
        async: false,
        type: 'POST',
        dataType: 'json',
        cache: false,
        url: '/game/module/mysoftware/ajax/refresh',
        data: {
            _token: window.Laravel.csrfToken,
        },
        success: function (response) {
            $("#wnd_mysoftware").html(response);
        }
    });
}
