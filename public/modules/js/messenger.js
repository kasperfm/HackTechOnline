function setChatSize(){$("#send-message").css("width",$("#wnd_messenger").width()-40+"px")}$(document).ready(function(){setChatSize(),$("#wnd_messenger").bind("dialogresize",function(n,e){setChatSize()});var n=io.connect(backendServer,{"force new connection":!0}),e=($("#nickError"),$("#nickname"),$("#users")),s=$("#send-message"),a=$("#message"),c=$("#chat");n.on("connecting",function(n){c.append('<li><span class="msg">Connecting to chat service...</span></li>')}),n.on("connect",function(n){c.append('<li><span class="msg">Connected!</span></li>')}),n.emit("new user",username,function(){}),n.on("usernames",function(n){var s="<h1>USERS:</h1>";for(i=0;i<n.length;i++)s+='<span class="wuser">'+n[i]+"</span><br />";e.html(s),$(".wuser").click(function(){a.val("/w "+$(this).html()+" "),a.focus()})}),s.submit(function(e){""!=a.val()&&(n.emit("send message",a.val(),function(n){c.append('<span class="error">'+n+"</span><br/>")}),a.val("")),e.preventDefault()}),n.on("new message",function(n){c.append('<li><span class="msg"><b>'+n.nick+": </b>"+$("<span>"+n.msg+"</span>").text()+"</span></li>"),$("#chatBox").animate({scrollTop:$("#chatBox")[0].scrollHeight},1e3)}),n.on("whisper",function(n){c.append('<li><span class="whisper"><b>'+n.nick+": </b>"+$("<span>"+n.msg+"</span>").text()+"</span></li>"),$("#chatBox").animate({scrollTop:$("#chatBox")[0].scrollHeight},1e3)}),$("#wnd_messenger").dialog({autoOpen:!0}).bind("dialogbeforeclose",function(e,s){n.emit("disconnect",function(n){}),n.disconnect()})});