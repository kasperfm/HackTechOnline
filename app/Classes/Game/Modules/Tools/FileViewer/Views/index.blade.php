<link rel="stylesheet" type="text/css" href="{{ $cssPath }}fileviewer.css" />

<script type="text/javascript" src="js/jstree.min.js"></script>

<script>
    var fileViewerHost = 0;
    var fileViewerHostPassword = null;
    var fileViewerModuleVersion = "{{ base64_encode($moduleVersion) }}";
</script>

<script type="text/javascript" src="{{ $jsPath }}fileviewer.js"></script>

@if($moduleVersion >= 1.1)
<div id="fileinspector_top" class="container">
    <div class="row">
        <div class="col">
           <span>Host address:</span><br><input type="text" style="display:table-cell; width:98%" id="hostAddress" name="hostAddress">
        </div>

        <div class="col"><br>
            <button id="fileViewer-connect" name="fileViewer-connect" class="btn_small">Connect</button> <button id="fileViewer-browse-local" name="fileViewer-browse-local" style="width: 140px" class="btn_small text-yellow">Browse local</button>
        </div>
    </div>
</div>
@endif

<div class="container" style="height: 88%;">
    <div class="row" style="height: 97%;">
        <div id="fileinspector_left" class="col-4">
                <div class="fileinspector_filetree"></div>
        </div>

        <div id="fileinspector_right" class="col-8">
            <div class="fileinspector_div"></div>
            <textarea class="fileinspector_filecontent"></textarea>
        </div>
    </div>
</div>

<div id="server_prompt_password_window" class="dialog_window" title="Enter Password">
    @include('Modules::Tools.FileViewer.Views.password')
</div>