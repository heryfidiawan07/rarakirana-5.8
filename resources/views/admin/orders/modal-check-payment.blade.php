<a class="btn btn-info btn-sm" href="#" data-toggle="modal" data-target=".pay-check-{{$order->id}}">Option</a>

<div class="modal fade pay-check-{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="text-center">Payment Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <img src="/payment/{{$order->payment->image_resi}}" style="max-width: 100%;">
                    <h3>Pengirim : {{$order->payment->pengirim}}</h3>
                    <div class="alert alert-info">{{$order->payment->keterangan}}</div>
                </div>
                <hr>
                <a href="/admin/payment/{{$order->slug_token}}/accept" class="btn btn-success btn-sm">Approve !</a>
                <hr>
                <div class="alert alert-warning">
                    <form method="POST" action="/admin/payment/{{$order->slug_token}}/reject">
                        @csrf
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea rows="3" class="form-control" name="keterangan" required></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Reject" class="btn btn-warning btn-sm">
                        </div>
                    </form>
                </div>
                <a href="/admin/payment/{{$order->slug_token}}/delete" class="btn btn-danger btn-sm">Delete !</a>
                @if ($order->status == 2)
                    <a href="/admin/order/{{$order->slug_token}}/arrived" class="btn btn-success btn-sm">Arrived !</a>
                @endif
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>