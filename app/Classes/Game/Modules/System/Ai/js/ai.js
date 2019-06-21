var runner = new bondage.Runner();
var displayArea;
var dialogue;
var dialogueIterator;
var optNum = 0;

function initDialog(json) {
    displayArea.innerHTML = '';

    dialogue = new bondage.Runner();

    if (json != null) {
       // var data = JSON.parse(json);
        dialogue.load(json);
        dialogueIterator = dialogue.run('Start');
        step();
    }
}

function step() {
    $("#ai_responses").empty();
    // Steps until an options result
    while(true) {
        var iter = dialogueIterator.next();
        if (iter.done) {
            break;
        }

        var result = iter.value;
        if (result instanceof bondage.OptionsResult) {
            showOptions(result);
            break;
        } else {
            $("#ai_speak").text(result.text);
        }
    }
}

function showOptions(result) {
    //$("#ai_responses").empty();
    displayArea.innerHTML += '<br/>';
    for (var i = 0; i < result.options.length; i++) {
        $("#ai_responses").append('<li rel="'+i+'" class="ai_respond ai_response-'+optNum+'">&gt; '+result.options[i]+'</li>');
    }

    $(".ai_response-"+optNum).on("click", function() {
        var rel = $(this).attr('rel');
        result.select(rel);
        optNum++;
        step();
    });
}

$(document).ready(function() {
    displayArea = document.getElementById('ai_speak');
    fetch("vfs/dialog/ai/demo.json").then(response => response.json()).then(json => initDialog(json));
});
