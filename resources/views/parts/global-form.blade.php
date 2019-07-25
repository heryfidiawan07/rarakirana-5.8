@if(session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
@endif
<form method="POST" action="/send/form-data" class="mt-5">
    @csrf
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" class="form-control" value="{{old('title')}}" placeholder="Judul" required>
        @if ($errors->has('title'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('title') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" @guest value="{{old('email')}}" placeholder="Email" @else value="{{Auth::user()->email}}" readonly @endif placeholder="Alamat email" required>
        @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <label for="phone">Telp/Hp</label>
        <input type="phone" name="phone" class="form-control" value="{{old('phone')}}" placeholder="Telp/Hp"required>
        @if ($errors->has('phone'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('phone') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" name="description" rows="10" placeholder="Deskripsi" required>{{old('description')}}</textarea>
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