<form method="POST" action="/send/user-data/product/{{$product->slug}}">
    {{csrf_field()}}
    <div class="form-group">
        <label for="title">Product Detail</label>
        <input type="integer" name="product_title" value="{{$product->title}}" disabled>
        <input type="hidden" name="product_id" value="{{$product->id}}">
    </div>
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" class="form-control" value="{{old('title')}}" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        @if (Auth::check())
            <input type="email" name="email" class="form-control" @if (Auth::user()) value="{{Auth::user()->email}}" disabled @else value="{{old('email')}}" @endif required>
        @endif
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" name="description" rows="10" required>{{old('description')}}</textarea>
    </div>
    <div class="form-group">
        <label for="validate">Validate</label>
        <textarea class="form-control" name="description" required>{{old('description')}}</textarea>
    </div>
    <div class="form-group">
        <button class="btn btn-primary btn-sm"><i class="fas fa-paper-plane"></i> Send</button>
    </div>
</form>