@extends('admin.layouts.app')

@section('adminContent')
    
    <span id="panel-name">Product Offline</span>
    
    <div class="row">
        @foreach ($offlines as $offline)
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <p>
                            <a class="text-link" href="/show/product/{{$offline->product->slug}}">
                                {{strip_tags($offline->product->title)}}
                            </a>
                            <span style="float: right;"><a href="/admin/product/stream/{{$offline->id}}" target="__blank" class="btn btn-primary btn-sm"><i class="fas fa-print"></i> Print</a></span>
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

@endsection
