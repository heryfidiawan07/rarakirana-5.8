@extends('layouts.app')

@section('css')
    <link rel="stylesheet" type="text/css" href="/css/product-index.css">
@endsection

@section('content')
<div class="container">
    <div class="row">
        
        @if (Session::has('cart'))
            <div class="col-md-7">
                <div class="row">
                    @foreach ($products as $product)
                        <div class="col-md-6">
                            <div class="product-frame">
                                <img src="/products/thumb/{{$product['item']->pictures[0]['img']}}" height="150" class="rounded mx-auto d-block product-img-index">
                                <div class="frame-text-3em">
                                    <p class="text-center">
                                        <a class="text-link parent-color bold" href="/show/product/{{$product['item']['slug']}}">{{str_limit($product['item']['title'], 50)}}</a>
                                    </p>
                                </div>
                                <div class="text-center mt-3">
                                    <div class="frame-text-3em">
                                        <span class="text-orange bold">Rp {{number_format($product['item']['price'])}}</span>
                                        @if ($product['item']['discount'] > 0)
                                            <small class="text-danger bold text-size-10 italic">SALE</small>
                                        @endif
                                    </div>
                                    <div class="text-center">
                                        <div class="input-group input-group-sm" style="width: 40%; margin-left: 30%;">
                                            <button class="btn bg-gainsboro btn-sm min" data-slug="{{$product['item']['slug']}}">-</button>
                                            <input type="number" class="form-control qty_{{$product['item']['slug']}}" name="item_qty" value="{{$product['qty']}}" min="1" readonly>
                                            <button class="btn bg-gainsboro btn-sm plus" data-slug="{{$product['item']['slug']}}">+</button>
                                        </div>
                                    </div>
                                    <p class="text-center">
                                        <small>
                                            Rp {{number_format($product['item']['price'])}} x <span class="total_qty_{{$product['item']['slug']}}">{{$product['qty']}}</span> = 
                                            Rp <span class="cart-product-price-{{$product['item']['slug']}}" data-value="{{$product['item']['price']}}">{{number_format($product['price'])}}</span>
                                        </small>
                                    </p>
                                    <div class="text-center">
                                        <a href="/remove-cart/product/{{$product['item']['slug']}}" class="btn btn-danger btn-sm">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="card">
                    <div class="card-header">Sub Total</div>
                    <div class="card-body">
                        <p> Harga Produk Rp <span id="subTotal" data-value="{{$totalPrice}}">{{number_format($totalPrice)}}</span></p>
                        <p>Ongkos Kirim: Rp <span id="ongkir">_</span></p>
                    </div>
                    <div class="card-footer">
                        <p><b>TOTAL: Rp <span id="totalPrice">_</span></b></p>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <p>
                            <b>Address</b> @if ($addresses)| @include('products.modal-form-address') @endif
                        </p>
                    </div>
                    <div class="card-body">
                        @guest
                            @include('products.form-login')
                        @else
                            @if ($addresses)
                                <div style="max-height: 250px; overflow-x: scroll;">
                                    @foreach ($addresses as $address)
                                        @include('products.cart-address-details')
                                    @endforeach
                                </div>
                                <form method="POST" action="/cart/checkout">
                                    @csrf
                                    <input type="hidden" id="address_id" name="address_id" value="">
                                    <div class="form-group">
                                        <label>Catatan:</label>
                                        <textarea class="form-control" name="note" rows="3" required>{{old('note')}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <select name="kurir" id="kurir" class="form-control" disabled>
                                            <option class="kurir" value="0">Kurir</option>
                                            <option class="kurir" value="jne">JNE</option>
                                            <option class="kurir" value="tiki">TIKI</option>
                                            <option class="kurir" value="pos">POS</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select name="services" id="services" class="form-control" disabled></select>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary btn-sm" id="btn-checkout" value="Check Out" disabled>
                                    </div>
                                </form>
                            @else
                                @include('parts.form-address')
                            @endif
                        @endif
                    </div>
                    <div class="card-footer">
                        <a href="/remove-all/product" class="btn btn-danger btn-sm">Cancel All</a>
                    </div>
                </div>
            </div>

        @else
            Keranjang anda kosong
        @endif

    </div>
</div>
@endsection

@section('js')
    <script type="text/javascript" src="/js/cart-address.js"></script>
    <script type="text/javascript" src="/js/cart-address-edit.js"></script>
@endsection