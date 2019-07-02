@extends('layouts.app')

@section('css')
    <link rel="stylesheet" type="text/css" href="/css/left-right-modal.css">
    <link rel="stylesheet" type="text/css" href="/css/upload.css">
@endsection

@section('content')
<div class="container-fluid">
    
    <span class="parent-color bold text-size-15">App Setting</i></span>
    @include('admin.left-sidebar')

    <div class="row">
        
        <div class="col-md-4">
            @if (!$application)
                @include('admin.application.create')
            @else
                @include('admin.application.edit')
            @endif
        </div>

        <div class="col-md-8">
            @if ($application)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <td>Image</td>
                            <td>
                                <img src="/application/thumb/{{$application->img}}" width="200">
                            </td>
                        </tr>
                        <tr>
                            <td>Title</td>
                            <td>{{$application->title}}</td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td>{!! strip_tags(nl2br($application->description)) !!}</td>
                        </tr>
                        <tr>
                            <td>App Name</td>
                            <td>{{$application->name}}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{$application->email}}</td>
                        </tr>
                        <tr>
                            <td>Telp</td>
                            <td>{{$application->telp}}</td>
                        </tr>
                        <tr>
                            <td>Hp</td>
                            <td>{{$application->hp}}</td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>{!! strip_tags(nl2br($application->address)) !!}</td>
                        </tr>
                        <tr>
                            <td>Founder / Author</td>
                            <td>{{$application->author}}</td>
                        </tr>
                        <tr>
                            <td>Company</td>
                            <td>{{$application->company}}</td>
                        </tr>
                    </table>
                </div>
            @endif
        </div>

    </div>
</div>
@endsection

@section('js')
    <script type="text/javascript" src="/js/upload.js"></script>
@endsection