@extends('frontend.app')
@section('title','Password Reset - Conversion Perfect')
@section('content')
    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
        <div class="separator separator-bottom separator-skew zindex-100">
            <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card bg-secondary border-0 mb-0">
                    <div class="card-header bg-transparent text-center login-logo">
                        <img src="{{asset('/img/logo.png')}}" alt="" class="img-fluid logo w-75">
                    </div>
                    <div class="card-body px-lg-5">
                        <form method="POST" action="{{route('reset-password')}}"  role="form">
                            {{csrf_field()}}
                            <div class="form-group mb-3">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Email" type="email" name="email">
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary mt-3">Send Password Reset Link</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <a href="{{route('login')}}" class="text-light"><small>Login Now</small></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection