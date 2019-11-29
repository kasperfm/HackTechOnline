jQuery(document).ready(function($) {
    $('#fileViewer-browse-local').click(function () {
        $('#hostAddress').val('');
        fileViewerHost = 0;
        $(".fileinspector_filetree").remove();
        $("#fileinspector_left").append('<div class="fileinspector_filetree"></div>');
        initFileTree();
    });

    $('#fileViewer-connect').click(function () {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            cache: false,
            url: '/game/module/FileViewer/ajax/connectToRemoteServer',
            data: {
                _token: window.Laravel.csrfToken,
                host: $('#hostAddress').val(),
                password: fileViewerHostPassword
            },
            success: function (response) {
                if (response.result === true) {
                    fileViewerHost = response.host;
                    $(".fileinspector_filetree").remove();
                    $("#fileinspector_left").append('<div class="fileinspector_filetree"></div>');
                    initFileTree();
                }else{
                    alert(response.message);
                }
            }
        });

    });

    function initFileTree() {
        $('.fileinspector_filetree').on("changed.jstree", function (e, data) {
            if (data.selected.length) {
                if (data.instance.get_node(data.selected[0]).original.fid) {
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
        }).jstree(
            {
                'core': {
                    "themes": {
                        "name": "default-dark",
                        "icons": true,
                        "url": "css/jstree/style.min.css"
                    },
                    "data": {
                        "url": "/game/module/FileViewer/get/list",
                        "data": {
                            _token: window.Laravel.csrfToken,
                            hostID: fileViewerHost,
                            hostPassword: fileViewerHostPassword,
                        },
                        "dataType": "json"
                    }
                },
                "plugins": [
                    "contextmenu", "wholerow"
                ],
                "contextmenu": {
                    "items": function () {
                        if (atob(fileViewerModuleVersion) <= 1.0) {
                            return false;
                        }

                        if (fileViewerHost == 0) {
                            return false;
                        }

                        var menuItems = {
                            "download": {
                                "separator_before": false,
                                "separator_after": false,
                                "label": "Download",
                                "action": function (data) {
                                    var inst = $.jstree.reference(data.reference);
                                    var obj = inst.get_node(data.reference);

                                    $.ajax({
                                        type: 'POST',
                                        dataType: 'json',
                                        cache: false,
                                        url: '/game/module/FileViewer/ajax/downloadFile',
                                        data: {
                                            _token: window.Laravel.csrfToken,
                                            fid: obj.original.fid,
                                            server_password: fileViewerHostPassword
                                        },
                                        success: function (response) {
                                            if (response.result === true) {
                                                alert('Downloaded: ' + obj.text);
                                            } else {
                                                alert('DOWNLOAD FAILED');
                                            }
                                        }
                                    });
                                }
                            }
                        };

                        return menuItems;
                    }
                }
            }
        );
    }

    initFileTree();
});