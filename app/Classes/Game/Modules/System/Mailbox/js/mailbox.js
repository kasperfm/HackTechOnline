$("#email-view-dialog").dialog({
    modal: true,
    autoOpen: false,
    width: 560,
    height: 320,
    buttons: {
        Close: function() {
            $( this ).dialog( "close" );
        }
    }
});

$(".email-inbox-linkbtn").click(function(){
    loadInbox();
});

function loadInbox(){
    $.ajax({
        type: 'POST',
        dataType: 'json',
        cache: false,
        url: '/game/module/mailbox/ajax/loadInbox',
        data: {
            _token: window.Laravel.csrfToken
        },
        success: function(response) {
            $('#email-list-tab').html(response.view);
            inboxFunctions();
        }
    });
}

$(document).ready(function() {
    loadInbox();
    $("#email-tabs").tabs();
    inboxFunctions();

    $("#sendmail-form").bind("submit", function(e){
        if($("#mailsubject").val() !== undefined && $("#mailsubject").val() !== "" && $("#userto").val() !== undefined && $("#userto").val() !== "" && $("#mailcontent").val() !== undefined && $("#mailcontent").val() !== ""){
            $.ajax({
                type: 'POST',
                dataType: 'json',
                cache: false,
                url: '/game/module/mailbox/ajax/send',
                data: {
                    _token: window.Laravel.csrfToken,
                    userto: $("#userto").val(),
                    mailsubject: $("#mailsubject").val(),
                    mailcontent: $("#mailcontent").val()
                },
                success: function(response){
                    if(response.result === true) {
                        $.notification(
                            {
                                title: 'Mailbox',
                                icon: 'b',
                                color: '#fff',
                                content: "Your email has been sent!" ,
                                timeout: 4000
                            }
                        );

                        $(this).closest('form').find("input[type=text], textarea").val("");
                    }else{
                        $.notification(
                            {
                                title: 'Mailbox',
                                icon: 'b',
                                color: '#fff',
                                content: 'Something went wrong when trying to send the e-mail!<br />Be sure no fields are empty, and you entered a correct username. And remember you can only send one email every 30sec to avoid spam.',
                                timeout: 4000
                            }
                        );
                    }
                }
            });
        }else{
            $.notification(
                {
                    title: 'Mailbox',
                    icon: 'b',
                    color: '#fff',
                    content: 'Something went wrong when trying to send the e-mail!<br />Be sure no fields are empty, and you entered a correct username.' ,
                    timeout: 4000
                }
            );
        }

        e.preventDefault();
    });
});

function inboxFunctions(){
    $(".email-delete-btn").click(function(e){
        $.ajax({
            type: 'POST',
            dataType: 'json',
            cache: false,
            url: '/game/module/mailbox/ajax/delete',
            data: {
                _token: window.Laravel.csrfToken,
                mailid: $(this).attr("rel")
            },
            success: function(response){
                if(response.result === true) {
                    loadInbox();
                }else{
                    $.notification(
                        {
                            title: 'Mailbox',
                            icon: 'b',
                            color: '#fff',
                            content: 'Unable to delete the e-mail message!',
                            timeout: 4000
                        }
                    );
                }
            }
        });
    });

    $(".email-reply-btn").click(function(e){
        var orig_msg;
        var orig_subject;

        if($(this).attr("rel") === 0){
            $.notification(
                {
                    title: 'Mailbox',
                    icon: 'b',
                    color: '#fff',
                    content: 'You are unable to reply to system messages.',
                    timeout: 4000
                }
            );
        }else{
            $.ajax({
                type: 'POST',
                dataType: 'json',
                cache: false,
                url: '/game/module/mailbox/ajax/getMessage',
                data: {
                    _token: window.Laravel.csrfToken,
                    mailid: $(this).attr("rel")
                },
                success: function(response){
                    if(response.result === true) {
                        orig_msg = response.message;
                        $("#userto").attr("value", response.from_username);
                        $("#mailsubject").attr("value", "Re: " + response.subject);
                        var selected = $("#email-tabs").tabs("option", "selected");
                        $("#email-tabs").tabs("option", "selected", selected + 1);
                        $("#email-tabs").tabs( "option", "active", selected + 1 );
                    }else{
                        $.notification(
                            {
                                title: 'Mailbox',
                                icon: 'b',
                                color: '#fff',
                                content: 'Something went wrong when trying to load the source e-mail!',
                                timeout: 4000
                            }
                        );
                    }
                }
            });
        }
    });

    $(".email-inbox-item").click(function(){
        var msg;
        var subject;
        var datestamp;

        $.ajax({
            type: 'POST',
            dataType: 'json',
            cache: false,
            url: '/game/module/mailbox/ajax/getMessage',
            data: {
                _token: window.Laravel.csrfToken,
                mailid: $(this).attr("rel")
            },
            success: function(response){
                if(response.result === true) {
                    msg = response.message;
                    subject = response.subject;
                    datestamp = response.date;

                    $("#email-view-dialog").parent().find("span.ui-dialog-title").html("E-Mail reader: " + subject);
                    $("#email-view-dialog").dialog('open');
                    $('.ui-dialog-buttonset button').addClass('btn');

                    $(".email-view-dialog-msgcontent").html(msg);
                    $(".email-view-dialog-msgdate").html("Received: " + datestamp);
                }else{
                    $.notification(
                        {
                            title: 'Mailbox',
                            icon: 'b',
                            color: '#fff',
                            content: 'Something went wrong when trying to load the e-mail content!',
                            timeout: 4000
                        }
                    );
                }
            }
        });

        loadInbox();
    });
}