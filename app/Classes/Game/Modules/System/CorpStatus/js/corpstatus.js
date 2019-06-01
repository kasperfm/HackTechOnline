$(document).ready(function() {
    $("#new_corporation").click(function () {
        $('#new_corporation_window').dialog({
           // appendTo: "body",
            width: 562,
            height: 320,
            hide: { effect: window.closeEffect, duration: window.closeDuration },
            close: function(event, ui){
                $('#new_corporation_window').remove();
                $("#wnd_corpstatus").dialog( "close" );
            },
            focus: function(event, ui){
                $(this).dialog( "moveToTop" );
            }
        });

        $('#new_corporation_window').dialog("widget").draggable("option", "containment", "parent");
        $('#new_corporation_window').dialog("widget").draggable("option", "scroll", false);
    });

    $("#leave_corporation_btn").click(function (e) {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            cache: false,
            url: '/game/module/CorpStatus/ajax/leave',
            data: {
                _token: window.Laravel.csrfToken
            },
            success: function (response) {
                $("#wnd_corpstatus").dialog("close");
            }
        });
    });

    $("#manage_corporation_btn").click(function (e) {
        $('#manage_corporation_window').dialog({
            // appendTo: "body",
            width: 562,
            height: 320,
            hide: { effect: window.closeEffect, duration: window.closeDuration },
            close: function(event, ui){
                $('#manage_corporation_window').remove();
                $("#wnd_corpstatus").dialog( "close" );
            },
            focus: function(event, ui){
                $(this).dialog( "moveToTop" );
            }
        });

        $('#manage_corporation_window').dialog("widget").draggable("option", "containment", "parent");
        $('#manage_corporation_window').dialog("widget").draggable("option", "scroll", false);
    });

    $("#join_corporation_btn").click(function (e) {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            cache: false,
            url: '/game/module/CorpStatus/ajax/join',
            data: {
                _token: window.Laravel.csrfToken,
                invitekey: $("#invitekey").val()
            },
            success: function (response) {
                $("#wnd_corpstatus").dialog("close");
            }
        });

        e.preventDefault();
    });

    $("#create_new_corp_btn").click(function (e) {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            cache: false,
            async: false,
            url: '/game/module/CorpStatus/ajax/create',
            data: {
                _token: window.Laravel.csrfToken,
                name: $("#corp_name").val(),
                description: $("#corp_description").val()
            },
            success: function(response){
                if(response.answer === true) {
                    $.notification(
                        {
                            title: "Corporation",
                            timeout: 4000,
                            icon: 'c',
                            color: '#fff',
                            content: "Your new corporation has been created!"
                        }
                    );

                    $("#new_corporation_window").dialog( "close" );
                }else{
                    $.notification(
                        {
                            title: "Corporation",
                            timeout: 4000,
                            icon: 'c',
                            color: '#fff',
                            content: "Unable to create the new corporation! Please check your input fields..."
                        }
                    );
                }
            }
        });

        e.preventDefault();
    });
});