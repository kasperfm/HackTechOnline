$(document).ready(function() {
    $('.noEnterSubmit').keypress(function (e) {
        if (e.which == 13) {
            $("#scan-submit").click();
            e.preventDefault();
        }
    });

    $("#renew-submit").click(function() {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            cache: false,
            url: '/game/module/IpRenewer/ajax/renew',
            data: {
                _token: window.Laravel.csrfToken
            },
            success: function (response) {
                if (response.answer === true) {
                    $.notification(
                        {
                            title: 'Gateway status',
                            icon: 'c',
                            color: '#fff',
                            content: "The IP address of your gateway has been changed." ,
                            timeout: 5000
                        }
                    );
                }else{
                    $.notification(
                        {
                            title: 'Gateway status',
                            icon: 'c',
                            color: '#fff',
                            content: "Unable to change IP address, because of renew-cooldown." ,
                            timeout: 5000
                        }
                    );
                }
            }
        });
    });
});