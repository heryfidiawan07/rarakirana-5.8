<form method="POST" action="/admin/product/{{$product->id}}/quick-edit">
    @csrf
    <div class="form-row ">
        <td>
            <label for="sticky" class="small">Set to sticky</label>
            <select class="form-control form-control-sm" name="sticky">
                @if ($product->sticky==1)
                    <option value="1" class="from-control">Yes</option>
                @endif
                <option value="0" class="from-control">No</option>
                <option value="1" class="from-control">Yes</option>
            </select>
        </td>
        <td colspan="2">
            <label for="status" class="small">Status</label>
            <select class="form-control form-control-sm" name="status" id="status">
                @if ($product->status==0)
                    <option value="0">Draft</option>
                @endif
                <option value="1">Publish</option>
                <option value="0">Draft</option>
            </select>
        </td>
        <td colspan="2">
            <label for="etalase" class="small">Etalase</label>
            <select class="form-control form-control-sm" name="etalase_id" id="etalase">
                <option value="{{$product->etalase->id}}" class="form-control">{{$product->etalase->name}}</option>
                @foreach ($etalases as $etalase)
                    <option value="{{$etalase->id}}" class="from-control">{{$etalase->name}}</option>
                @endforeach
            </select>
        </td>
        <td colspan="2">
            <label for="first_price" class="small">First Price</label>
            <input type="integer" name="first_price" class="form-control form-control-sm" id="first_price" value="{{$product->first_price}}">
        </td>
        <td colspan="2">
            <label for="discount" class="small">Discount</label>
            <input type="integer" name="discount" class="form-control form-control-sm" id="discount" value="{{$product->discount}}">
        </td>
        <td>
            <label for="update" class="small">Update</label>
            <input type="submit" class="btn btn-warning btn-sm" id="update" value="Update">
        </td>
    </div>
</form>