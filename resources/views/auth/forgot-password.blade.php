@extends('layouts.guest')

@section('content')
<div class="all-wrapper menu-side with-pattern">
    <div class="auth-box-w wider">
        <div class="logo-w">
            <a href="{{ route('dashboard') }}"><img alt="" src="{{ asset('public/img/logo-big.png')}}"></a>
        </div>
        <h4 class="auth-header">
            Reset Password
          </h4>
        {{-- <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div> --}}

        

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <x-validation-errors class="mb-4" />

        
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="form-group">
              <label for="">{{ __('Email') }}</label>
              <input class="form-control" placeholder="Enter your email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username">
              <div class="pre-icon os-icon os-icon-fingerprint"></div>
            </div>
            <div class="buttons-w">
              <button class="btn btn-primary" type="submit">{{ __('Email Password Reset Link') }}</button>
              <a href="{{ route('login') }}"><button class="btn btn-danger" type="button">{{ __('Cancel') }}</button></a>
            </div>
          </form>
    </div>
</div>
