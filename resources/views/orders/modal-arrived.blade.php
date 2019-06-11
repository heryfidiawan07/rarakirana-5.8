<a class="btn btn-success btn-sm" href="#" data-toggle="modal" data-target=".order-arrivied">Arrivied !</i></a>

<div class="modal fade order-arrivied" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="text-center">Konfirmasi Terima Barang !</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/order/{{Auth::user()->slug}}/arrived/{{$order->slug_token}}/create">
                    @csrf
                    @foreach ($details as $detail)
                        @foreach ($products->where('id',$detail->product_id) as $product)
                            <div class="form-group">
                                <label>Review Product</label>
                                <div class="text-center">
                                    <img src="/products/thumb/{{$product->pictures[0]->img}}" height="50" class="rounded mx-auto d-block">
                                    {{$product->slug}}
                                </div>
                                <textarea class="form-control" rows="3" name="review[]">{{old('review')}}</textarea>
                            </div>
                        @endforeach
                    @endforeach
                    <div class="form-group">
                        <input type="submit" value="Save" class="btn btn-primary btn-sm">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>