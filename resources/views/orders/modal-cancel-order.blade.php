<a class="btn btn-danger btn-sm" href="" data-toggle="modal" data-target=".cancel-order">Cancel Order</a>

<div class="modal fade cancel-order" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="text-center">Cancel Order {{$order->no_order}} ?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <a href="/order/cancel/{{$order->slug_token}}" class="btn btn-danger btn-sm">Cancel !</a>
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>