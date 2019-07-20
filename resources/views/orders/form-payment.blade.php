<form method="POST" action="/order/payment/{{$order->slug_token}}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label>Pengirim</label>
        <input type="text" name="pengirim" class="form-control" placeholder="Nama Pengirim" value="{{old('pengirim')}}" required>
    </div>
    <div class="form-group">
        <label>Upload resi / Bukti transfer</label>
        <input type=file name="image_resi" class="form-control-file">
    </div>
    <div class="form-group">
        <input type="submit" value="Send" class="btn btn-primary btn-sm">
    </div>
</form>