<form method="POST" action="/address/{{$address->id}}/update">
    @csrf
    <div class="form-group">
        <label>Simpan Sebagai</label>
        <input type="text" id="name_edit" name="name_edit" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{$address->name}}" required>
        @if ($errors->has('name'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <label>Nama Penerima</label>
        <input type="text" id="penerima_edit" name="penerima_edit" class="form-control {{ $errors->has('penerima') ? ' is-invalid' : '' }}" value="{{$address->penerima}}" required>
        @if ($errors->has('penerima'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('penerima') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <label>Alamat Rumah</label>
        <textarea name="address_edit" id="address_edit" class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}" rows="3" required>{{nl2br(strip_tags($address->address))}}</textarea>
        @if ($errors->has('address'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('address') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <label>Nomor Telpon</label>
        <input type="text" id="phone_edit" name="phone_edit" class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}" value="{{$address->phone}}" required>
        @if ($errors->has('phone'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('phone') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <label>Provinsi</label>
        <select name="prov_id_edit" class="form-control" id="prov_id_edit">
            <option value="{{$address->prov_id}}">{{$address->provinsi}}</option>
            @foreach ($provinsies as $key => $provinsi)
                <option value="{{str_replace('"','',json_encode($provinsies[$key]['province_id']))}}">{{str_replace('"','',json_encode($provinsies[$key]['province']))}}</option>
            @endforeach
        </select>
        <input type="hidden" id="provinsi_edit" name="provinsi_edit" value="{{$address->provinsi}}">
    </div>
    <div class="form-group">
        <label>Kabupaten</label>
        <select id="kab_id_edit" name="kab_id_edit" class="form-control" required>
            <option value="{{$address->kab_id}}">{{$address->kabupaten}}</option>
        </select>
        <input type="hidden" id="kabupaten_edit" name="kabupaten_edit" value="{{$address->kabupaten}}">
    </div>
    {{-- <div class="form-group">
        <label>Kecamatan</label>
        <select id="kecamatan" name="kecamatan" class="form-control" disabled required>
            <option value="0">Kecamatan</option>
        </select>
        <input type="hidden" id="kecamatan" name="kecamatan" value="">
    </div> --}}
    <div class="form-group">
        <input type="submit" value="Update" id="btn-edit-address" class="btn btn-warning btn-sm" disabled>
    </div>
</form>