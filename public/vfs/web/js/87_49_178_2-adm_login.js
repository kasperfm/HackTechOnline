$(document).ready((function(){$(".germail_adm_login_btn").bind("click",(function(){var a=$(".germail_adm_login_username").val(),n=$(".germail_adm_login_password").val();$.ajax({type:"POST",dataType:"json",cache:!1,url:"/game/web/87_49_178_2/ajax/admLogin",data:{username:a,password:n},success:function(a){!0===a.answer&&window.parent.navigate("admin.germail.com/admin")}})}))}));
