jQuery(document).ready(function(e){e("#fileinspector_filetree").jaofiletree({script:"/game/module/FileViewer/ajax/list",onclick:function(t,i,n,o){var c=n;c.substring(1,c.length-1);e.ajax({type:"POST",dataType:"json",cache:!1,url:"/game/module/FileViewer/ajax/open",data:{_token:window.Laravel.csrfToken,fid:o},success:function(t){!0===t.result?!1===t.encrypted?"image"===t.filetype?(e(".fileinspector_div").css("background-image","url('"+wwwRoot+t.content+"')"),e(".fileinspector_div").show(),e(".fileinspector_filecontent").hide()):(e(".fileinspector_filecontent").text(t.content),e(".fileinspector_div").hide(),e(".fileinspector_filecontent").show()):(e(".fileinspector_filecontent").text(""),e.notification({title:"File Inspector",icon:"b",color:"#fff",content:"The selected file is encrypted!",timeout:4e3})):e(".fileinspector_filecontent").text("")}})}})});
