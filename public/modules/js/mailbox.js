function loadInbox(){$.ajax({type:"POST",dataType:"json",cache:!1,url:"/game/module/Mailbox/ajax/loadInbox",data:{_token:window.Laravel.csrfToken},success:function(e){$("#email-list-tab").html(e.view),inboxFunctions()}})}function inboxFunctions(){$(".email-delete-btn").click(function(e){$.ajax({type:"POST",dataType:"json",cache:!1,url:"/game/module/Mailbox/ajax/delete",data:{_token:window.Laravel.csrfToken,mailid:$(this).attr("rel")},success:function(e){!0===e.result?loadInbox():$.notification({title:"Mailbox",icon:"b",color:"#fff",content:"Unable to delete the e-mail message!",timeout:4e3})}})}),$(".email-reply-btn").click(function(e){var t;0===$(this).attr("rel")?$.notification({title:"Mailbox",icon:"b",color:"#fff",content:"You are unable to reply to system messages.",timeout:4e3}):$.ajax({type:"POST",dataType:"json",cache:!1,url:"/game/module/Mailbox/ajax/getMessage",data:{_token:window.Laravel.csrfToken,mailid:$(this).attr("rel")},success:function(e){if(!0===e.result){t=e.message,$("#userto").attr("value",e.from_username),$("#mailsubject").attr("value","Re: "+e.subject);var a=$("#email-tabs").tabs("option","selected");$("#email-tabs").tabs("option","selected",a+1),$("#email-tabs").tabs("option","active",a+1)}else $.notification({title:"Mailbox",icon:"b",color:"#fff",content:"Something went wrong when trying to load the source e-mail!",timeout:4e3})}})}),$(".email-inbox-item").click(function(){var e,t,a;$.ajax({type:"POST",dataType:"json",cache:!1,url:"/game/module/Mailbox/ajax/getMessage",data:{_token:window.Laravel.csrfToken,mailid:$(this).attr("rel")},success:function(o){!0===o.result?(e=o.message,t=o.subject,a=o.date,$("#email-view-dialog").parent().find("span.ui-dialog-title").html("E-Mail reader: "+t),$("#email-view-dialog").dialog("open"),$(".ui-dialog-buttonset button").addClass("btn"),$(".email-view-dialog-msgcontent").html(e),$(".email-view-dialog-msgdate").html("Received: "+a)):$.notification({title:"Mailbox",icon:"b",color:"#fff",content:"Something went wrong when trying to load the e-mail content!",timeout:4e3})}}),loadInbox()})}$("#email-view-dialog").dialog({modal:!0,autoOpen:!1,width:560,height:320,buttons:{Close:function(){$(this).dialog("close")}}}),$(".email-inbox-linkbtn").click(function(){loadInbox()}),$(document).ready(function(){loadInbox(),$("#email-tabs").tabs(),inboxFunctions(),$("#sendmail-form").bind("submit",function(e){void 0!==$("#mailsubject").val()&&""!==$("#mailsubject").val()&&void 0!==$("#userto").val()&&""!==$("#userto").val()&&void 0!==$("#mailcontent").val()&&""!==$("#mailcontent").val()?$.ajax({type:"POST",dataType:"json",cache:!1,url:"/game/module/Mailbox/ajax/send",data:{_token:window.Laravel.csrfToken,userto:$("#userto").val(),mailsubject:$("#mailsubject").val(),mailcontent:$("#mailcontent").val()},success:function(e){!0===e.result?($.notification({title:"Mailbox",icon:"b",color:"#fff",content:"Your email has been sent!",timeout:4e3}),$(this).closest("form").find("input[type=text], textarea").val("")):$.notification({title:"Mailbox",icon:"b",color:"#fff",content:"Something went wrong when trying to send the e-mail!<br />Be sure no fields are empty, and you entered a correct username. And remember you can only send one email every 30sec to avoid spam.",timeout:4e3})}}):$.notification({title:"Mailbox",icon:"b",color:"#fff",content:"Something went wrong when trying to send the e-mail!<br />Be sure no fields are empty, and you entered a correct username.",timeout:4e3}),e.preventDefault()})});