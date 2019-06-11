<div class="form-group">
    <div class="main-img-preview text-center">
        <img class="thumbnail img-preview" src="/parts/no-image.png" alt="Preview Image">
    </div>
    <br>
    <div class="input-group">
        <input id="fakeUploadLogo" class="form-control fake-shadow" placeholder="Choose File" disabled="disabled">
        <div class="input-group-btn">
            <div class="fileUpload btn btn-default fake-shadow">
                <span><i class="fas fa-upload"></i> Upload Image</span>
                <input id="logo-id" name="img" type="file" class="attachment_upload" value="{{old('img')}}">
            </div>
        </div>
    </div>
    @if ($errors->has('img'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('img') }}</strong>
        </span>
    @endif
</div>