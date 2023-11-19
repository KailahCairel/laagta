@extends('layouts.app')

@section('content')
<section>
    <div class="page-header min-vh-100">
    <div class="container">
        <div class="row">
        <div class="col-md-6">
            <div class="position-absolute w-40 top-0 start-0 h-100 d-md-block d-none">
            <div class="oblique-image position-absolute d-flex fixed-top ms-auto h-100 z-index-0 bg-cover me-n8" style="background-image:url('{{asset('imgs/intro-logo.jpg')}}')"> 
            </div>
            </div>
        </div>
        <div class="col-md-4 d-flex flex-column mx-auto">
            <div class="card card-plain mt-8">
            <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-black text-dark display-6">{{__('Register')}}</h3>
                <p class="mb-0">Nice to meet you! Please enter your details.</p>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                @csrf
                <label for="name">{{ __('Name') }}</label>
                <div class="mb-3">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <label for="email"  >{{ __('Email Address') }}</label>
                <div class="mb-3">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <label>Password</label>
                <div class="mb-3">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <label>Confirm Password</label>
                <div class="mb-3">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                     
                </div>
                <div class="form-check form-check-info text-left mb-0">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="font-weight-normal text-dark mb-0" for="flexCheckDefault">
                    I agree the <a href="javascript:;" class="text-dark font-weight-bold">Terms and Conditions</a>.
                    </label>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Register') }}
                    </button> 
                </div>
                <div class="d-flex justify-content-between flex-column p-0 gap-2"> 

                            <!-- Google Login Button -->
                        <a href="/login/google" class="social-button google-button"> <i class="fa fa-google"></i> Login with Google</a>
                </div>
                </form>
            </div>
            <div class="card-footer text-center pt-0 px-lg-2 px-1">
        
                @if (Route::has('login'))
                <p class="mb-4 text-xs mx-auto">
                Already have an account?
                <a href="{{ route('login') }}" class="text-dark font-weight-bold">{{ __('Login') }}</a>
                </p>
                @endif
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>
</section>
@endsection
