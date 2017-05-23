function setBrowserSize() {
    $('#wnd_webbrowser .webbrowser-content').css('height', ($('#wnd_webbrowser').height() - 75) + 'px');
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
      /*  $.ajax({
            type: 'POST',
            dataType: 'json',
            cache: false,
            url: 'modules/system/webbrowser/ajax/goto.php',
            data: {
                address: $("#www-address").val()
            },
            success: function(response){
                if(response.answer === true) {
                    if(response.www_url != null){
                       // $(".webbrowser-content").html('<iframe id="wwwframe" frameBorder="0" src="' + gameServerAddress + decodeURIComponent(response.www_url) + '" width="100%" height="100%"></iframe>');
                    }
                }else{
                    $(".webbrowser-content").html('<h1>Server or page not found !</h1>');

                }
            }
        });*/
        $(".webbrowser-content").html('<h1>Work in progress feature!</h1>');
        setBrowserSize();
        return false;
    });
});
