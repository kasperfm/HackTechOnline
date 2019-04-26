<script type="text/javascript" src="{{ $jsPath }}logreader.js?v={{ useJSCache() }}"></script>

<label for="select-log-category">Local logs: </label>
<select name="select-log-category" id="select-log-category">
    <option value="null" disabled selected>Select a category...</option>
    <option value="gateway">Gateway</option>
    <option value="files">File actions</option>
    <option value="system">System</option>
</select>