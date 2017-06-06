$(document).ready(function() {
    $(".hw_item").hover(function() {
        var name = $(this).attr("rel");
        $(".hw_"+name).stop(true, true).removeClass("text-pink").addClass("text-blue");
        $(".val_"+name).stop(true, true).addClass("text-blue");
    }, function() {
        var name = $(this).attr("rel");
        $(".hw_"+name).stop(true, true).removeClass("text-blue").addClass("text-pink");
        $(".val_"+name).stop(true, true).removeClass("text-blue");
    });

    /*
    $(".hw_item").click(function() {
        var name = $(this).attr("rel");

        $.ajax({
            type: 'POST',
            dataType: 'json',
            cache: false,
            url: modulePath + 'ajax/loadshop.php',
            data: {
                hwtype: name
            },
            success: function(response) {
                if(response.answer) {
                    $("#mygateway-wrapper").html(response.view);
                }
            }
        });
    });*/
});
