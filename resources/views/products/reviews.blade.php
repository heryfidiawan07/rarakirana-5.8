@foreach ($product->reviews as $review)
    <div class="alert alert-success">
        <p>{!! nl2br(strip_tags($review->review)) !!}</p>
        <a href="/user/{{$review->user->slug}}">
            <img src="/users/{{$comment->user->img}}" class="img-circle-xs"> {{$review->user->name}}
        </a>
        <small>, {{ date('d F, Y', strtotime($review->created_at))}}</small>
    </div>
@endforeach