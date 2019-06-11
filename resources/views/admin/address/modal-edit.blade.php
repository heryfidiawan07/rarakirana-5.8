<a href="" class="btn btn-warning btn-sm" href="" data-toggle="modal" data-target=".address_edit{{$address->id}}">Edit</a>

<div class="modal fade address_edit{{$address->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="text-center">Edit Address</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/admin/address/{{$address->id}}/update">
                    @csrf
                    <div class="form-group">
                        <label>Address</label>
                        <textarea name="address" id="address" class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}" rows="3" required>{{strip_tags($address->address)}}</textarea>
                        @if ($errors->has('address'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('address') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Telp/Hp</label>
                        <input type="text" id="phone" name="phone" class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}" value="{{$address->phone}}" required>
                        @if ($errors->has('phone'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Provinsi</label>
                        <select name="prov_id" class="form-control" id="prov_id">
                            <option value="{{$address->prov_id}}">{{$address->provinsi}}</option>
                            @foreach ($provinsies as $key => $provinsi)
                                <option value="{{str_replace('"','',json_encode($provinsies[$key]['province_id']))}}">{{str_replace('"','',json_encode($provinsies[$key]['province']))}}</option>
                            @endforeach
                        </select>
                        <input type="hidden" id="provinsi" name="provinsi" value="{{$address->provinsi}}">
                    </div>
                    <div class="form-group">
                        <label>Kabupaten</label>
                        <select id="kab_id" name="kab_id" class="form-control" required>
                            <option value="{{$address->kab_id}}">{{$address->kabupaten}}</option>
                        </select>
                        <input type="hidden" id="kabupaten" name="kabupaten" value="{{$address->kabupaten}}">
                    </div>
                    {{-- <div class="form-group">
                        <label>Kecamatan</label>
                        <select id="kecamatan" name="kecamatan" class="form-control" disabled required>
                            <option value="0">Kecamatan</option>
                        </select>
                        <input type="hidden" id="kecamatan" name="kecamatan" value="">
                    </div> --}}
                    <div class="form-group">
                        <input type="submit" value="Save" class="btn btn-success btn-sm">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>