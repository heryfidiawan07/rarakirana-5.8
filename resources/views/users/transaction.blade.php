@if ($user->orders->count())
    <div class="card">
        <div class="card-header"><h5>TRANSAKSI</h5></div>
        <div class="card-body">
            @foreach ($user->orders as $order)
            <p>
                <a href="/order/{{$user->slug}}/details/{{$order->slug_token}}">{{$order->no_order}}</a>
                <small>, {{ date('d F, Y', strtotime($order->created_at))}}</small>
            </p>
            @endforeach
        </div>
    </div>
@endif