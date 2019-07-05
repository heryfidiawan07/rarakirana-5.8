@extends('layouts.app')

@section('css')
    <link rel="stylesheet" type="text/css" href="/css/left-right-modal.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
@endsection

@section('content')
<div class="container-fluid">
    
    <span class="parent-color bold text-size-15">Product List</i></span>
    @include('admin.left-sidebar')
    
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a class="btn btn-primary btn-sm" @if ($mainmenus->where('setting',1)->count() == 0 || !$adminAdd || !$etalases->count()) disabled @else href="/admin/product/create" @endif><i class="fas fa-plus"></i> Create Product </a>
                    @if ($mainmenus->where('setting',1)->count() == 0)
                        <p class="text-danger">Please setup menu product !</p>
                    @endif
                    @if (!$adminAdd)
                        <p class="text-danger">Please setup admin address !</p>
                    @endif
                    @if (!$etalases->count())
                        <p class="text-danger">Please setup product etalase !</p>
                    @endif
                </div>
                <div class="table-responsive">
                    <table class="table table-hover" id="product-table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Price</th>
                                <th>Etalase</th>
                                <th>Type</th>
                                <th>Discus</th>
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
            $('#product-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('get.products') !!}',
                columns: [
                        { data: 'title', name: 'title' },
                        { data: 'price', name: 'price' },
                        { data: 'etalase.name', name: 'etalase.name' },
                        { data: 'type', name: 'type' },
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