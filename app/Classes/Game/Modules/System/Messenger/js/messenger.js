function setChatSize() {
    $('#send-message').css('width', ($('#wnd_messenger').width() - 40) + 'px');
}

$(document).ready(function() {
    setChatSize();

    $("#wnd_messenger").bind("dialogresize", function(event, ui) {
        setChatSize();
    });

    var socket = io.connect(backendServer, {'force new connection':true});
    var $nickError = $('#nickError');
    var $nickBox = $('#nickname');
    var $users = $('#users');
    var $messageForm = $('#send-message');
    var $messageBox = $('#message');
    var $chat = $('#chat');

    socket.on('connecting', function(data){
        $chat.append('<li><span class="msg">Connecting to chat service...</span></li>');
    });

    socket.on('connect', function(data){
        $chat.append('<li><span class="msg">Connected!</span></li>');
    });

    socket.emit('new user', username, function(){});

    socket.on('usernames', function(data){
        var html = '<h1>USERS:</h1>';
        for(i=0; i < data.length; i++){
            html += '<span class="wuser">' + data[i] + '</span><br />'
        }
        $users.html(html);

        $('.wuser').click(function(){
            $messageBox.val('/w ' + $(this).html() + ' ');
            $messageBox.focus();
        });
    });

    $messageForm.submit(function(e){
        if($messageBox.val() != ''){
            socket.emit('send message', $messageBox.val(), function(data){
                $chat.append('<span class="error">' + data + "</span><br/>");
            });
            $messageBox.val('');
        }
        e.preventDefault();
    });

    socket.on('new message', function(data){
        $chat.append('<li><span class="msg"><b>' + data.nick + ': </b>' + $('<span>'+data.msg+'</span>').text() + "</span></li>");
        $("#chatBox").animate({ scrollTop: $('#chatBox')[0].scrollHeight}, 1000);
    });

    socket.on('whisper', function(data){
        $chat.append('<li><span class="whisper"><b>' + data.nick + ': </b>' + $('<span>'+data.msg+'</span>').text() + "</span></li>");
        $("#chatBox").animate({ scrollTop: $('#chatBox')[0].scrollHeight}, 1000);
    });

    $('#wnd_messenger').dialog({
        autoOpen: true
    }).bind('dialogbeforeclose', function(event, ui) {
        socket.emit('disconnect', function(data){});
        socket.disconnect();
    });
});