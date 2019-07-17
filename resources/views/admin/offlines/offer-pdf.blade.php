<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <title>OFFERING LETTER</title>
    </head>
    <body>
        
        <h4>OFFERING LETTER</h4>
        <br>

        <h2 class="text-center text-success"><b>{{$app ? $app->name : 'Rarakirana'}}</b></h2>
        <p class="text-center">{{$app ? $app->address : 'Address'}}</p>
        
        <hr>
        <small>{{ date('d F, Y', strtotime($offer->created_at))}}</small>
        <table class="table">
            <tr>
                <td>
                    @if ($offer->product->pictures->count())
                        <img src="{{ config('app.url') }}/products/thumb/{{$offer->product->pictures[0]->img}}" width="100">
                    @else
                        <img src="{{ config('app.url') }}/products/thumb/no-image.png" width="100">
                    @endif
                </td>
                <td>
                    {{$offer->product->title}}
                </td>
            </tr>
            <tr>
                <td>Price</td>
                <td>Rp {{number_format($offer->product->price)}}</td>
            </tr>
            <tr>
                <td>Discount</td>
                <td>{{number_format($offer->product->discount)}}</td>
            </tr>
            <tr>
                <td>Weight</td>
                <td>{{$offer->product->weight/1000}} Kg</td>
            </tr>
        </table>
        
        <hr>
        
        <table class="table">
            <tr>
                <td>Email</td>
                <td>{{$offer->email}}</td>
            </tr>
            <tr>
                <td>Phone</td>
                <td>{{$offer->phone}}</td>
            </tr>
            <tr>
                <td>Address</td>
                <td>{!! nl2br(strip_tags($offer->address)) !!}</td>
            </tr>
        </table>
        <h5>Description: </h5>
        <hr>
        <p>{!! nl2br(strip_tags($offer->description)) !!}</p>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>