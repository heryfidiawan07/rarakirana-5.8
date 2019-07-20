@foreach ($product->reviews as $review)
    <div class="alert alert-success">
        <p>{!! nl2br(strip_tags($review->review)) !!}</p>
        <a href="/user/{{$review->user->slug}}">
            <img src="
            @if ($review->user->biodata)
                @if ($review->user->biodata->img != null)
                    /users/{{$review->user->biodata->img}}
                @else
                    /parts/no-image-icon.png
                @endif
            @else
                /parts/no-image-icon.png
            @endif
            " class="img-circle" width="30"> {{$review->user->name}}
        </a>
        <small>, {{ date('d F, Y', strtotime($review->created_at))}}</small>
    </div>
@endforeach