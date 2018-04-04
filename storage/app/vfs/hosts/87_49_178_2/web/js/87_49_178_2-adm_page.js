$(document).ready(function() {
    $(".restricted_btn").bind("click", function(){
        var origText = $(this).attr("value");
        var thisObj = $(this);

        $(this).attr("value", "PERMISSION DENIED");
        window.setTimeout(function() {
            ChangeButtonLabel(thisObj, origText);
        }, 1000);
    });
    
    $(".download_config_btn").bind("click", function(){
        var rel = $(this).attr("rel");

        $.ajax({
            type: 'POST',
            dataType: 'json',
            cache: false,
            url: '/game/web/87_49_178_2/ajax/admDownload',
            data: {
                file: rel
            },
            success: function(response) {           
                if(response.answer === true) {
                    parent.$.notification({ 
                        title: 'Download complete!',
                        icon: 'b',
                        timeout: 4000,
                        color: '#fff',
                        content: 'The file: ' + response.filename + ' has been downloaded!'
                    });
                }
            }
        });
    });
    
    function ChangeButtonLabel(obj, text){
        obj.attr("value", text);
    }
});