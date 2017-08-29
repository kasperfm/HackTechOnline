var browserAddressBarObj = $("#www-address");

function setBrowserSize() {
    $('#wnd_webbrowser .webbrowser-content').css('height', ($('#wnd_webbrowser').height() - 75) + 'px');
}

function navigate(input){
    $.ajax({
        type: 'POST',
        dataType: 'json',
        cache: false,
        url: '/game/module/webbrowser/ajax/navigate',
        data: {
            _token: window.Laravel.csrfToken,
            address: input
        },
        success: function(response){
            if(response.answer === true && response.webcontent !== false) {
                if(response.webcontent != false){
                    $(".webbrowser-content").html('<iframe id="wwwframe" frameBorder="0" width="100%" height="100%"></iframe>');
                    var idoc = document.getElementById('wwwframe').contentWindow.document;
                    idoc.open();
                    idoc.write(response.webcontent);
                    idoc.close();
                }
            }else{
                $(".webbrowser-content").html('<h1>Server or page not found !</h1>');
            }
        }
    });
}

$(document).ready(function() {
    $('.noEnterSubmit').keypress(function(e){
        if ( e.which == 13 ){
            $("#www-submit").click();
            e.preventDefault();
        }
    });

    // Resize when the window is opened
    $('#wnd_webbrowser .webbrowser-content').css('height', (600 - 75 - 50) + 'px');

    $("#wnd_webbrowser").bind("dialogresize", function(event, ui) {
        setBrowserSize();
    });

    $("#www-submit").click(function(){
        navigate($("#www-address").val());
        setBrowserSize();
        return false;
    });


});
