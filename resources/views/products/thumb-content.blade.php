<div class="col-sm-6 col-md-6 col-xl-4">
    <div class="product-frame">
        @if ($product->pictures->count())
            <img src="/products/thumb/{{$product->pictures[0]->img}}" height="150" class="rounded mx-auto d-block product-img-index">
        @else
            <img src="/products/thumb/no-image.png" height="150" class="rounded mx-auto d-block product-img-index">
        @endif
        <div class="frame-text-3em text-center">
            <a class="parent-color bold text-link hover-unbold @if($product->sticky==1) sticky @endif" href="/show/product/{{$product->slug}}">{{str_limit($product->title,40)}}</a>
        </div>
        <div class="frame-text-3em text-center mt-3">
            <span class="text-orange bold">Rp {{number_format($product->price)}}</span>
            @if ($product->discount > 0)
                <span class="text-sale">SALE</span>
            @endif
        </div>
        <div class="text-center">
            @if ($product->type == 0)
                <a class="btn-addToCart btn btn-sm bg-parent-color text-white width-48 hover-unbold" href="/add-to-cart/{{$product->slug}}">AddToCart</a>
                <a class="btn btn-sm bg-parent-color text-white width-48 hover-unbold" href="/buy-product/{{$product->slug}}">Buy</a>
            @else
                <a class="btn btn-sm bg-parent-color text-white width-48 hover-unbold" href="/show/product/{{$product->slug}}">Read More</a>
            @endif
        </div>
    </div>
</div>