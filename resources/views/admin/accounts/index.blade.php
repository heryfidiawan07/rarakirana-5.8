@extends('admin.layouts.app')

@section('adminContent')

    <span id="panel-name">ADMIN DASHBOARD</span>

    <div class="row">
        
        <div class="col-md-4">
            <form method="POST" action="/admin/account/store">
                @csrf
                <div class="form-group">
                    <label>Bank</label>
                    <input type="text" name="bank" class="form-control" value="{{old('bank')}}" required>
                </div>
                <div class="form-group">
                    <label>Atas Nama</label>
                    <input type="text" name="name" class="form-control" value="{{old('name')}}" required>
                </div>
                <div class="form-group">
                    <label>Nomor Rekening</label>
                    <input type="text" name="no_rek" class="form-control" value="{{old('no_rek')}}" required>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control" required>
                        <option value="1">Active</option>
                        <option value="0">No Active</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary btn-sm" value="Save">
                </div>
            </form>
        </div>

        <div class="col-md-8">
            <div class="table-responsive">
                <table class="table table-hover">
                    <th>Bank</th><th>Name</th><th>No Rek</th><th>Status</th><th>Edit</th><th>Delete</th>
                    @foreach ($accounts as $account)
                        <tr>
                            <td>{{$account->bank}}</td>
                            <td>{{$account->name}}</td>
                            <td>{{$account->no_rek}}</td>
                            <td>
                                @if ($account->status==1)
                                    Active
                                @else
                                    No Active
                                @endif
                            </td>
                            <td>@include('admin.accounts.modal-edit')</td>
                            <td>@include('admin.accounts.modal-delete')</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>

    </div>

@endsection