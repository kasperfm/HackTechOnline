<link rel="stylesheet" href="{{ $cssPath }}ai.css" type="text/css" />

<div style="background-color: black;">
    @if(currentPlayer()->aiStatus == 1)
        <canvas id="ai-canvas"></canvas>
        <script>
            glitch("ai-canvas", "img/ai/ai01_still.png");
        </script>
    @elseif(currentPlayer()->aiStatus == 2)
        <img src="img/ai/ai01.gif" style="pointer-events: none;" id="ai_avatar" alt="AI" /><br />
    @endif
</div>

<div><tt id="ai_speak"></tt></div>
<ul id="ai_responses">

</ul>

<script type="text/javascript" src="js/bondage.js?v={{ useJSCache() }}"></script>
<script type="text/javascript" src="{{ $jsPath }}ai.js?v={{ useJSCache() }}"></script>