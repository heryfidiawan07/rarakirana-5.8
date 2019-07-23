@extends('admin.layouts.app')

@section('adminContent')
    
    <span id="panel-name">Address</span>
    
    <div class="row">
        
        @if (!$address)
            <div class="col-md-4">
                @include('admin.address.form-create')
            </div>
        @endif

        <div class="col-md-8">
            @if ($address)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <th>Address</th><th>Provinsi</th><th>Kabupaten</th><th>Postal Code</th><th>Edit</th>
                        <tr>
                            <td>{{strip_tags($address->address)}}</td>
                            <td>{{$address->provinsi}}</td>
                            <td>{{$address->kabupaten}}</td>
                            <td>{{$address->postal_code}}</td>
                            <td>@include('admin.address.modal-edit')</td>
                        </tr>
                    </table>
                </div>
            @endif
        </div>

    </div>

@endsection

@section('js')
    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="/js/admin/address.js"></script>
@endsection