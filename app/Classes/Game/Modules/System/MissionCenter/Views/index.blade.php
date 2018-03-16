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
    <div class="abortmission_btn text-red small_label"><br /><center><strong style="cursor: pointer;" onclick="abortMission();">[ ABORT CURRENT MISSION ]</strong></center></div>
    <div class="currentmission_btn text-green small_label"><br /><center><strong style="cursor: pointer;" onclick="viewCurrentMission();">[ VIEW MISSION INFO ]</strong></center></div>
</div>