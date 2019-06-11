<form method="POST" action="/admin/post/{{$post->id}}/quict-edit">
    @csrf
    <div class="form-row">
        <div class="col-md-2">
            <label for="menu_id">Parent Menu</label>
            <select class=" form-control form-control-sm" name="menu_id" id="menu_id">
                <option value="{{$post->menu->id}}" class="form-control">{{$post->menu->name}}</option>
                @foreach ($menus as $menu)
                    @if ($menu->childs->count())
                        @continue
                    @endif
                    <option value="{{$menu->id}}" class="from-control">{{$menu->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <label for="tags">Tags <a href="/admin/tags">Create</a></label>
            <div style="max-height: 70px; overflow-x: auto;">
            @foreach ($tags as $tag)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="{{$tag->id}}" id="tags" name="tags[]">
                    <label class="form-check-label" for="tags">{{$tag->name}}</label>
                </div>
            @endforeach
            </div>
        </div>
        <div class="col-md-2">
            <label for="comment">Allowed Comment</label>
            <select class="form-control form-control-sm" name="comment" id="comment">
                @if ($post->comment==1)
                    <option value="1">Yes</option>
                @endif
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>
        </div>
        <div class="col-md-2">
            <label for="sticky">Sticky Post</label>
            <select class="form-control form-control-sm" name="sticky" id="sticky">
                @if ($post->sticky==1)
                    <option value="1">Yes</option>
                @endif
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>
        </div>
        <div class="col-md-2">
            <label for="status">Status</label>
            <select class="form-control form-control-sm" name="status" id="status">
                @if ($post->status==0)
                    <option value="0">Draft</option>
                @endif
                <option value="1">Publish</option>
                <option value="0">Draft</option>
            </select>
        </div>
        <div class="col-md-1">
            <label for="update">Update</label>
            <input type="submit" class="btn btn-warning btn-sm" id="update" value="Update">
        </div>
    </div>
</form>