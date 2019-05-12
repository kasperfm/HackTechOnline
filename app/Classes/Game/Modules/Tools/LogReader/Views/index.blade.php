<script type="text/javascript" src="{{ $jsPath }}logreader.js?v={{ useJSCache() }}"></script>
<link rel="stylesheet" href="{{ $cssPath }}logreader.css" type="text/css" />

<div class="pane">
    <label for="select-log-category">Local logs: </label>
    <select name="select-log-category" id="select-log-category">
        <option value="null" disabled selected>Select a category...</option>
        <option value="gateway">Gateway</option>
        <option value="filetransfer">File actions</option>
    </select>
</div>

<div class="pane log-reader-display" style="margin-top: 10px;">
    <ul>
        <li>You have to select a category, to display any logs.</li>
    </ul>
</div>