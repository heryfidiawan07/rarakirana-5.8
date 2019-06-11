<form method="POST" action="/address/store">
    @csrf
    <div class="form-group">
        <label>Simpan Sebagai</label>
        <input type="text" id="name" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{old('name')}}" required>
        @if ($errors->has('name'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <label>Nama Penerima</label>
        <input type="text" id="penerima" name="penerima" class="form-control {{ $errors->has('penerima') ? ' is-invalid' : '' }}" value="{{old('penerima')}}" required>
        @if ($errors->has('penerima'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('penerima') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <label>Alamat Rumah</label>
        <textarea name="address" id="address" class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}" rows="3" required>{{old('address')}}</textarea>
        @if ($errors->has('address'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('address') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <label>Nomor Telpon</label>
        <input type="text" id="phone" name="phone" class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}" value="{{old('phone')}}" required>
        @if ($errors->has('phone'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('phone') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <label>Provinsi</label>
        <select name="prov_id" class="form-control" id="prov_id">
            <option value="0">Provinsi</option>
            @foreach ($provinsies as $key => $provinsi)
                <option value="{{str_replace('"','',json_encode($provinsies[$key]['province_id']))}}">{{str_replace('"','',json_encode($provinsies[$key]['province']))}}</option>
            @endforeach
        </select>
        <input type="hidden" id="provinsi" name="provinsi" value="">
    </div>
    <div class="form-group">
        <label>Kabupaten</label>
        <select id="kab_id" name="kab_id" class="form-control" required>
            <option value="0">Kabupaten</option>
        </select>
        <input type="hidden" id="kabupaten" name="kabupaten" value="">
    </div>
    {{-- <div class="form-group">
        <label>Kecamatan</label>
        <select id="kecamatan" name="kecamatan" class="form-control" disabled required>
            <option value="0">Kecamatan</option>
        </select>
        <input type="hidden" id="kecamatan" name="kecamatan" value="">
    </div> --}}
    <div class="form-group">
        <input type="submit" value="Save" id="btn-save-adress" class="btn btn-success btn-sm" disabled>
    </div>
</form>