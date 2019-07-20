@include('admin.header')
    
    <span id="panel-name">Social Media</span>
    
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header"><label>Social Media Share</label></div>
                <div class="card-body">
                    @foreach ($adminShareClass as $key => $class)
                        <form method="POST" action="/admin/share/store">
                            @csrf
                            <div class="form-group">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="{{$class}}"></i>
                                            <input type="hidden" name="share_class" value="{{$class}}">
                                        </div>
                                        <input type="text" name="share_link" class="form-control" value="{{$adminShareUrls[$key]}}" required readonly>
                                        <div class="input-group-append">
                                            <input type="submit" class="btn btn-primary btn-sm" value="Save" @foreach ($shares as $share) @if ($class === $share->class) disabled @endif @endforeach>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card">
                <div class="table-responsive">
                    <div class="card-header"><label>Social Media Share</label></div>
                    <div class="card-body">
                        <table class="table table-hover">
                            @foreach ($shares as $share)
                                <tr>
                                    <td><i class="{{$share->class}}"></i></td>
                                    <td>@include('admin.social-media.share-modal-delete')</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<hr>
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header"><label>Social Media Follow</label></div>
                <div class="card-body">
                    @foreach ($adminFollowClass as $class)
                        <form method="POST" action="/admin/follow/store">
                            @csrf
                            <div class="form-group">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="{{$class}}"></i>
                                            <input type="hidden" name="follow_class" value="{{$class}}">
                                        </div>
                                        <input type="text" name="follow_link" class="form-control" placeholder="<?php $text = explode("-", $class); echo $text[1].' url';?>" required>
                                        <div class="input-group-append">
                                            <input type="submit" class="btn btn-primary btn-sm" value="Save" @foreach ($follows as $follow) @if($follow->class === $class) disabled @endif @endforeach>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header"><label>Social Media Follow</label></div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            @foreach ($follows as $follow)
                                <tr>
                                    <td><i class="{{$follow->class}}"></i></td>
                                    <td>
                                        <a href="{{$follow->link}}">{{$follow->link}}</a>
                                        <div class="collapse" id="follow_{{$follow->id}}">
                                            <form method="POST" action="/admin/follow/{{$follow->id}}/update">
                                                @csrf
                                                <div class="input-group-prepend input-group-sm">
                                                    <input type="text" name="follow_link_edit" class="form-control" value="{{$follow->link}}" required>
                                                    <div class="input-group-append">
                                                        <input type="submit" class="btn btn-warning btn-sm" value="Update">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </td>
                                    <td>
                                        <a class="btn btn-warning btn-sm" data-toggle="collapse" href="#follow_{{$follow->id}}" role="button" aria-expanded="false">Edit</a>
                                    </td>
                                    <td>@include('admin.social-media.follow-modal-delete')</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@include('admin.footer')
