$(document).ready(function(){$(".noEnterSubmit").keypress(function(s){13==s.which&&($("#scan-submit").click(),s.preventDefault())}),$("#scan-submit").click(function(){$.ajax({type:"POST",dataType:"json",cache:!1,url:"/game/module/portscanner/ajax/scan",data:{_token:window.Laravel.csrfToken,address:$("#scan-address").val()},success:function(s){!0===s.answer?!1!==s.scanresults?($("#portscan-results").html("<li>Scan results:</li>"),$.each(s.scanresults,function(s,n){$("#portscan-results").append("<li>"+n.port+" - "+n.name+"</li>")})):$("#portscan-results").html("<li>No open ports found!</li>"):$("#portscan-results").html("<li>Target not found!</li>")}})})});