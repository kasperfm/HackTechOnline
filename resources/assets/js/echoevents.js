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
});
