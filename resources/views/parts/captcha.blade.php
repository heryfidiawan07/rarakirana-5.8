<label for="g-recaptcha">Validation</label>
<div class="g-recaptcha" data-sitekey="6LcHNV4UAAAAAC_pZPPJHAevKgPTiQr5CdnRrzcO" style="transform:scale(0.77);-webkit-transform:scale(0.77);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>
@if ($errors->has('g-recaptcha-response'))
    <span class="help-block">
        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
    </span>
@endif
