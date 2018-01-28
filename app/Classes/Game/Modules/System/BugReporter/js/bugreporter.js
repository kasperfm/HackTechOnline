var sent = false;
$(document).ready(function() {
    $("#submit_bug").click(function(){
        if(sent === false && $("#bug_title").val() != "" && $("#bug_content").val() != ""){
            $.ajax({
                type: 'POST',
                dataType: 'json',
                cache: false,
                url: '/game/module/bugreporter/ajax/submit',
                data: {
                    _token: window.Laravel.csrfToken,
                    title: $("#bug_title").val(),
                    content: $("#bug_content").val(),
                    category: $("#bug_category").val()
                },
                success: function(response){
                    if(response.answer === true) {
                        sent = true;
                        $.notification(
                            {
                                title: "SYSTEM",
                                timeout: 4000,
                                icon: 'c',
                                color: '#fff',
                                content: "Your bug report has been sent!"
                            }
                        );

                        $('#wnd_bugreporter').dialog('close');
                    }
                }
            });
            return false;
        }
    });
});