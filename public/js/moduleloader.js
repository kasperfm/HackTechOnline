function loadModule(e){$.ajax({type:"POST",dataType:"json",cache:!1,url:"/game/ajax/module/load",data:{modname:e,_token:window.Laravel.csrfToken},success:function(a){!0===a.answer&&($(".window_wrapper").append('<div id="wnd_'+e+'" class="dialog_window wnd_'+e+'" title="'+a.title+'"></div>'),$("#wnd_"+e).html(a.view),$("#wnd_"+e).dialog({appendTo:".window_wrapper",width:a.width,height:a.height,hide:{effect:window.closeEffect,duration:window.closeDuration},close:function(a,o){unloadModule(e),$("#wnd_"+e).remove()},focus:function(e,a){$(this).dialog("moveToTop")}}),$("#wnd_"+e).dialog("widget").draggable("option","containment","#window_wrapper"),updateResourceBars())}})}function unloadModule(e){$.ajax({type:"POST",dataType:"json",cache:!1,data:{modname:e,_token:window.Laravel.csrfToken},url:"/game/ajax/module/unload",success:function(e){!0===e.answer&&updateResourceBars()}})}function setResourceBar(e,a){$(".res_"+e+"_bar").progressbar("option","value",a)}function updateResourceBars(){$.ajax({type:"POST",dataType:"json",cache:!1,data:{_token:window.Laravel.csrfToken},url:"/game/ajax/getresources",success:function(e){!0===e.answer&&(setResourceBar("cpu",e.cpu),setResourceBar("ram",e.ram),setResourceBar("hdd",e.hdd))}})}function updateApplicationMenu(){$.ajax({type:"POST",dataType:"json",cache:!1,data:{_token:window.Laravel.csrfToken},url:"/game/ajax/module/list",success:function(e){!0===e.answer&&($("#appmenu").html(e.content),""!=$("#appmenu").html()?$(".applications-menu").css("color","white"):$(".applications-menu").css("color","#4b4b4b"),$(".exec").unbind("click"),$(".exec").click(function(){loadModule($(this).attr("rel"))}))}})}$(document).ready(function(){$(".res_meter").progressbar(),updateResourceBars(),$(".exec").click(function(){loadModule($(this).attr("rel"))})});