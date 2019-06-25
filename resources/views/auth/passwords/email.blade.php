@extends('layouts.app')

@section('content')
    <div class="main-content">
        <!-- Header -->
        <div class="header bg-gradient-cp py-6 py-lg-7 pt-lg-8">
            <div class="container">
                <div class="text-center mb-7">
                    <div class="row justify-content-center">
                        <div class="col-xl-5 col-lg-6 col-md-8 px-5"></div>
                    </div>
                </div>
            </div>
            <div class="separator separator-bottom separator-skew">
                <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                    <polygon class="fill-auth" points="2560 0 2560 100 0 100"></polygon>
                </svg>
            </div>
        </div>
        <!-- Page content -->
        <div class="container mt--8 pb-xl-9 pb-sm-5">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">
                    <div class="card bg-secondary border-0 mb-0">
                        <div class="card-header bg-transparent text-center login-logo">
                            <img src="{{ asset('img/logo.png', config('site.ssl_tf')) }}" alt="" class="img-fluid logo w-50"/>
                        </div>
                        <div class="card-body px-lg-5 py-lg-5">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    {{ session('status') }}
                                </div>
                            @endif
                            <form role="form" action="{{ secure_redirect(route('password.email')) }}" method="post">
                                @csrf
                                <div class="form-group mb-3">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                        </div>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required
                                               autocomplete="email" autofocus placeholder="E-Mail Address">
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success bg-cp my-4 text-capitalize">
                                        Send Password Reset Link
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6">
                            <a href="{{ secure_redirect(route('login')) }}" class="text-light">
                                <small>Login Now</small>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
