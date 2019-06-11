@extends('layouts.app')

@section('css')
    <link rel="stylesheet" type="text/css" href="/css/left-right-modal.css">
@endsection

@section('content')
<div class="container-fluid">
    
    <span class="parent-color bold text-size-15">Dashboard</span>
    @include('admin.left-sidebar')

</div>
@endsection

@section('js')
    {{-- <script type="text/javascript" src="/js/admin-dashboard.js"></script> --}}
@endsection