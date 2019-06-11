@extends('layouts.app')

@section('css')
    <link rel="stylesheet" type="text/css" href="/css/left-right-modal.css">
@endsection

@section('content')
<div class="container-fluid">
    
    <span class="parent-color bold text-size-15">Inbox</i></span>
    @include('admin.left-sidebar')
    
    <div class="row">
        @foreach ($inboxes as $inbox)
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <p>
                            {{strip_tags($inbox->title)}}
                            <span style="float: right;"><a href="" class="btn btn-primary btn-sm">Print</a></span>
                        </p>
                    </div>
                    <div class="card-body">
                        <p><b>Email : {{strip_tags($inbox->email)}}</b></p>
                        <p><b>Phone : {{strip_tags($inbox->phone)}}</b></p>
                        {{strip_tags($inbox->description)}}
                    </div>
                    <div class="card-footer">
                        <p>
                            {{ date('d F, Y', strtotime($inbox->created_at))}}
                            <span style="float: right;">@include('admin.inbox.modal-delete')</span>
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row">
        {{$inboxes->links()}}
    </div>

</div>
@endsection
