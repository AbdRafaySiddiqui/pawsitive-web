@extends('layouts.guest')

@section('content')
<div class="all-wrapper menu-side with-pattern">
    <div class="auth-box-w wider">
      <div class="logo-w">
        <a href="{{ route('dashboard') }}"><img alt="" src="{{ asset('public/img/logo-big.png')}}"></a>
      </div>
      <h4 class="auth-header">
        Create new account
      </h4>
      <form method="POST" action="{{ route('register') }}">
        @csrf
        
        <div class="form-group">
            <label for=""> Name</label>
            <input class="form-control" placeholder="Enter Full Name" type="text" name="name" id="name" :value="old('name')" required autofocus autocomplete="name">
            <div class="pre-icon os-icon os-icon-email-2-at2"></div>
        </div>
        <div class="form-group">
          <label for=""> Email Address</label>
          <input class="form-control" placeholder="Enter email" type="email" name="email" id="email" :value="old('email')" required autofocus autocomplete="email">
          <div class="pre-icon os-icon os-icon-email-2-at2"></div>
        </div>
        <div class="form-group">
            <label for=""> Username</label>
            <input class="form-control" placeholder="Enter Username" type="text" name="username" id="username" :value="old('username')" required autofocus autocomplete="username">
            <div class="pre-icon os-icon os-icon-email-2-at2"></div>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label for=""> Password</label>
              <input class="form-control" placeholder="Enter Password" type="password" name="password" id="password" required autofocus autocomplete="new-password">
              <div class="pre-icon os-icon os-icon-fingerprint"></div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="">Confirm Password</label>
              <input class="form-control" placeholder="Confirm Password" type="password" name="password_confirmation" id="password_confirmation" required autofocus autocomplete="new-password">
            </div>
          </div>
        </div>
        <div class="buttons-w">
          <button class="btn btn-primary" type="submit">Register Now</button>
          <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
            {{ __('Already registered?') }}
          </a>
        </div>
      </form>
    </div>
  </div>

@endsection