$(document).ready(function(){$("#select-log-category").change(function(){var e=$(this).val();$.ajax({type:"POST",dataType:"json",cache:!1,url:"/game/module/LogReader/ajax/list",data:{_token:window.Laravel.csrfToken,logtype:e},success:function(e){!0===e.answer&&$(".log-reader-display").html(e.view)}})})});