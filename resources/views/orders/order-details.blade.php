@extends('layouts.app')

@section('css')
    <link rel="stylesheet" type="text/css" href="/css/product-index.css">
@endsection

@section('content')
<div class="container">
    
    <div class="row">
        
        <div class="col-md-8">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" id="details-tab" data-toggle="tab" href="#details" role="tab" aria-controls="details" aria-selected="true">Details</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" id="checkout-tab" data-toggle="tab" href="#checkout" role="tab" aria-controls="checkout" aria-selected="false">Checkout</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if ($order->status < 2) disabled @endif" id="delivery-tab" data-toggle="tab" href="#delivery" role="tab" aria-controls="delivery" aria-selected="false">Delivery</a>
                </li>
                <li>
                    <a class="nav-link" href="/user/{{$order->user->slug}}/invoice/{{$order->slug_token}}" target="_blank">Print / Download Invoice</a>
                </li>
            </ul>
        </div>

        <div class="col-md-8">
            <br>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade" id="details" role="tabpanel" aria-labelledby="details-tab">
                    <div class="row">
                        @foreach ($details as $detail)
                            <div class="col-md-4">
                                <div class="product-frame">
                                    <img src="/products/thumb/{{$detail->product->pictures[0]->img}}" height="150" class="rounded mx-auto d-block product-img-index">
                                    <div class="frame-text-3em text-center">
                                        <a class="parent-color bold text-link hover-unbold" href="/show/product/{{$detail->product->slug}}">{{str_limit($detail->product->title, 40)}}</a>
                                    </div>
                                    <div class="text-center mt-1">
                                            @if ($detail->product->discount > 0)
                                                <span class="text-sale"> SALE</span>
                                            @endif
                                            <p>Rp {{number_format($detail->product->price)}} x <i>{{$detail->qty}}</i> = <b>Rp {{number_format($detail->product->price*$detail->qty)}}</b></p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="col-md-12">
                            <div class="card mt-3">
                                <div class="card-header">Sub Total</div>
                                <div class="card-body">
                                    <p>Harga Produk Rp <span class="bold">{{number_format($order->total_price-$order->ongkir)}}</span></p>
                                    <p>Ongkir Rp <span class="bold">{{number_format($order->ongkir)}}</span></p>
                                </div>
                                <div class="card-footer">
                                    Total Rp <span class="bold">{{number_format($order->total_price)}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade show active" id="checkout" role="tabpanel" aria-labelledby="checkout-tab">
                    <div class="table-raponsive">
                        <table class="table table-hover">
                            <tr>
                                <td>No Order:</td>
                                <td>{{$order->no_order}}</td>
                            </tr>
                            <tr>
                                <td>Note:</td>
                                <td>{{$order->note}}</td>
                            </tr>
                            <tr>
                                <td>Kurir:</td>
                                <td>{{strtoupper($order->kurir)}} - {{$order->services}}</td>
                            </tr>
                            <tr>
                                <td>Ongkir:</td>
                                <td>Rp {{number_format($order->ongkir)}}</td>
                            </tr>
                            <tr>
                                <td>Total Price:</td>
                                <td>Rp {{number_format($order->total_price)}}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="card">
                        <div class="card-header"><b>ADDRESS</b></div>
                        <div class="card-body">
                            <p>Penerima: <b>{{$order->address->penerima}}</b> <i>({{$order->address->name}})</i></p>
                            {!! nl2br(strip_tags($order->address->address)) !!}
                            ,{{$order->address->kecamatan}}, {{$order->address->kabupaten}} - {{$order->address->provinsi}} {{$order->address->postal_code}}
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-header">Payment</div>
                        <div class="card-body">
                            @foreach ($accounts as $account)
                                <p><b>{{$account->bank}}</b></p>
                                <p><b>A/N {{$account->name}}</b></p>
                                <p><b>No Rekening {{$account->no_rek}}</b></p>
                            @endforeach
                            <p>Nominal: <b>Rp {{number_format($order->total_price)}}</b></p>
                            <div class="alert alert-info">
                                <h5>STATUS</h5>
                                @if ($order->payment)
                                    <div class="alert alert-warning">
                                        <p class="text-success">
                                            {{$userPayStatus[$order->payment->status]}}
                                        </p>
                                        @if ($order->payment->status == 1)
                                            <p @if ($order->status == 3) class="text-success" @endif>
                                                {{$userOrderStatus[$order->status]}}
                                            </p>
                                        @endif
                                        @if ($order->payment->status == 2)
                                            <div class="alert alert-danger">
                                                {{$order->payment->keterangan}}
                                            </div>
                                            @include('orders.form-edit-payment')
                                        @endif
                                        @if ($order->status > 1)
                                            <p><b>Nomor Resi: {{$order->resi_kurir}}</b></p>
                                            @if ($order->status == 2)
                                                @include('orders.modal-arrived')
                                            @endif
                                        @endif
                                    </div>
                                @else
                                    <div class="alert alert-warning">
                                        {{$userOrderStatus[$order->status]}}
                                    </div>
                                    @if ($order->status == 0)
                                        @include('orders.form-payment')
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="delivery" role="tabpanel" aria-labelledby="delivery-tab">
                DELIVERY
            </div>
        </div>

    </div>
</div>
@endsection
