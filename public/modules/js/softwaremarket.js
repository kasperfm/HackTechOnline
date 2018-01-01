$(document).ready(function() {
    $(".info-app").click(function() {
        var applicationName = $(this).parent().attr('rel');
        var applicationVersion = $(this).attr('rel');

        $.ajax({
            type: 'POST',
            dataType: 'json',
            cache: false,

            url: '/game/module/softwaremarket/ajax/item',
            data: {
                _token: window.Laravel.csrfToken,
                appName: applicationName,
                appVersion: applicationVersion
            },
            success: function(response) {
                $("#softwaremarket-content").html(response.view);
                initSWShop();
            }
        });
    });


});

function initSWShop(){
    $(".sw_shop_goback").click(function() {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            cache: false,
            url: '/game/module/softwaremarket/ajax/overview',
            data: {
                _token: window.Laravel.csrfToken
            },
            success: function(response) {
                $("#softwaremarket-content").html(response.view);
            }
        });
    });

    $(".buy-app").click(function() {
        var applicationId = $(this).attr('value');
        var applicationVersion = $(this).attr('rel');

        $.ajax({
            type: 'POST',
            dataType: 'json',
            cache: false,
            url: '/game/module/softwaremarket/ajax/buy',
            data: {
                _token: window.Laravel.csrfToken,
                appId: applicationId,
                appVersion: applicationVersion,
            },
            success: function(response) {
                if(response.purchase === true) {
                    updateCredits();
                    $.notification({
                        title: 'Software Market',
                        icon: 'c',
                        color: '#fff',
                        timeout: 4000,
                        content: 'Software purchase successful !'
                    });

                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        cache: false,
                        url: '/game/module/softwaremarket/ajax/overview',
                        data: {
                            _token: window.Laravel.csrfToken
                        },
                        success: function(response) {
                            $("#softwaremarket-content").html(response.view);
                        }
                    });
                }else{
                    $.notification({
                        title: 'Software Market',
                        icon: 'c',
                        color: '#fff',
                        timeout: 4000,
                        content: 'You don\'t have enough money to purchase this software !'
                    });
                }
            }
        });
    });
}