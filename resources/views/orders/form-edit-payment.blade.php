<form method="POST" action="/order/payment/{{$order->slug_token}}/edit" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label>Pengirim</label>
        <input type="text" name="pengirim" class="form-control" placeholder="Nama Pengirim" value="{{$order->payment->pengirim}}" required>
    </div>
    <div class="form-group">
        <img src="/payment/{{$order->payment->image_resi}}" width="100">
        <br>
        <label>Upload Resi / Bukti Pengiriman</label>
        <input type=file name="image_resi" class="form-control-file">
    </div>
    <div class="form-group">
        <input type="submit" value="Update" class="btn btn-primary btn-sm">
    </div>
</form>