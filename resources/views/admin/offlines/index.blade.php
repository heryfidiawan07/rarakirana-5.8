@extends('layouts.app')

@section('css')
    <link rel="stylesheet" type="text/css" href="/css/left-right-modal.css">
@endsection

@section('content')
<div class="container-fluid">
    
    <span class="parent-color bold text-size-15">Product Offline</i></span>
    @include('admin.left-sidebar')
    
    <div class="row">
        @foreach ($offlines as $offline)
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <p>
                            <a class="text-link" href="/show/product/{{$offline->product->slug}}">
                                {{strip_tags($offline->product->title)}}
                            </a>
                            <span style="float: right;"><a href="" class="btn btn-primary btn-sm">Print</a></span>
                        </p>
                    </div>
                    <div class="card-body">
                        <p><b>Email : {{strip_tags($offline->email)}}</b></p>
                        <p><b>Phone: {{strip_tags($offline->phone)}}</b></p>
                        {{strip_tags($offline->description)}}
                    </div>
                    <div class="card-footer">
                        <p>
                            {{ date('d F, Y', strtotime($offline->created_at))}}
                            <span style="float: right;">@include('admin.offlines.modal-delete')</span>
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row">
        {{$offlines->links()}}
    </div>

</div>
@endsection
