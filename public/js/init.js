webpackJsonp([6,7],{12:function(n,i,o){(function(n){function i(){n("#window_wrapper").css("height",n(window).height()-44+"px")}n(document).ready(function(){n(".menubar-item").hover(function(){n(this).find("ul").stop(!0,!0).fadeIn("fast")},function(){n(this).find("ul").stop(!0,!0).fadeOut("fast")}),n(".menubar-item").find("li").click(function(n){n.stopPropagation()}),n("#demo_window").dialog({width:945,height:570,autoOpen:!0,hide:{effect:"scale",duration:225},close:function(i,o){n(this).remove()}}),n("#demo_window").dialog("widget").draggable("option","containment","#window_wrapper"),i(),n(window).resize(function(){i()}),n("body").css("display","none"),n("body").fadeIn(3e3)})}).call(i,o(1))},40:function(n,i,o){n.exports=o(12)}},[40]);