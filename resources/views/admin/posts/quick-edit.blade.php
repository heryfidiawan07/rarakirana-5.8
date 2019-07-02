<form method="POST" action="/admin/post/{{$post->id}}/quict-edit">
    @csrf
    <div class="form-row">
        <td>
            <label for="tags" class="small">Tags <a href="/admin/tags">Create</a></label>
            <div style="max-height: 70px; overflow-x: auto;">
            @foreach ($tags as $tag)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="{{$tag->id}}" id="tags" name="tags[]">
                    <label class="form-check-label" for="tags">{{$tag->name}}</label>
                </div>
            @endforeach
            </div>
        </td>
        <td>
            <label for="comment" class="small">Comment</label>
            <select class="form-control form-control-sm" name="comment" id="comment">
                @if ($post->comment==1)
                    <option value="1">Yes</option>
                @endif
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>
        </td>
        <td colspan="2">
            <label for="menu_id" class="small">Parent Menu</label>
            <select class=" form-control form-control-sm" name="menu_id" id="menu_id">
                <option value="{{$post->menu->id}}" class="form-control">{{$post->menu->name}}</option>
                @foreach ($menus as $menu)
                    @if ($menu->childs->count())
                        @continue
                    @endif
                    <option value="{{$menu->id}}" class="from-control">{{$menu->name}}</option>
                @endforeach
            </select>
        </td>
        <td colspan="2">
            <label for="sticky" class="small">Sticky Post</label>
            <select class="form-control form-control-sm" name="sticky" id="sticky">
                @if ($post->sticky==1)
                    <option value="1">Yes</option>
                @endif
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>
        </td>
        <td colspan="2">
            <label for="status" class="small">Status</label>
            <select class="form-control form-control-sm" name="status" id="status">
                @if ($post->status==0)
                    <option value="0">Draft</option>
                @endif
                <option value="1">Publish</option>
                <option value="0">Draft</option>
            </select>
        </td>
        <td>
            <label for="update" class="small">Update</label>
            <input type="submit" class="form-control btn btn-warning btn-sm" id="update" value="Update">
        </td>
    </div>
</form>