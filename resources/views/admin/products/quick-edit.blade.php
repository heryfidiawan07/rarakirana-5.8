<form method="POST" action="/admin/product/{{$product->id}}/quick-edit">
    @csrf
    <div class="form-row ">
        <div class="col-md-2">
            <label for="comment">Allowed Comment</label>
            <select class="form-control form-control-sm" name="comment" id="comment">
                @if ($product->comment==1)
                    <option value="1">Yes</option>
                @endif
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>
        </div>
        <div class="col-md-2">
            <label for="status">Status</label>
            <select class="form-control form-control-sm" name="status" id="status">
                @if ($product->status==0)
                    <option value="0">Draft</option>
                @endif
                <option value="1">Publish</option>
                <option value="0">Draft</option>
            </select>
        </div>
        <div class="col-md-2">
            <label for="etalase">Etalase</label>
            <select class="form-control form-control-sm" name="etalase_id" id="etalase">
                <option value="{{$product->etalase->id}}" class="form-control">{{$product->etalase->name}}</option>
                @foreach ($etalases as $etalase)
                    <option value="{{$etalase->id}}" class="from-control">{{$etalase->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <label for="first_price">First Price</label>
            <input type="integer" name="first_price" class="form-control form-control-sm" id="first_price" value="{{$product->first_price}}">
        </div>
        <div class="col-md-2">
            <label for="discount">Discount</label>
            <input type="integer" name="discount" class="form-control form-control-sm" id="discount" value="{{$product->discount}}">
        </div>
        <div class="col-md-1">
            <label for="update">Update</label>
            <input type="submit" class="btn btn-warning btn-sm" id="update" value="Update">
        </div>
    </div>
</form>