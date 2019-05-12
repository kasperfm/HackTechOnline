$(document).ready(function() {
    $("#select-log-category").change(function() {
        var logType = $(this).val();

        $.ajax({
            type: 'POST',
            dataType: 'json',
            cache: false,
            url: '/game/module/LogReader/ajax/list',
            data: {
                _token: window.Laravel.csrfToken,
                logtype: logType
            },
            success: function (response) {
                if (response.answer === true) {
                    $('.log-reader-display').html(response.view);
                }
            }
        });
    });
});