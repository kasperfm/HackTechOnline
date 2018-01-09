$(document).ready(function() {
    $('.noEnterSubmit').keypress(function (e) {
        if (e.which == 13) {
            $("#scan-submit").click();
            e.preventDefault();
        }
    });

    $("#scan-submit").click(function() {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            cache: false,
            url: '/game/module/portscanner/ajax/scan',
            data: {
                _token: window.Laravel.csrfToken,
                address: $("#scan-address").val()
            },
            success: function (response) {
                if (response.answer === true) {
                    if (response.scanresults !== false) {
                        $("#portscan-results").html('<li>Scan results:</li>');
                        $.each(response.scanresults, function(i, item) {
                            $("#portscan-results").append('<li>'+item.port+' - '+item.name+'</li>');
                        });
                    }else{
                        $("#portscan-results").html('<li>No open ports found!</li>');
                    }
                } else {
                    $("#portscan-results").html('<li>Target not found!</li>');
                }
            }
        });
    });
});