function initSWShop(){$(".sw_shop_goback").click(function(){$.ajax({type:"POST",dataType:"json",cache:!1,url:"/game/module/softwaremarket/ajax/overview",data:{_token:window.Laravel.csrfToken},success:function(e){$("#softwaremarket-content").html(e.view)}})}),$(".buy-app").click(function(){var e=$(this).attr("value"),a=$(this).attr("rel");$.ajax({type:"POST",dataType:"json",cache:!1,url:"/game/module/softwaremarket/ajax/buy",data:{_token:window.Laravel.csrfToken,appId:e,appVersion:a},success:function(e){!0===e.purchase?(updateCredits(),$.notification({title:"Software Market",icon:"c",color:"#fff",timeout:4e3,content:"Software purchase successful !"}),$.ajax({type:"POST",dataType:"json",cache:!1,url:"/game/module/softwaremarket/ajax/overview",data:{_token:window.Laravel.csrfToken},success:function(e){$("#softwaremarket-content").html(e.view)}})):$.notification({title:"Software Market",icon:"c",color:"#fff",timeout:4e3,content:"You don't have enough money to purchase this software !"})}})})}$(document).ready(function(){$(".info-app").click(function(){var e=$(this).parent().attr("rel"),a=$(this).attr("rel");$.ajax({type:"POST",dataType:"json",cache:!1,url:"/game/module/softwaremarket/ajax/item",data:{_token:window.Laravel.csrfToken,appName:e,appVersion:a},success:function(e){$("#softwaremarket-content").html(e.view),initSWShop()}})})});