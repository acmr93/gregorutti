<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
{{--   <meta name="keywords" content="{{optional($metadato)->keywords}}">
  <meta name="description" content="{{optional($metadato)->description}}"> --}}
  <title>@yield('title', $empresa_->nombre)</title>

  <link rel="icon" href="{{asset('images/logos/favicon.png')}}">
  <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('fonts/font-awesome.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/general.css')}}">
  <link rel="stylesheet" href="{{asset('css/header.css')}}">
  <link rel="stylesheet" href="{{asset('css/footer.css')}}">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">

  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  @yield('css')

</head>

<body class="hold-transition sidebar-mini">
  @include('publica.layouts.header')
{{--   <div class="min-height" >
    @yield('contenido')
  </div> --}}
  @include('publica.layouts.footer')
  
<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
<script type="text/javascript">
    var ruta = "{{ url('') }}";
</script>

@yield('js')

</body>
</html>
