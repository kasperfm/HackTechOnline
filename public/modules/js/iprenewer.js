$(document).ready((function(){$(".noEnterSubmit").keypress((function(e){13==e.which&&($("#scan-submit").click(),e.preventDefault())})),$("#renew-submit").click((function(){$.ajax({type:"POST",dataType:"json",cache:!1,url:"/game/module/IpRenewer/ajax/renew",data:{_token:window.Laravel.csrfToken},success:function(e){!0===e.answer?$.notification({title:"Gateway status",icon:"c",color:"#fff",content:"The IP address of your gateway has been changed.",timeout:5e3}):$.notification({title:"Gateway status",icon:"c",color:"#fff",content:"Unable to change IP address, because of renew-cooldown.",timeout:5e3})}})}))}));
