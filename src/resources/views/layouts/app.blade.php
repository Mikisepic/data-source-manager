<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <!-- Metadata -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Icon -->
  <link rel="icon" href="{{ url('storage/img/icon.png') }}">

  <title>{{ config('app.name', 'MAGicle') }}</title>

  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

  <!-- Styles -->
  <!-- @vite('resources/sass/index.scss') -->
  @vite('resources/css/app.css')
</head>

<body class="font-sans antialiased">
  <div class="min-h-screen bg-gray-100">
    @include('layouts.navigation')
    <div id="app"></div>
  </div>

  <!-- Scripts -->
  @vite('resources/js/app.js')
</body>

</html>