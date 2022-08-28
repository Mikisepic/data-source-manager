<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title inertia>{{ config('app.name', 'MAGicle') }}</title>

  <!-- Icon -->
  <link rel="icon" href="{{ url('storage/img/icon.png') }}">

  <!-- Scripts -->
  @routes
  @vite('resources/js/app.js')
  @inertiaHead
</head>

<body class="font-sans antialiased">
  @inertia
</body>

<script>
  // On page load or when changing themes, best to add inline in `head` to avoid FOUC
  if (localStorage.getItem('isDark') || (!('isDark' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    document.documentElement.classList.add('dark');
  } else {
    document.documentElement.classList.remove('dark')
  }
</script>

</html>