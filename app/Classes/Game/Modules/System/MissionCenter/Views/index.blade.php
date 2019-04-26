<div class="pane small_label">
    <form>
        Corporation:
        <select class="selectcorp">
            @if(count($corporations) == 0)
                <option value="0">None available!</option>
            @else
                @foreach($corporations as $corp)
                <option value="{{ $corp->id }}">{{ $corp->name }}</option>
                @endforeach
            @endif
        </select> <img class="corp_info_btn" style="cursor: pointer; margin-bottom: -5px;" src="img/icon-info.png" height="18px" width="18px" />
    </form>

    @if($currentMission)
        <div class="abortmission_btn text-red small_label"><br /><center><strong style="cursor: pointer;" onclick="abortMission();">[ ABORT CURRENT MISSION ]</strong></center></div>
        <div class="currentmission_btn text-green small_label"><br /><center><strong style="cursor: pointer;" onclick="viewCurrentMission();">[ VIEW MISSION INFO ]</strong></center></div>
    @else
        <div class="abortmission_btn text-red small_label" style="display: none;"><br /><center><strong style="cursor: pointer;" onclick="abortMission();">[ ABORT CURRENT MISSION ]</strong></center></div>
        <div class="currentmission_btn text-green small_label" style=" display: none;"><br /><center><strong style="cursor: pointer;" onclick="viewCurrentMission();">[ VIEW MISSION INFO ]</strong></center></div>
    @endif
</div>

@if(!$currentMission)
<div class="pane mission_box mission-limit-wrapper" style="margin-top: 5px; margin-bottom: 5px; height: auto; overflow: auto;">
@else
    <div class="pane mission_box mission-limit-wrapper" style="margin-top: 5px; margin-bottom: 5px; height: auto; overflow: auto; display: none;">
 @endif
    <ul class="mission_list">
        <li>No missions available...</li>
    </ul>
</div>


<script type="text/javascript" src="{{ $jsPath }}missioncenter.js?v={{ useJSCache() }}"></script>