<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ request()->is('login') || request()->is('petugas/login') ? 'Login Page' : 'Register Page' }}</title>
  <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
  <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css') }}">
</head>
<body>
  
  @yield('content')

  <script src="{{ asset('bootstrap/js/bootstrap.js') }}"></script>
</body>
</html>