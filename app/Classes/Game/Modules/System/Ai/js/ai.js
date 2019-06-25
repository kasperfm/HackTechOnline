var runner = new bondage.Runner();
var displayArea;
var dialogue;
var dialogueIterator;
var optNum = 0;

function loadAI(jsonFilename) {
    displayArea = document.getElementById('ai_speak');
    if(!displayArea){
        return false;
    }
    fetch("vfs/dialog/ai/"+jsonFilename+".json").then(response => response.json()).then(json => initDialog(json));
}

function initDialog(json) {
    displayArea.innerHTML = '';

    dialogue = new bondage.Runner();

    if (json != null) {
       // var data = JSON.parse(json);
        dialogue.load(json);
        dialogueIterator = dialogue.run('Start');
        stepDialog();
    }
}

function stepDialog() {
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
        stepDialog();
    });
}

$(document).ready(function() {
    loadAI('demo');
});
