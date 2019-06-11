@extends('layouts.app')

@section('css')
    <link rel="stylesheet" type="text/css" href="/css/left-right-modal.css">
@endsection

@section('content')
<div class="container-fluid">
    
    <span class="parent-color bold text-size-15">Orders</i></span>
    @include('admin.left-sidebar')

    <div class="row">

        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <th>No Order</th><th>No INV</th><th>Status</th><th>Action</th>
                    </thead>
                    @foreach ($orders as $order)
                        <tr class="table-success">
                            <td>{{$order->no_order}}</td>
                            <td>
                                @if ($order->payment)
                                    {{$order->payment->no_invoice}}
                                @endif
                            </td>
                            <td>
                                @if ($order->payment)
                                    {{$payStatus[$order->payment->status]}}
                                    @if ($order->status > 0)
                                        <p>{{$orderStatus[$order->status]}}</p>
                                    @endif
                                @else
                                    {{$orderStatus[$order->status]}}
                                @endif
                            </td>
                            <td>
                                @if ($order->payment)
                                    @include('admin.orders.modal-check-payment')
                                @else
                                    Waiting for payment
                                @endif
                            </td>
                        </tr>
                        <tr>
                            @if ($order->payment->status ==1 )
                                <td>
                                    <b>{{$order->resi_kurir}}</b>
                                    @include('admin.orders.form-resi')
                                </td>
                            @endif
                            <td>
                                @include('admin.orders.form-manual-update')
                            </td>
                            <td colspan="2">
                                <div class="alert alert-info">
                                    <p>{{$order->address->penerima}}</p>
                                    {{strip_tags($order->address->address)}}, {{$order->address->kecamatan}}, {{$order->address->kabupaten}}, {{$order->address->provinsi}}, {{$order->address->phone}}
                                    <hr>
                                    @if ($order->payment->status == 1)
                                        <a href="" class="btn btn-success btn-sm">Print</a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        
    </div>
</div>
@endsection
