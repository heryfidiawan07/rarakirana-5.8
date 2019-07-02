<form method="POST" action="/admin/order/{{$order->slug_token}}/manual-update">
    @csrf
    <label><b>MANUAL UPDATE</b></label>
    <div class="form-group">
        <label>Order Status</label>
        <select class="form-control" name="order_status">
            <option value="">Select</option>
            @foreach ($orderStatus as $key => $ordersts)
                <option value="{{$key}}">{{$ordersts}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Payment Status</label>
        <select class="form-control" name="pay_status">
            <option value="">Select</option>
            @foreach ($payStatus as $key => $paysts)
                <option value="{{$key}}">{{$paysts}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <input type="submit" value="Update" class="btn btn-warning btn-sm">
    </div>
</form>