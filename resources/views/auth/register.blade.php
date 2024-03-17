@extends('layouts.app')

@section('content')
    <div class="container md-6 mt-5 w-75" >
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                    <div class="card-header text-center fs-4">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                    id="floatingInput" placeholder="" value="{{ old('name') }}" required>
                                <label for="floatingInput fs-1">{{ __('Name') }}</label>
                            </div>

                            {{-- <div class="form-floating mb-3">
                                <input id="floatingInput" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required>
                                <label for="floatingInput">Name</label>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div> --}}
                            {{-- email --}}
                            <div class="form-floating mb-3">
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" placeholder=""
                                    id="floatingInput" name="email" value="{{ old('email') }}" required
                                    autocomplete="email">
                                <label for="floatingInput">{{ __('Email Address') }}</label>
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            {{-- pass --}}
                            <div class="form-floating mb-3">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    id="floatingInput" placeholder="" required autocomplete="new-password">
                                <label for="floatingInput">{{ __('Password') }}</label>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            {{-- cpss --}}
                            <div class="form-floating mb-3">
                                <input id="password-confirm" type="password" class="form-control" id="floatingInput"
                                    placeholder="" name="password_confirmation" required autocomplete="new-password">
                                <label for="floatingInput">{{ __('Confirm Password') }}</label>
                            </div>

                            <div class="mb-0">
                                <button type="submit" class="btn btn-primary w-100">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
