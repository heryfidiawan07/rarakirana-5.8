@if ($shares)
    <p class="share"><b>Share: </b>
    @foreach ($shares as $share)
        <a href="{{$share->link}}"><i class="{{$share->class}}"></i></a>
    @endforeach
    </p>
@endif