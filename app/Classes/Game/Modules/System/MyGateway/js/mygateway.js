$(document).ready(function() {
    $(".hw_item").hover(function() {
        var name = $(this).attr("rel");
        $(".hw_"+name).stop(true, true).removeClass("text-pink").addClass("text-blue");
        $(".val_"+name).stop(true, true).addClass("text-blue");
    }, function() {
        var name = $(this).attr("rel");
        $(".hw_"+name).stop(true, true).removeClass("text-blue").addClass("text-pink");
        $(".val_"+name).stop(true, true).removeClass("text-blue");
    });

    $(".hw_item").click(function() {
        var name = $(this).attr("rel");

        $.ajax({
            type: 'POST',
            dataType: 'json',
            cache: false,
            url: '/game/module/MyGateway/ajax/item',
            data: {
                _token: window.Laravel.csrfToken,
                partType: name
            },
            success: function(response) {
                $("#mygateway-content").html(response.view);
                initGWShop();
            }
        });
    });
});

function initGWShop() {
    $(".hw_shop_goback").click(function() {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            cache: false,
            url: '/game/module/MyGateway/ajax/overview',
            data: {
                _token: window.Laravel.csrfToken
            },
            success: function(response) {
                $("#wnd_mygateway").html(response.view);
            }
        });
    });

    $(".hw_shop_list_item").click(function() {
        if (confirm('Do you want to purchase this upgrade?')) {
            var hw_id = $(this).attr("rel");

            $.ajax({
                type: 'POST',
                dataType: 'json',
                cache: false,
                url: '/game/module/MyGateway/ajax/buy',
                data: {
                    hardwareid: hw_id,
                    _token: window.Laravel.csrfToken
                },
                success: function(response){
                    if(response.answer == true) {
                        if(response.purchase == true){
                            updateResourceBars();
                            updateCredits();
                            $.notification({
                                title: 'My Gateway',
                                icon: 'c',
                                color: '#fff',
                                timeout: 4000,
                                content: 'Hardware purchase successful !'
                            });
                            $(".hw_shop_goback").click();
                        }else{
                            $.notification({
                                title: 'My Gateway',
                                icon: 'c',
                                color: '#fff',
                                timeout: 4000,
                                content: 'You don\'t have enough money to purchase this upgrade !'
                            });
                        }
                    }
                }
            });
        }
    });
}