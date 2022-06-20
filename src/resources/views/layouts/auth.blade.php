<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <title>@yield('page-title', 'MAGicle')</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="stylesheet" type="text/css" href="{{ asset('css/index.css') }}">
  <link rel="icon" href="{{ url('storage/img/icon.png') }}">
</head>

<body>
  <div class="auth-wrapper" id="app">
    <main class="auth">
      <section class="login left">
        <img class="logo-mobile" src="{{ asset('storage/img/logo.png') }}">
        <img src="{{ asset('storage/img/illustration.jpg') }}" alt="Illustration">
        <h1>
          Save links. Share them. With anyone.
        </h1>
        <p>
          Easy link sharing, saving and more. All links in one place.
        </p>
      </section>
      @yield('main-content')
    </main>
  </div>
</body>

</html>