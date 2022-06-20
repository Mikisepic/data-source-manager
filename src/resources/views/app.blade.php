<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <title>MAGicle</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="icon" href="{{ url('storage/img/icon.png') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/index.css') }}">

  <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body>
  <div id="app"></div>
</body>

</html>