@extends('layouts.app')

@if ($app)
    @section('image'){{ config('app.url') }}/application/img/{{$app->img}}@endsection
    @section('title'){{$app->title}}@endsection
    @section('description'){{$app->description}}@endsection
@endif

@section('content')
    @if ($threads->count())
        <h2 class="parent-color bold mt-5">Threads</h2>
        <div class="row">
            @foreach ($threads->where('category.status',1)->where('status',1) as $thread)
                @include('threads.content-index')
            @endforeach
        </div>
        {{$threads->links()}}
    @endif
</div>
@endsection
