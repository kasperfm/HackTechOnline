function viewCurrentMission(){

}

function acceptMission(mission) {
    $.ajax({
        context: this,
        type: 'POST',
        dataType: 'json',
        cache: false,
        url: '/game/module/MissionCenter/ajax/acceptMission',
        data: {
            missionId: mission
        },
        success: function(response){
            if(response.result === true) {
                $.notification({
                    title: 'Mission status',
                    icon: 'b',
                    timeout: 4500,
                    color: '#fff',
                    content: 'Mission \"'+response.title+'\" has been accepted !'
                });

                //$.getScript('/game/missions/dynamicjs');

                $( ".abortmissionbtn" ).slideDown( "slow", function(){});
                $( ".currentmissionbtn" ).slideDown( "slow", function(){});
            }
        }
    });
}

function selectMission(mission) {
    $.ajax({
        type: 'POST',
        dataType: 'json',
        cache: false,
        url: '/game/module/MissionCenter/ajax/getMissionInfo',
        data: {
            _token: window.Laravel.csrfToken,
            missionId: mission
        },
        success: function(response){
            $.notification(
                {
                    title: response.title,
                    icon: 'b',
                    color: '#fff',
                    content: '<strong>Corporation:</strong> ' + response.corp_name +
                    '<br /><strong>Trust points:</strong> ' + response.reward_trust +
                    '<br /><strong>Credits reward:</strong> $' + response.reward_credits +
                    '<br /><strong>Mission:</strong> ' + response.description +
                    '<br />' +
                    '<br /><center><strong style="cursor: pointer;" onclick="acceptMission('+mission+')">CLICK HERE TO ACCEPT THE MISSION</strong></center>'
                }
            );
        }
    });
}

function abortMission() {
    $.ajax({
        type: 'POST',
        dataType: 'json',
        cache: false,
        url: '/game/module/MissionCenter/ajax/abortMission',
        data: {
            _token: window.Laravel.csrfToken
        },
        success: function(response){
            if(response.length > 0) {
                $.notification(
                    {
                        title: 'Mission aborted',
                        icon: 'c',
                        color: '#fff',
                        content: 'Your current mission has been aborted!'
                    }
                );
            }
        }
    });
}

$(document).ready(function() {
    $(".corp_info_btn").click(function(e){
        $.ajax({
            type: 'POST',
            dataType: 'json',
            cache: false,
            url: '/game/module/MissionCenter/ajax/getCorporationInfo',
            data: {
                _token: window.Laravel.csrfToken,
                corpId: $('.selectcorp').val()
            },
            success: function(response){
                if(!response) {
                    alert('Please select a corporation!');
                }else{
                    $.notification(
                        {
                            title: response.name,
                            icon: 'b',
                            color: '#fff',
                            content: response.description
                        }
                    );
                }
            }
        });
    });

    $(".selectcorp").change(function(){
        var corp_info = $(".selectcorp").val();
        $.ajax({
            context: this,
            type: 'POST',
            dataType: 'json',
            cache: false,
            url: '/game/module/MissionCenter/ajax/getMissionList',
            data: {
                _token: window.Laravel.csrfToken,
                corpId: corp_info
            },
            success: function(response){
                if(response.result === true) {
                    $(".mission_list").html('');
                    $.each(response.missions, function(index,value) {
                        $(".mission_list").append('<li class="new_mission" style="cursor: pointer;" onclick="selectMission('+value.id+')" rel="'+value.id+'">' + value.title + '</li>');
                    });

                    $(".mission-limit-wrapper").animate({
                        height:$(".mission_list").height() + 5
                    },600);

                    $(".wnd_missioncenter").height("auto");

                }
            }
        });
    });
});