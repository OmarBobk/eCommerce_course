@extends('layouts.app')

@section('content')


    {{--Header--}}
    <section class="py-5 bg-light">

        <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
                <div class="col-lg-6">
                    <h1 class="h2 text-uppercase mb-0">Register</h1>
                </div>

                <div class="col-lg-6 text-lg-end">

                </div>
            </div>
        </div>

    </section>

    {{--Register Form--}}
    <section class="py-5">
        <div class="row">
            <div class="col-6 offset-3">
                <h2 class="h5 text-uppercase mb-4">
                    {{__('Register')}}
                </h2>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    {{-- First Name --}}
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="first_name" class="col-md-4 col-form-label ">
                                First Name
                            </label>
                            <input id="first_name" type="text"
                                   class="form-control @error('first_name') is-invalid @enderror"
                                   name="first_name"
                                   value="{{ old('first_name') }}"
                                   required autocomplete="first_name" autofocus>

                            @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- Last Name --}}
                        <div class="col-md-6">
                            <label for="last_name" class="col-md-4 col-form-label ">
                                Last Name
                            </label>
                            <input id="last_name" type="text"
                                   class="form-control @error('last_name') is-invalid @enderror"
                                   name="last_name"
                                   value="{{ old('last_name') }}"
                                   required autocomplete="last_name">

                            @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{-- Username --}}
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="username" class="col-md-4 col-form-label ">
                                Username
                            </label>
                            <input id="username" type="text"
                                   class="form-control @error('username') is-invalid @enderror"
                                   name="username"
                                   value="{{ old('username') }}"
                                   required autocomplete="username">

                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="col-md-6">
                            <label for="email" class="col-md-4 col-form-label ">
                                Email
                            </label>
                            <input id="email" type="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   name="email"
                                   value="{{ old('email') }}"
                                   required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{-- Password --}}
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="password" class="col-md-4 col-form-label ">
                                Password
                            </label>
                            <input id="password" type="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   name="password"
                                   value="{{ old('password') }}"
                                   required autocomplete="password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- Confirm Password --}}
                        <div class="col-md-6">
                            <label for="password_confirmation" class="col-md-7 col-form-label ">
                                Confirm Password
                            </label>
                            <input id="password_confirmation" type="password"
                                   class="form-control @error('password_confirmation') is-invalid @enderror"
                                   name="password_confirmation"
                                   value="{{ old('password_confirmation') }}"
                                   required autocomplete="password_confirmation">

                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{-- Mobile --}}
                    <div class="row mb-3">
                        <div class="col-md-6 offset-3">
                            <label for="mobile" class="col-md-4 offset-4 col-form-label text-center">
                                Mobile
                            </label>
                            <input id="mobile" type="number"
                                   class="form-control @error('mobile') is-invalid @enderror"
                                   name="mobile"
                                   value="{{ old('mobile') }}"
                                   required autocomplete="mobile">

                            @error('mobile')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    {{-- Submit --}}
                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
