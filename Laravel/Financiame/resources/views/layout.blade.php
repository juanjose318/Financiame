<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title','Financiame')</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="stylesheet" href="{{asset('css/main.css')}}" class="rel">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>
    <header>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <a href="/posts/"><img src="{{asset('storage/img/logo.png')}}" alt="Financiame" class="img-fluid" width="150" height="40"></a>
            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


            <div class="navbar-collapse collapse" id="navbarCollapse">

                <ul class="navbar-nav mr-auto">
                    @guest

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/projects">Explore</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/posts">News</a>
                    </li>
                    @endif

                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="/projects">Explore</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/posts">News</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/projects/create">Create a Project</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user-dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
            
                            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                    </li>
                    @endguest
                </ul>

                <form class="form-inline mt-2 mt-md-0">
                    <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>

        </nav>
    </header>
    <div class="container">
        @if(Session::has('notification'))
        <div class="notification is-{{ Session::get('notification') }} alert alert-success">
            {{ Session::get('message') }}
        </div>
        @endif
        @yield('content')
        @if ($errors->any())
        <div class="alert alert-warning" role="alert">
            <ul>
                @foreach($errors->all() as $error)

                <li>{{ $error }}</li>

                @endforeach
            </ul>
        </div>
        @endif


    </div>

    <script src="https://unpkg.com/ionicons@4.2.2/dist/ionicons.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>