@if ($product->comments->count())
    @foreach ($product->comments->where('parent_id',0) as $comment)
        <div class="alert bg-silver">
            {!! nl2br(strip_tags($comment->description)) !!}
            <p>
                <a href="/user/{{$comment->user->slug}}" class="text-link">
                    <img src="/users/{{$comment->user->img}}" class="img-circle-xs"> {{$comment->user->name}}
                </a>
                <small>, {{ date('d F, Y', strtotime($comment->created_at))}}</small>
                @auth
                    @if (Auth::user()->id === $comment->user->id)
                        | <small><a data-toggle="collapse" href="#update_{{$comment->id}}" role="button" aria-expanded="false">Sunting</a></small>
                    @endif
                    | <small><a data-toggle="collapse" href="#reply_{{$comment->id}}" role="button" aria-expanded="false">Reply {{$comment->childs->count()}}</a></small>
                @endif
                @if ($comment->user->id == $product->user->id) <small class="btn-success btn-xs">Penjual</small> @endif
            </p>
            @auth
                @if (Auth::user()->id === $comment->user->id)
                    <div class="collapse" id="update_{{$comment->id}}">
                        <form method="POST" action="/comment/{{$comment->id}}/update">
                        {{csrf_field()}}
                            <div class="form-group">
                                <textarea class="form-control" name="descriptionEdit" rows="3" required>{{strip_tags($comment->description)}}</textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-warning btn-sm"><i class="fas fa-paper-plane"></i></button>
                            </div>
                        </form>
                    </div>
                @endif
            @endif
        </div>
        @if ($comment->childs->count())
            @foreach ($comment->childs as $child)
                <div class="alert bg-gainsboro ml-5">
                    {!! nl2br(strip_tags($child->description)) !!}
                    <p>
                        <a href="/user/{{$child->user->slug}}" class="text-link">
                            <img src="/users/{{$child->user->img}}" class="img-circle-xs"> {{$child->user->name}}
                        </a>
                        <small>, {{ date('d F, Y', strtotime($child->created_at))}}</small>
                        @auth
                            @if (Auth::user()->id === $child->user->id)
                                | <small><a data-toggle="collapse" href="#update_{{$child->id}}" role="button" aria-expanded="false">Sunting</a></small>
                            @endif
                        @endif
                        @if ($child->user->id == $product->user->id) <small class="btn-success btn-xs">Penjual</small> @endif
                    </p>
                    @auth
                        @if (Auth::user()->id === $child->user->id)
                            <div class="collapse" id="update_{{$child->id}}">
                                <form method="POST" action="/comment/{{$child->id}}/update">
                                {{csrf_field()}}
                                    <div class="form-group">
                                        <textarea class="form-control" name="descriptionEdit" rows="3" required>{{strip_tags($child->description)}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-warning btn-sm"><i class="fas fa-paper-plane"></i></button>
                                    </div>
                                </form>
                            </div>
                        @endif
                    @endif
                </div>
            @endforeach
        @endif
        @auth
            <div class="collapse" id="reply_{{$comment->id}}">
                <div class="alert bg-gainsboro ml-5">
                    <form method="POST" action="/comment/{{$comment->id}}/store">
                    @csrf
                        <div class="form-group">
                            <textarea class="form-control" name="descriptionParent" rows="2" placeholder="Reply" required>{{old('descriptionParent')}}</textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-sm"><i class="fas fa-paper-plane"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    @endforeach
@endif

@auth <form method="POST" action="/product/{{$product->slug}}/comment/store"> @endif
    @auth @csrf @endif
    <div class="form-group">
        <textarea rows="3" name="description" class="form-control" placeholder="Diskusi" required @guest disabled @endif>{{old('description')}}</textarea>
    </div>
    <div class="form-group">
        <button class="btn btn-primary btn-sm" @guest disabled @endif><i class="fas fa-paper-plane"></i></button>
    </div>
@auth </form> @endif