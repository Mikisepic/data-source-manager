@extends('layouts.auth')

@section('page-title', 'MAGicle - Sign Up')

@section('main-content')
<section class="login right">
  <x-auth-validation-errors class="mb-4" :errors="$errors" />
  <form method="POST" action="{{ route('register') }}">
    @csrf
    <img src="{{ asset('storage/img/logo.png') }}">
    <h1>Create An Account</h1>

    <div class="input email" tabindex="-1">
      <label for="email">Email</label>
      <input type="email" name="email" placeholder="Email" required autofocus>
    </div>

    <div class="input password">
      <input type="password" name="password" required placeholder="Password">
    </div>

    <div class="input password">
      <input type="password" name="password_confirmation" required placeholder="Password confirmation">
    </div>

    <button type="submit">
      Sign up
    </button>

    <p>
      Already have an account? <a href="{{ route('login') }}">Sign in</a>
    </p>
  </form>

</section>
@endsection