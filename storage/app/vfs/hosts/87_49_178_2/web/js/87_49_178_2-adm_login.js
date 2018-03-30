$(document).ready(function() {
    $(".germail_adm_login_btn").bind("click", function(){
        var input_username = $(".germail_adm_login_username").val();
        var input_password = $(".germail_adm_login_password").val();
        
        $.ajax({
            type: 'POST',
            dataType: 'json',
            cache: false,
            url: '/game/web/87_49_178_2/ajax/admLogin',
            data: {
                username: input_username,
                password: input_password
            },
            success: function(response) {           
                if(response.answer === true) {
                    window.parent.navigate('germail.com/admin');
                }
            }
        });
    });
});