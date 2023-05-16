@extends('layouts.guest')

@section('content')

    <div class="all-wrapper menu-side with-pattern">
      <div class="auth-box-w">
        <div class="logo-w">
          <a href="{{ route('dashboard') }}"><img alt="" src="{{ asset('public/img/logo-big.png')}}"></a>
        </div>
        <h4 class="auth-header">
          Login
        </h4>
        <form method="POST" action="{{ route('login') }}">
            @csrf
          <div class="form-group">
            <label for="">Username</label>
            <input class="form-control" placeholder="Enter your username" type="text" name="username" id="username" :value="old('username')" required autofocus autocomplete="username">
            <div class="pre-icon os-icon os-icon-user-male-circle"></div>
          </div>
          <div class="form-group">
            <label for="">Password</label>
            <input class="form-control" placeholder="Enter your password" type="password" name="password" required autocomplete="current-password">
            <div class="pre-icon os-icon os-icon-fingerprint"></div>
          </div>
          <div class="buttons-w">
            <button class="btn btn-primary" type="submit">Log me in</button>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input class="form-check-input" type="checkbox" id="remember_me" name="remember">Remember Me</label>
            </div>
          </div>
          <div class="buttons-w">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
          </div>
        </form>
      </div>
    </div>
@endsection