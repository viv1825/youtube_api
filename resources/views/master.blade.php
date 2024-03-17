<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel YouTube</title>
    <style>
        .top-bar {
            /* background-color: #12372A; */
            /* Customize the top bar color */
            /* color: #ffffff; */
            /* Customize the text color in the top bar */
        }

        /* Add additional styling or modifications here */

        /* You can include specific styles for your YouTube clone */
        /* For example, font styles, header and footer styling, etc. */
    </style>
    @yield('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color: #12372A">
        <div class="container-fluid ">
            <a class="navbar-brand mx-5" href="{{ route('index') }}" style="color:#FFFFFF">Laravel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav  mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('index') }}"
                            style="color:#FFFFFF">Home</a>
                    </li>
                </ul>
                <form class="d-flex ms-auto me-5" role="search" method="GET" action="{{ route('results') }}">
                    <input class="form-control me-2" type="search" name="search_query" placeholder="Search"
                        aria-label="Search">
                    <button class="btn btn-success" type="submit" style="color:#FFFFFF">Search</button>
                </form>
            </div>
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color:#FFFFFF">
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </nav>

    {{-- sidebar --}}


    <!-- Header Section -->
    <header>
        <div class="container-fluid" style="background-color: #ADBC9F;">
            <div class="row">
                <div class="col mt-5 pt-4 pb-0 md-4 mx-auto">
                    <!-- Add your header content here -->
                    @section('header')
                        @if (isset($header))
                            <h4 class="">Search result @yield('header')</h4>
                        @else
                            <h4 class="text-center">Home</h4>
                        @endif
                    @show
                </div>
            </div>
        </div>
    </header>




    <!-- Content Section -->
    <!-- Content Section -->
    <div class="content-section" style="background-color:#ADBC9F;">
        @yield('content')
    </div>


    <!-- Footer Section -->
    <footer>
        <div class="container-fluid" style="background-color: #ADBC9F;">
            <div class="row">
                <div class="col mt-2 md-4 mx-auto">
                    <!-- Add your footer content here -->
                    @section('footer')
                        @if (isset($header))
                            {{-- <h4 class="text-center">Search result @yield('header')</h4> --}}
                            <p class="text-center">showing total 20 results of @yield('header').</p>
                        @else
                            <h4 class="text-center">footer</h4>
                        @endif
                    @show
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
