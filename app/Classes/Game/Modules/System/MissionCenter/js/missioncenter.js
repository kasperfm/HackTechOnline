function viewCurrentMission(){
    selectMission(-1);
}

function acceptMission(mission) {
    $.ajax({
        context: this,
        type: 'POST',
        dataType: 'json',
        cache: false,
        url: '/game/module/MissionCenter/ajax/acceptMission',
        data: {
            _token: window.Laravel.csrfToken,
            missionId: mission
        },
        success: function(response){
            if(response.result === true) {
                $.notification({
                    title: 'Contract status',
                    icon: 'b',
                    timeout: 4500,
                    color: '#fff',
                    content: 'Contract \"'+response.title+'\" has been accepted !'
                });

                //$.getScript('/game/missions/dynamicjs');

                $(".mission_box").hide();
                $(".abortmission_btn").show();
                $(".currentmission_btn").show();
                $(".accept_mission_link").hide();
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
            var acceptHTMLContent;
            if(response.current === true){
                acceptHTMLContent = '';
            }else{
                acceptHTMLContent = '<br /><center><strong style="cursor: pointer; color: aqua;" class="flash animated infinite accept_mission_link" onclick="acceptMission('+mission+')">CLICK HERE TO ACCEPT THE CONTRACT</strong></center>';
            }

            var itemRewardContent;
            if(response.reward_item != null){
                itemRewardContent = '<br /><strong>Item reward:</strong> <span style="color: #fcff34;">' + response.reward_item.name + ' (' + response.reward_item.type +')</span>';

                if(response.reward_item.dropchance < 100){
                    itemRewardContent += '<br /><strong>Chance for item:</strong> <span style="color: #fcff34;">' + response.reward_item.dropchance + '%</span>';
                }
            }else{
                itemRewardContent = '';
            }

            if(response.title) {
                $.notification(
                    {
                        title: response.title,
                        icon: 'b',
                        color: '#fff',
                        content: '<strong>Corporation:</strong> <span style="color: #fcff34;">' + response.corp_name + '</span>' +
                            '<br /><strong>Trust points:</strong> <span style="color: #fcff34;">' + response.reward_trust + '</span>' +
                            '<br /><strong>Credits reward:</strong> <span style="color: #fcff34;">$' + response.reward_credits + '</span>' +
                            itemRewardContent +
                            '<br /><strong>Task:</strong> ' + response.description +
                            '<br />' +
                            acceptHTMLContent
                    }
                );
            }
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
            if(response === true) {
                $.notification(
                    {
                        title: 'Contract aborted',
                        icon: 'c',
                        timeout: 4500,
                        color: '#fff',
                        content: 'Your current contract has been cancelled !'
                    }
                );

                $(".mission_box").show();
                $(".abortmission_btn").hide();
                $(".currentmission_btn").hide();
            }
        }
    });
}

$(document).ready(function() {
    $(".wnd_missioncenter").height("auto");

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
                }else{
                    $(".mission_list").html('<li>No missions available...</li>');
                }

                $(".mission-limit-wrapper").animate({
                    height:$(".mission_list").height() + 5
                },600);

                $(".wnd_missioncenter").height("auto");
            }
        });
    });
});