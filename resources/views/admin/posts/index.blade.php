@extends('layouts.app')

@section('css')
    <link rel="stylesheet" type="text/css" href="/css/left-right-modal.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
@endsection

@section('content')
<div class="container-fluid">
    
    <span class="parent-color bold text-size-15">Post List</i></span>
    @include('admin.left-sidebar')
            
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a class="btn btn-primary btn-sm" href="/admin/post/create"><i class="fas fa-plus"></i> Create Post </a>
                    @if (session('status'))
                        <small class="danger">{{ session('status') }}</small>
                    @endif
                </div>
                <div class="table-responsive p-2">
                    <table class="table table-hover" id="post-table">
                        <thead>
                            <tr>
                                <th>Img</th>
                                <th>Title</th>
                                <th>Menu</th>
                                <th>Comment</th>
                                <th>Created</th>
                                <th>Author</th>
                                <th>Status</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $(document).ready( function () {
            $('#post-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('get.posts') !!}',
                columns: [
                        { data: 'img', name: 'img' },
                        { data: 'title', name: 'title' },
                        { data: 'menu.name', name: 'menu.name' },
                        { data: 'comment', name: 'comment' },
                        { data: 'created_at', name: 'created_at' },
                        { data: 'user.name', name: 'user.name'},
                        { data: 'status', name: 'status' },
                        { data: 'edit', name: 'edit', orderable: false, searchable: false},
                        { data: 'delete', name: 'delete', orderable: false, searchable: false},
                    ]
                });
        });
    </script>
@endsection