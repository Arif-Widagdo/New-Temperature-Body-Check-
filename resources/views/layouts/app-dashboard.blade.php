<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- SEO Meta Tags -->
    {{-- <meta name="description" content="" /> --}}
    <meta name="author" content="Arif Widagdo | arifwidagdo24@gmail.com" />
      
    <!-- OG Meta Tags to improve the way the post looks when you share the page on Facebook, Twitter, LinkedIn -->
    {{-- <meta property="og:site_name" content="Sistem Gaji Kedai Muslim" /> <!-- website name -->
    <meta property="og:site" content="" /> <!-- website link -->
    <meta property="og:title" content="Elearning for X-Ray" /> <!-- title shown in the actual shared post -->
    <meta property="og:description" content="" /> <!-- description shown in the actual shared post -->
    <meta property="og:image" content="{{ asset('dist/img/logo.jpg') }}" /> <!-- image link, make sure it's jpg -->
    <meta property="og:url" content="" /> <!-- where do you want your post to link to -->
    <meta name="twitter:card" content="summary_large_image" /> <!-- to have large image post format in Twitter --> --}}

    <meta name="csrf-token" content="{{ csrf_token() }}">
        
    <base href="{{{ URL::to('/') }}}">

    <title>
        @if($title)
            {{ $title }}
        @else
            Temperature Check
        @endif
    </title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700|Nunito:300,300i,400,400i,600,600i,700,700i,900|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i&display=fallback">
    <link rel="icon" href="{{ asset('dist/img/logos/transparentLogo.png') }}">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset("plugins/fontawesome-free/css/all.min.css") }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset("plugins/overlayScrollbars/css/OverlayScrollbars.min.css") }}">
    <!-- Ijabo Crop Tool -->
    {{-- <link rel="stylesheet" href="{{ asset('plugins/ijabo-crop-tool/ijaboCropTool.min.css') }}"> --}}
    @yield('links')
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.css') }}">
    <!-- Toaster -->
    <link rel="stylesheet" href="{{ asset('dist/css/animate.min.css') }}">
    <!-- SweetAlert 2 | Display Message -->
    <link rel="stylesheet" href={{ asset('plugins/sweetalert2/sweetalert2.css') }}>
    <!-- Toaster -->
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">
</head>

<body class="dark-mode sidebar-closed layout-fixed layout-navbar-fixed sidebar-collapse">
    
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        @include('components.dashboard.navbar')
        <!-- /Navbar -->
        <!-- Main Sidebar Container -->
        @include('components.dashboard.sidebar')
        <!-- /Main Sidebar Container -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper ">
            <!-- Content Header (Page header) -->
            <section class="content-header animate__animated animate__slideInDown">
                <div class="container-fluid">
                    <div class="row mb-2">
                        @if (isset($header))
                        <div class="col-lg-7">
                            <h3 class="m-0 font-weight-bold" style="font-family: 'Nunito';">{{ $header }}</h3>
                        </div><!-- /.col -->
                        @endif
                        @if (isset($links))
                        <div class="col-lg-5">
                            {{ $links }}
                        </div><!-- /.col -->
                        @endif
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @if(session()->has('success'))
                    <div class="successToast"></div>
                    @elseif(session()->has('error'))
                    <div class="errorToast"></div>
                    @endif
                    
                    <div class="" id="successToast"></div>
                    <div class="" id="errorToast"></div>
                    <div class="" id="infoToast"></div>

                    {{ $slot }}
                </div>
                <!--/. container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

       @include('components.dashboard.footer')

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset("plugins/jquery/jquery.min.js") }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset("plugins/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset("plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js") }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset("dist/js/adminlte.js") }}"></script>
    <!-- SweetAlert 2 | Display Message -->
    <script src="{{ asset('dist/js/sweetalert2.all.min.js') }}"></script>
    <!-- Toaster -->
    <script src="{{ asset('dist/js/toastr.min.js') }}"></script>
    <!-- Ring Notif -->

    <script>
        // -- Custom JS Code --
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                background: "url({{ asset('dist/img/navy.png') }})",
            });
    
            $('.successToast').each(function () {
                Toast.fire({
                    icon: 'success',
                    title: '{{ Session::get("success") }}'
                })
            });
                
            $('.errorToast').each(function () {
                Toast.fire({
                    icon: 'error',
                    title: '{{ Session::get("error") }}'
                })
            });

            function alertToastInfo(msg) {
                $('#infoToast').addClass("infoToast");
                return $('.infoToast').each(function () {
                    Toast.fire({
                        icon: 'info',
                        title: msg
                    })
                });
            }

            function alertToastSuccess(msg) {
                $('#successToast').addClass("successToast");
                return $('.successToast').each(function () {
                    Toast.fire({
                        icon: 'success',
                        title: msg
                    })
                });
                
            }

            function alertToastError(msg) {
                $('#errorToast').addClass("errorToast");
                return $('.errorToast').each(function () {
                    Toast.fire({
                        icon: 'error',
                        title: msg
                    })
                });
            }
        </script>
        @yield('scripts')
</body>

</html>
