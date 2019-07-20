<div class="card mb-3">
    <div class="card-header">
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <input class="radioSelect address-select" type="radio" name="address_id" value="{{$address->id}}">
                </div>
            </div>
            <input type="text" class="form-control" placeholder="{{$address->name}}" readonly>
        </div>
    </div>
    <div class="card-body">
        <p>Penerima: <b>{{$address->penerima}}</b> | @include('products.modal-address-edit')</p> 
        {!! $address->address !!}, {{$address->kecamatan}} - {{$address->kabupaten}}, {{$address->provinsi}} {{$address->postal_code}}<br>
        Telp/Hp: {{$address->phone}}
    </div>
</div>
