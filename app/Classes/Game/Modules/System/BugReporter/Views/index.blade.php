<div class="pane">
    <form class="bugreport-form" id="bugreport-form">
        <table cellspacing="10px">
            <tr>
                <td>
                    <label class="small_label">Subject</label>
                </td>
                <td>
                    <input type="text" name="bug_title" id="bug_title" style="width: 300px">
                </td>
            </tr>
            <tr>
                <td>
                    <label class="small_label">Category</label>
                </td>
                <td>
                    <select id="bug_category" name="bug_category" style="width: 317px">
                    @foreach($categories as $category)
                        @if($category->title == "Other")
                            <option selected="selected" value="{{ $category->id }}">{{ $category->title }}</option>
                        @else
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @endif
                    @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="small_label">Description</label>
                </td>
                <td>
                    <textarea name="bug_content" id="bug_content" cols="55" rows="7" style="width: 300px"></textarea>
                </td>
            </tr>
            <tr>
                <td>

                </td>
                <td>
                    <input class="btn" type="button" id="submit_bug" name="submit_bug" value="Report bug">
                </td>
            </tr>
        </table>
    </form>
</div>

<script type="text/javascript" src="{{ $jsPath }}bugreporter.js?v={{ md5(time()) }}"></script>
