@if(session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
@endif
<form method="POST" action="/send/product/{{$product->slug}}/offline">
    @csrf
    <div class="form-group">
        <label for="product_title">Product</label>
        <input type="text" name="product_title" class="form-control" value="{{$product->title}}" disabled>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" @guest value="{{old('email')}}" placeholder="Email" @else value="{{Auth::user()->email}}" readonly @endif required>
        @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <label for="phone">Telp/Hp</label>
        <input type="text" name="phone" class="form-control" value="{{old('phone')}}" placeholder="Telp/Hp" required>
        @if ($errors->has('phone'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('phone') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <label for="address">Address</label>
        <textarea class="form-control" name="address" rows="3" placeholder="Alamat" required>{{old('address')}}</textarea>
        @if ($errors->has('address'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('address') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" name="description" rows="6" placeholder="Deskripsi" required>{{old('description')}}</textarea>
        @if ($errors->has('description'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('description') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        @include('parts.captcha')
    </div>
    <div class="form-group">
        <button class="btn btn-primary btn-sm"><i class="fas fa-paper-plane"></i> Send</button>
    </div>
</form>