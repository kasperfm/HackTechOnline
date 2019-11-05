jQuery(document).ready(function($) {
    $('#fileinspector_filetree').on("changed.jstree", function (e, data) {
        if(data.selected.length) {
            if(data.instance.get_node(data.selected[0]).original.fid) {
                var fileid = data.instance.get_node(data.selected[0]).original.fid;

                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    cache: false,
                    url: '/game/module/FileViewer/ajax/open',
                    data: {
                        _token: window.Laravel.csrfToken,
                        fid: fileid
                    },
                    success: function (response) {
                        if (response.result === true) {
                            if (response.encrypted === false) {
                                if (response.filetype === "image") {
                                    //$('.fileinspector_image').attr("src", wwwRoot + response.content);
                                    $('.fileinspector_div').css("background-image", "url('" + wwwRoot + response.content + "')");
                                    $('.fileinspector_div').show();
                                    $('.fileinspector_filecontent').hide();
                                } else {
                                    $('.fileinspector_filecontent').text(response.content);
                                    $('.fileinspector_div').hide();
                                    $('.fileinspector_filecontent').show();
                                }
                            } else {
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
                        } else {
                            $('.fileinspector_filecontent').text('');
                        }
                    }
                });
            }
        }
    }).jstree({
        'core' : {
            "themes" : {
                "icons" : true,
                "url" : "css/jstree/style.min.css"
            },
            "data" : {
                "url" : "/game/module/FileViewer/get/list",
                "dataType" : "json"
            }
        }
    });
});