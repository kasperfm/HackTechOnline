webpackJsonp([6,7],{12:function(n,o,e){(function(n){function o(){n("#window_wrapper").css("height",n(window).height()-44+"px")}function e(){n.ajax({type:"POST",dataType:"json",cache:!1,data:{_token:window.Laravel.csrfToken},url:"/game/ajax/economy/getcredits",success:function(o){o.answer===!0&&n(".credits-display").html("$ "+o.credits)}})}var i="scale";n(document).ready(function(){n(".menubar-item").hover(function(){n(this).find("ul").stop(!0,!0).fadeIn("fast")},function(){n(this).find("ul").stop(!0,!0).fadeOut("fast")}),n(".menubar-item").find("li").click(function(n){n.stopPropagation()}),n(".credits-display").click(function(){e()}),n("#demo_window").dialog({width:945,height:570,autoOpen:!0,hide:{effect:i,duration:225},close:function(o,e){n(this).remove()}}),n("#demo_window").dialog("widget").draggable("option","containment","#window_wrapper"),o(),n(window).resize(function(){o()}),n(".logout-btn").on("click",function(){window.location.href="/logout"}),e(),n("body").css("display","none"),n("body").fadeIn(3e3),n("#footer").fadeIn(3e3),n("#top-wrapper").fadeIn(3e3),window.closeEffect=i,window.closeDuration=225})}).call(o,e(1))},40:function(n,o,e){n.exports=e(12)}},[40]);