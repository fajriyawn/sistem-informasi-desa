<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>@yield('title', 'Sistem Informasi Desa')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-black font-sans">
    {{-- @include('frontend.partials.navbar', ['colorPrimary' => $colorPrimary, 'colorSecondary' => $colorSecondary]) --}}
  @yield('content')
      {{-- @include('frontend.partials.footer') --}}
</body>
</html>