@extends('layouts.auth')

@section('page-title', 'MAGicle - Sign In')

@section('main-content')
<section class="login right">
  <x-auth-validation-errors class="mb-4" :errors="$errors" />

  <form method="POST" action="{{ route('login') }}">
    @csrf
    <img src="{{ asset('storage/img/logo.png') }}">
    <h1>Welcome back!</h1>
    <div class="input email" tabindex="-1">
      <label for="">Email</label>
      <input type="email" name="email" placeholder="Email" required autofocus>
    </div>

    <div class="input password">
      <input type="password" name="password" required placeholder="Password">
    </div>

    <div class="input checkbox">
      <input type="checkbox" name="" id="remember-me" name="remember">
      <label for="remember-me">Remember me</label>
    </div>

    <button type="submit">
      Log in
    </button>

    <p>
      Don't have an account yet? <a href="{{ route('register') }}">Sign up</a>
      <br>
      Forgot your password? <a href="{{ route('password.request') }}">Click here.</a>
    </p>
  </form>

</section>
@endsection