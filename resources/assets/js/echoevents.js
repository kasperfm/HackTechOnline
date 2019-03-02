Echo.private('notifications' + window.userToken).listen('Notification', (e) => {
    var timeout = 5000;

    if(e.autohide === false){
        timeout = 0;
    }

    $.notification({
        title: e.title,
        icon: 'c',
        color: '#fff',
        timeout: timeout,
        content: e.message
    });

    updateCredits();
});

Echo.private('handleapp' + window.userToken).listen('HandleApp', (e) => {
    if(e.method === 'refresh'){
        if($("#wnd_" + e.moduleName.toLowerCase())){
            $("#wnd_" + e.moduleName.toLowerCase()).html(e.methodData);
        }
    }

    if(e.method === 'close'){
        if($("#wnd_" + e.moduleName.toLowerCase())){
            $("#wnd_" + e.moduleName.toLowerCase()).dialog('close');
        }
    }
});
