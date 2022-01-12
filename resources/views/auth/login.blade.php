@extends('layouts.app')

@section('content')

    {{--Header--}}
    <section class="py-5 bg-light">

        <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
                <div class="col-lg-6">
                    <h1 class="h2 text-uppercase mb-0">Login</h1>
                </div>

                <div class="col-lg-6 text-lg-end">

                </div>
            </div>
        </div>

    </section>

    {{--Login Form--}}
    <section class="py-5">
        <div class="row">
            <div class="col-6 offset-3">
                <h2 class="h5 text-uppercase mb-4 text-center">
                    {{__('Login')}}
                </h2>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="row">

                        {{-- Username --}}
                        <div class="col-6 offset-3">
                            <div class="form-group">
                                <label for="username" class="col-form-label text-samll text-uppercase">Username</label>
                                <input type="text"
                                       class="form-control form-control-lg"
                                       value="{{old('username')}}"
                                       name="username"
                                >
                                @error('username') <span class="text-danger">{{$message}}</span>@enderror
                            </div>
                        </div>

                        {{-- Password --}}
                        <div class="col-6 offset-3">
                            <div class="form-group">
                                <label for="password" class="col-form-label text-samll text-uppercase">Password</label>
                                <input type="password"
                                       class="form-control form-control-lg"
                                       value="{{old('password')}}"
                                       name="password"
                                >
                                @error('password') <span class="text-danger">{{$message}}</span>@enderror
                            </div>
                        </div>

                        {{-- Remember Me --}}
                        <div class="col-lg-6 offset-3 form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox"
                                       id="remember"
                                       class="custom-control-input"
                                       {{old('remember') ? 'checkbox' : ''}}
                                       name="remember"
                                >
                                <label for="checkbox" class="col-form-label text-samll custom-control-label">{{__('Remember Me')}}</label>
                            </div>
                        </div>


                        <div class="col-6 offset-3">
                            <div class="row">
                                {{-- Login Button --}}
                                <div class="col-3">
                                        <button class="btn btn-dark" type="submit">
                                            {{__('Login')}}
                                        </button>

                                </div>
                                <div class="col-9">

                                    @if(Route::has('register'))
                                        <a href="{{route('register')}}" class="btn btn-secondary float-end">
                                            {{__("Have't an account?")}}
                                        </a>
                                    @endif

                                </div>
                            </div>
                        </div>

                        <div class="col-6 offset-3">

                                @if(Route::has('password.request'))
                                    <a href="{{route('password.request')}}" class="btn btn-link px-0">
                                        {{__('Forgot Your Password?')}}
                                    </a>
                                @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
