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
            @if (!$aplication)
                @include('admin.aplication.create')
            @else
                @include('admin.aplication.edit')
            @endif
        </div>

        <div class="col-md-8">
            @if ($aplication)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <td>Image</td>
                            <td>
                                <img src="/aplication/thumb/{{$aplication->img}}" width="200">
                            </td>
                        </tr>
                        <tr>
                            <td>Title</td>
                            <td>{{$aplication->title}}</td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td>{!! strip_tags(nl2br($aplication->description)) !!}</td>
                        </tr>
                        <tr>
                            <td>App Name</td>
                            <td>{{$aplication->name}}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{$aplication->email}}</td>
                        </tr>
                        <tr>
                            <td>Telp</td>
                            <td>{{$aplication->telp}}</td>
                        </tr>
                        <tr>
                            <td>Hp</td>
                            <td>{{$aplication->hp}}</td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>{!! strip_tags(nl2br($aplication->address)) !!}</td>
                        </tr>
                        <tr>
                            <td>Founder / Author</td>
                            <td>{{$aplication->author}}</td>
                        </tr>
                        <tr>
                            <td>Company</td>
                            <td>{{$aplication->company}}</td>
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