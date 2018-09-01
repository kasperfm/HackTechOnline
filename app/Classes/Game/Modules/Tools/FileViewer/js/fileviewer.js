jQuery(document).ready(function($) {
    $('#fileinspector_filetree').jaofiletree({
        script  : '/game/module/fileviewer/ajax/list',
        onclick : function(elem,type,file,fileid){
            var filename_tmp = file;
            var filename = filename_tmp.substring(1, filename_tmp.length-1);

            $.ajax({
                type: 'POST',
                dataType: 'json',
                cache: false,
                url: '/game/module/fileviewer/ajax/open',
                data: {
                    _token: window.Laravel.csrfToken,
                    fid: fileid
                },
                success: function(response){
                    if(response.result === true){
                        if(response.encrypted === false) {
                            if(response.filetype === "image"){
                                //$('.fileinspector_image').attr("src", wwwRoot + response.content);
                                $('.fileinspector_div').css("background-image", "url('" + wwwRoot + response.content + "')");
                                $('.fileinspector_div').show();
                                $('.fileinspector_filecontent').hide();
                            }else{
                                $('.fileinspector_filecontent').text(response.content);
                                $('.fileinspector_div').hide();
                                $('.fileinspector_filecontent').show();
                            }
                        }else{
                            $('.fileinspector_filecontent').text('');
                            $.notification(
                                {
                                    title: 'File Inspector',
                                    icon: 'b',
                                    color: '#fff',
                                    content: 'The selected file is encrypted!',
                                    timeout: 4000
                                }
                            );
                        }
                    }else{
                        $('.fileinspector_filecontent').text('');
                    }
                }
            });

        }
    });
});