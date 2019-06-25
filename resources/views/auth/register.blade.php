@extends('layouts.app')

@section('content')
    <div class="main-content">
        <!-- Header -->
        <div class="header bg-gradient-cp py-4 py-lg-5 pt-lg-4">
            <div class="container">
                <div class="text-center mb-7">
                    <div class="row justify-content-center">
                        <div class="col-xl-5 col-lg-6 col-md-8 px-5">
{{--                            <h1 class="text-white">Create an account!</h1>--}}
{{--                            <p class="text-white">Use these awesome forms to login or create new account in your project for free.</p>--}}
{{--                            @include('layouts.alerts')--}}
                        </div>
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
        <div class="container mt--8">
            <!-- Table -->
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <div class="card bg-secondary border-0">
                        <div class="card-header bg-transparent">
                            <div class="text-muted text-center">
                                Sign up with credentials
                            </div>
                        </div>
                        <div class="card-body px-lg-4 py-lg-4">
                            <form method="POST" action="{{ secure_redirect(route('register')) }}">
                                @csrf
                                <div class="form-group form-inline">
                                    <div class="input-group input-group-merge input-group-alternative w-48 mr-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                        </div>
                                        
                                        <input type="text" id="first_name" name="first_name" placeholder="First Name"
                                               class="form-control @error('first_name') is-invalid @enderror"
                                               value="{{ isset($user->first_name) ? $user->first_name : old('first_name') }}" maxlength="50" required autocomplete="first_name" autofocus>
                                        
                                        @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="input-group input-group-merge input-group-alternative w-48">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                        </div>
                                        
                                        <input type="text" id="last_name" name="last_name" placeholder="Last Name"
                                               class="form-control @error('last_name') is-invalid @enderror"
                                               value="{{ isset($user->last_name) ? $user->last_name : old('last_name') }}" maxlength="50" required autocomplete="last_name">
                                        
                                        @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-merge input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                        </div>
                                        
                                        <input type="email" id="email" name="email" placeholder="E-Mail Address"
                                               class="form-control @error('email') is-invalid @enderror"
                                               value="{{ isset($user->email) ? $user->email : old('email') }}" required autocomplete="email">
                                        
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                        </div>
                                        
                                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                               placeholder="Password" required autocomplete="new-password" minlength="6">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-check-bold"></i></span>
                                        </div>
                                        
                                        <input id="password-confirm" type="password" class="form-control" placeholder="Password Confirmation"
                                               name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-merge input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-world"></i></span>
                                        </div>
                                        <input type="text" id="sub_domain" name="sub_domain"
                                               class="form-control @error('sub_domain') is-invalid @enderror" maxlength="25" minlength="3" placeholder="SubDomain Name. eg. thisismydomain"
                                               value="{{ isset($user_profile->sub_domain) ? $user_profile->sub_domain : old('sub_domain') }}" required autocomplete="sub_domain">
                                        @error('sub_domain')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row my-4">
                                    <div class="col-12">
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            <input class="custom-control-input" id="checkAgreeRegister" type="checkbox">
                                            <label class="custom-control-label" for="checkAgreeRegister">
                                                <span class="text-muted">I agree with the <a href="#">Privacy Policy</a></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" id="register-btn" class="btn btn-primary mt-4 btn-block" disabled>Create account</button>
                                </div>
                                <input type="hidden" id="vc" name="vc" value="{{ $vc }}"/>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <a href="{{ secure_redirect(route('login')) }}" class="text-light">
                                <small><i class="fas fa-key"></i> Account already exist? Login Now.</small>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
