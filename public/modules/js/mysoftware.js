$(document).ready(function() {
    $(".install-software").click(function() {
        var thisElement = $(this);
        var appID = $(this).attr("rel");

        $.ajax({
            type: 'POST',
            dataType: 'json',
            cache: false,
            url: '/game/module/mysoftware/ajax/install',
            data: {
                _token: window.Laravel.csrfToken,
                softwareId: appID
            },
            success: function(response) {
                if(response.answer === true){
                    thisElement.removeClass('install-software');
                    thisElement.removeClass('text-red');

                    thisElement.addClass('remove-software');
                    thisElement.addClass('text-green');
                }
            }
        });
    });

    $(".remove-software").click(function() {
        var thisElement = $(this);
        var appID = $(this).attr("rel");

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
                if(response.answer === true){
                    thisElement.removeClass('remove-software');
                    thisElement.removeClass('text-green');

                    thisElement.addClass('install-software');
                    thisElement.addClass('text-red');
                }
            }
        });
    });
});
