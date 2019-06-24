@if ($products->count())
    <div class="products-scroll-frame">
        @foreach($products->where('etalase.status',1) as $product)
            <div class="products-scroll">
                <div class="product-frame">
                    <img src=@if($product->pictures->count()) "/products/thumb/{{$product->pictures[0]->img}}"@else"/products/thumb/no-image.png" @endif height="150" class="rounded mx-auto d-block product-img-index">
                    <p class="text-center text-wrap">
                        <a class="parent-color bold text-link hover-unbold @if($product->sticky==1) sticky @endif" href="/show/product/{{$product->slug}}">{{str_limit($product->title,40)}}</a>
                    </p>
                    <p class="text-center">
                        <span class="text-orange bold">Rp {{number_format($product->price)}}</span>
                        @if ($product->discount > 0)
                            <span class="text-sale">Sale</span>
                        @endif
                    </p>
                    <div class="text-center">
                        @if ($product->type == 0)
                            <a class="btn-addToCart btn btn-sm bg-parent-color text-white width-48 hover-bold" href="/add-to-cart/{{$product->slug}}">AddToCart</a>
                            <a class="btn btn-sm bg-parent-color text-white width-48 hover-bold" href="/buy-product/{{$product->slug}}">Buy</a>
                        @else
                            <a class="btn btn-sm bg-parent-color text-white width-48 hover-bold" href="/show/product/{{$product->slug}}">Read More</a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif