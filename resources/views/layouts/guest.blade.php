
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $title }}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Select2 -->
 <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

</head>
<body class="dark-mode d-flex flex-column align-items-center justify-content-center py-4" style="min-height: 100vh; width:100%;">
      
  <div class="text-xl col-lg-6 col-10 mb-4">
    <a href="/" class="d-flex flex-lg-row flex-column align-items-center justify-content-start" style="color:#17A2B8 !important;">
      <img src="{{ asset('dist/img/logos/logo.png') }}" alt="Logo" width="100" height="100" class="shadow">
      @if(app()->getLocale()=='id')
      <span class="ml-2 h1 text-lg-left text-center" style="text-shadow: 0 0 3px #0a0a0a, 0 1px 2px;"><b >{{ __('Data Recording Application') }}</b> <span>{{ __('Body Temperature') }}</span></span>
      @else
      <span class="ml-2 h1 text-lg-left text-center" style="text-shadow: 0 0 3px #0a0a0a, 0 1px 2px;"><b >{{ __('Body Temperature') }}</b> <span>{{ __('Data Recording Application') }}</span></span>
      @endif
    </a>
  </div>
  <div class="card col-lg-6 col-10 shadow">
      {{ $slot }}
  </div>
  
    
   
  <!-- /.login-logo -->
  {{-- {{ $slot }} --}}
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<!--- Select 2 --->
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

<script>
    $('.select2').select2()
</script>

</body>
</html>
