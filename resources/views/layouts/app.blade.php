<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Books Shopping</title>


    @section('stylesheets')
        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

            <!-- Custom styles for this template -->
        <link href="/css/app.css" rel="stylesheet">
    @show
</head>
<body>

    <header>
        <div class="navbar navbar-dark bg-dark shadow-sm">
            <div class="container d-flex justify-content-between">
                <a href="/" class="navbar-brand d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="mr-2" viewBox="0 0 24 24" focusable="false"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                    <strong>Books Shopping</strong>
                </a>
                <div class="d-flex">


                    @if (Route::has('login'))
                        <div class="top-right links" style="padding-right: 15px;">
                            <a href="{{ route('categories.index') }}">Categorie</a>
                            @auth
                                <a href="{{ route('orders.index') }}">Ordini</a>
                            @else
                                <a href="{{ route('login') }}">Login</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}">Register</a>
                                @endif
                            @endauth
                        </div>
                    @endif


                    <div class="dropdown">
                        <a href="#" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-shopping-cart"></i> {{\App\Facades\CartClass::quantity()}} @if(\App\Facades\CartClass::quantity() > 0) <small class="text-white">- &euro; {{\App\Facades\CartClass::total() }} </small>@endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                            <div class="dropdown-cart">
                                @if(\App\Facades\CartClass::content()->isNotEmpty())
                                    @foreach(\App\Facades\CartClass::content() as $key=>$item)
                                        <div class="row cart-detail">
                                            <div class="col-lg-3 col-sm-3 col-3 cart-detail-img">
                                                <img class="img-fluid" src="https://via.placeholder.com/800x600">
                                            </div>
                                            <div class="col-lg-9 col-sm-9 col-9 cart-detail-product">
                                                <form class="float-right" method="POST" action="{{route('cart.destroy', $key)}}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"><i class="fas fa-trash-alt"></i></button>
                                                </form>
                                                <h6>{{$item['name']}}</h6>
                                                <span class="price">{{$item['qta']}} x &euro; {{$item['price']}}</span><br>
                                            </div>
                                        </div>
                                        <hr>
                                    @endforeach
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                                            <a href="{{route('cart.index')}}" class="btn btn-primary btn-block">Vai al carrello</a>
                                        </div>
                                    </div>
                                @else
                                    <h3>Il carrello è vuoto</h3>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </header>

    <main role="main">

        @if(session('status'))
            <div class="section">
                <div class="container">
                    <div class="alert alert-{{session('type', 'info')}}">
                        {{session('status')}}
                    </div>
                </div>
            </div>
        @endif

        {{--
        @if(Session::has('success'))
            <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
        @endif

        @if(Session::has('error'))
            <div class="alert alert-danger" role="alert">{{ Session::get('error') }}</div>
        @endif

        @if(Session::has('warning'))
            <div class="alert alert-warning" role="alert">{{ Session::get('warning') }}</div>
        @endif

        @if(Session::has('info'))
            <div class="alert alert-info" role="alert">{{ Session::get('info') }}</div>
        @endif
        --}}

        @if ($errors->any())
            <div class="section">
                <div class="container">
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">
          <i class="now-ui-icons ui-1_simple-remove"></i>
        </span>
                        </button>
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        @yield('content')

    </main>

    <footer class="text-muted">
        <div class="container">
            <p class="float-right">
                <a href="#">Back to top</a>
            </p>
            <p>Album example is &copy; Bootstrap, but please download and customize it for yourself!</p>
            <p>New to Bootstrap? <a href="https://getbootstrap.com/">Visit the homepage</a> or read our <a href="/docs/4.3/getting-started/introduction/">getting started guide</a>.</p>
        </div>
    </footer>
    @section('javascript')
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    @show
</body>
</html>
