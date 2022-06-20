@extends('layouts.auth')

@section('page-title', 'MAGicle - Sign In')

@section('main-content')
<section class="login right">
  <x-auth-validation-errors class="mb-4" :errors="$errors" />

  <form method="POST" action="{{ route('password.email') }}">
    @csrf
    <img src="{{ asset('storage/img/logo.png') }}">
    <p>
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </p>
    <div class="input email" tabindex="-1">
      <label for="">Email</label>
      <input type="email" name="email" placeholder="Email" required autofocus>
    </div>



    <button type="submit">
        {{ __('Email Password Reset Link') }}
    </button>

    <p>
      Don't have an account yet? <a href="{{ route('register') }}">Sign up</a>
    </p>
  </form>

</section>
@endsection
