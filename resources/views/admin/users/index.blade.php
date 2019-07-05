@extends('layouts.app')

@section('css')
    <link rel="stylesheet" type="text/css" href="/css/left-right-modal.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
@endsection

@section('content')
<div class="container">
    
    <span class="parent-color bold text-size-15">User List</i></span>
    @include('admin.left-sidebar')

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered" id="users-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Joined</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                </table>
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
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('get.users') !!}',
                columns: [
                        { data: 'name', name: 'name' },
                        { data: 'email', name: 'email' },
                        { data: 'created_at', name: 'created_at' },
                        { data: 'status', name: 'status' }
                    ]
                });
        });
    </script>
@endsection