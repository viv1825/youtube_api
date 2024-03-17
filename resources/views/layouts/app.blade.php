<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'L') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{ asset('build/assets/style-7BTVkDGJ.css') }}">
    
    <style>
        .bg-light .nav-link {
            color: #000000; /* Change text color */
        }
    
        .bg-light .nav-link:hover {
            background-color: #ffffff; /* Change background color on hover */
        }
    </style>
    

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/js/sweet_alert.js'])
</head>

<body style="background-color:#B4D4FF;">
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color: #2f7b94">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}" style="color:#FFFFFF">
                    Laravel
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        @guest
                        @else
                            {{-- <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{ route('index') }}"
                                    style="color:#FFFFFF">Home</a>
                            </li> --}}
                            {{-- <li class="nav-item">
                                <a class="nav-link " aria-current="page" href="{{ route('history') }}"
                                    style="color:#FFFFFF"><i class="fa-solid fa-clock-rotate-left"></i></a>
                            </li> --}}
                        @endguest

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}"
                                        style="color:#FFFFFF">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}"
                                        style="color:#FFFFFF">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li>
                                <form class="d-flex ms-auto me-5" role="search" method="GET"
                                    action="{{ route('results') }}">
                                    <input class="form-control me-2" type="search" name="search_query" placeholder="Search"
                                        aria-label="Search">
                                    <button class="btn btn-success" type="submit" style="color:#FFFFFF">Search</button>
                                </form>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre
                                    style="color:#FFFFFF">
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
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-auto bg-light sticky-top">
                    <div class="d-flex flex-sm-column flex-row flex-nowrap bg-light align-items-center sticky-top">
                        <a href="/" class="d-block p-3 link-dark text-decoration-none" title=""
                            data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Icon-only">
                            <i class="fa-solid fa-clock-rotate-left"></i>
                        </a>
                        <ul
                            class="nav nav-pills nav-flush flex-sm-column flex-row flex-nowrap mb-auto mx-auto text-center align-items-center">
                            <li class="nav-item">
                                <a href="{{ route('index') }}" class="nav-link py-3 px-2" title="" data-bs-toggle="tooltip"
                                    data-bs-placement="right" data-bs-original-title="Home">
                                    <i class="fa-solid fa-house"></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('mostliked')}}" class="nav-link py-3 px-2" title="" data-bs-toggle="tooltip"
                                    data-bs-placement="right" data-bs-original-title="Dashboard">
                                    <i class="fa-regular fa-heart"></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('history') }}" class="nav-link py-3 px-2" title="" data-bs-toggle="tooltip"
                                    data-bs-placement="right" data-bs-original-title="Orders">
                                    <i class="fa-solid fa-clock-rotate-left"></i>
                                </a>
                            </li>
                            <li>
                                {{-- <a href="#" class="nav-link py-3 px-2" title="" data-bs-toggle="tooltip"
                                    data-bs-placement="right" data-bs-original-title="Products">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a> --}}
                            </li>
                            <li>
                                <a href="{{ route('editUser') }}" class="nav-link py-3 px-2" title="" data-bs-toggle="tooltip"
                                    data-bs-placement="right" data-bs-original-title="Customers">
                                    <i class="fa-solid fa-user-pen"></i>
                                </a>
                            </li>
                        </ul>
                        {{-- <div class="dropdown">
                            <a href="#"
                                class="d-flex align-items-center justify-content-center p-3 link-dark text-decoration-none dropdown-toggle"
                                id="dropdownUser3" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-user"></i>
                            </a>
                            <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser3">
                                <li><a class="dropdown-item" href="#">New project...</a></li>
                                <li><a class="dropdown-item" href="#">Settings</a></li>
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                            </ul>
                        </div> --}}
                    </div>
                </div>
                <div class="col-sm p-3 min-vh-100">
                    <!-- content -->
                    <header>
                        <div class="container-fluid" style="background-color: #B4D4FF;">
                            <div class="row">
                                <div class="col mt-5 pt-4 pb-0 md-4 mx-auto">
                                    <!-- Add your header content here -->
                                    @section('header')
                                        @if (isset($header))
                                            <h4 class="">Search result @yield('header')</h4>
                                        @else
                                            {{-- <h4 class="text-center">Home</h4> --}}
                                        @endif
                                    @show
                                </div>
                            </div>
                        </div>
                    </header>

                    <!-- Content Section -->
                    <div class="content-section overflow-x-hidden mb-50" style="background-color:#B4D4FF;">
                        @yield('content')
                    </div>


                    <!-- Footer Section -->
                    <footer>
                        <div class="container-fluid" style="background-color: #B4D4FF;">
                            <div class="row">
                                <div class="col mt-0 md-4 mx-auto">
                                    <!-- Add your footer content here -->
                                    @section('footer')
                                        @if (isset($header))
                                            {{-- <h4 class="text-center">Search result @yield('header')</h4> --}}
                                            <p class="text-center">showing total 40 results of @yield('header').</p>
                                        @else
                                            {{-- <h4 class="text-center">footer</h4> --}}
                                        @endif
                                    @show
                                </div>
                            </div>
                        </div>
                    </footer>

                </div>
            </div>
        </div>

        <!-- Header Section -->

    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(videoId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteForm_' + videoId).submit();
            }
        });
    }
</script>

</html>
