<div id="carouselExampleIndicators" class="carousel slide carousel-product-img" data-ride="carousel">
    
    <ol class="carousel-indicators carousel-indicators-product-img">
        @if ($product->pictures->count())
            @foreach ($product->pictures as $key => $pict)
                <li data-target="#carouselExampleIndicators" data-slide-to="{{$key}}" @if($key==0) class="active" @endif>
                    <img src="/products/img/{{$pict->img}}" class="d-block w-100 indicator-img" alt="..." height="20">
                </li>
            @endforeach
        @endif
    </ol>
    
    <div class="carousel-inner carousel-inner-product-img">
        @if ($product->pictures->count())
            @foreach ($product->pictures as $key => $pict)
                <div class="carousel-item carousel-item-product-img @if($key==0) active @endif">
                    <img src="/products/img/{{$pict->img}}" class="product-img" alt="{{$product->title}}">
                </div>
            @endforeach
        @else
            <div class="carousel-item carousel-item-product-img active">
                <img src="/products/img/no-image.png" class="product-img" alt="{{$product->title}}">
            </div>
        @endif
    </div>

    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>

</div>
