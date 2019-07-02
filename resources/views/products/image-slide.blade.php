<div id="carouselExampleIndicators" class="carousel slide carousel-product-img" data-ride="carousel">
    
    <ol class="carousel-indicators carousel-indicators-product-img">
        @foreach ($product->pictures as $key => $pict)
            <li data-target="#carouselExampleIndicators" data-slide-to="{{$key}}" @if($key==0) class="active" @endif>
                <img src="/products/img/{{$pict->img}}" class="d-block w-100 indicator-img" alt="..." height="20">
            </li>
        @endforeach
    </ol>
    
    <div class="carousel-inner carousel-inner-product-img">
        @foreach ($product->pictures as $key => $pict)
            <div class="carousel-item carousel-item-product-img @if($key==0) active @endif">
                <img src="/products/img/{{$pict->img}}" class="product-img" alt="...">
            </div>
        @endforeach
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
