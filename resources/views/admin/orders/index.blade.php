@extends('admin.layouts.app')

@section('adminContent')
    
    <span id="panel-name">Orders</span>

    <div class="row">

        <div class="col-md-12">
            @foreach ($orders as $order)
                <div class="card mb-2">
                    <div class="card-header">
                        <p>
                            {{$order->no_order}}
                            @if ($order->payment)
                                | <span class="text-success"> {{$order->payment->no_invoice}}</span>
                            @endif
                        </p>
                    </div>
                    <div class="card-body">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="detail-{{$order->id}}-tab" data-toggle="tab" href="#detail-{{$order->id}}" role="tab" aria-controls="detail-{{$order->id}}" aria-selected="true">Detail</a>
                                <a class="nav-item nav-link" id="address-{{$order->id}}-tab" data-toggle="tab" href="#address-{{$order->id}}" role="tab" aria-controls="address-{{$order->id}}" aria-selected="false">Address</a>
                                <a class="nav-item nav-link" id="manual-update-{{$order->id}}-tab" data-toggle="tab" href="#manual-update-{{$order->id}}" role="tab" aria-controls="manual-update-{{$order->id}}" aria-selected="false">Manual Update</a>
                            </div>
                        </nav>
                        <div class="tab-content p-2" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="detail-{{$order->id}}" role="tabpanel" aria-labelledby="detail-{{$order->id}}-tab">
                                <p>Status: {{$orderStatus[$order->status]}}</p>
                                <p>
                                    Action: 
                                    @if ($order->payment)
                                        @include('admin.orders.modal-check-payment')
                                    @else
                                        Waiting for payment
                                    @endif
                                </p>
                                @if ($order->payment)
                                    @if ($order->payment->status ==1 )
                                        <b>{{$order->resi_kurir}}</b>
                                        @include('admin.orders.form-resi')
                                    @endif
                                @endif
                            </div>
                            <div class="tab-pane fade" id="address-{{$order->id}}" role="tabpanel" aria-labelledby="address-{{$order->id}}-tab">
                                <p>{{$order->address->penerima}}</p>
                                <p>
                                    {{strip_tags($order->address->address)}}, {{$order->address->kecamatan}}, {{$order->address->kabupaten}}, {{$order->address->provinsi}}, {{$order->address->phone}}
                                </p>
                                @if ($order->payment)
                                    @if ($order->payment->status == 1)
                                        <a href="/admin/order/{{$order->slug_token}}/download" target="_blank" class="btn btn-success btn-sm"><i class="fas fa-download"></i> Download</a>
                                        <a href="/admin/order/{{$order->slug_token}}/stream" target="_blank" class="btn btn-info btn-sm"><i class="fas fa-print"></i> Print</a>
                                    @endif
                                @endif
                            </div>
                            <div class="tab-pane fade" id="manual-update-{{$order->id}}" role="tabpanel" aria-labelledby="manual-update-{{$order->id}}-tab">
                                @include('admin.orders.form-manual-update')
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <small>
                            Order: {{ date('d F, Y', strtotime($order->created_at))}}
                            @if ($order->payment)
                                | <i>Payment: {{ date('d F, Y', strtotime($order->payment->created_at))}}</i>
                            @endif
                        </small>
                    </div>
                </div>
            @endforeach
            
        </div>
        
    </div>

@endsection
