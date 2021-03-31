<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Adomino.net</title>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{url('themes/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{url('css/adminlte.min.css')}}">
</head>
<body class="hold-transition login-page">
@yield('content')
<script src="{{url('themes/jquery/jquery.min.js')}}"></script>
<script src="{{url('themes/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{url('js/adminlte.min.js')}}"></script>
</body>
</html>