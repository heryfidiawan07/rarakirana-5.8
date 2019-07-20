<form method="POST" action="/admin/order/{{$order->slug_token}}/resi" class="form-inline">
    @csrf
    <div class="input-group input-group-sm">
        <label>Nomor Resi : </label>
        <input type="text" name="resi_kurir" class="form-control" placeholder="Nomor Resi" aria-describedby="no-resi" @if ($order->resi_kurir != null) value="{{$order->resi_kurir}}" @endif>
        <div class="input-group-append">
            <button class="btn btn-primary" id="no-resi">
                @if ($order->resi_kurir == null)
                    Save
                @else
                    Update
                @endif
            </button>
        </div>
    </div>
</form>