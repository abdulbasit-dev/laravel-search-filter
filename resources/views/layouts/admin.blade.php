<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset("plugins/fontawesome-free/css/all.min.css")}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset("dist/css/adminlte.min.css")}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet"
    href="{{asset("plugins/overlayScrollbars/css/OverlayScrollbars.min.css")}}">

    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset("plugins/datatables-bs4/css/dataTables.bootstrap4.min.css")}}">
    <link rel="stylesheet" href="{{asset("plugins/datatables-responsive/css/responsive.bootstrap4.min.css")}}">
    <link rel="stylesheet" href="{{asset("plugins/datatables-buttons/css/buttons.bootstrap4.min.css")}}">
</head>

<body class="hold-transition sidebar-mini layout-fixed">

  <div class="wrapper">

    <!-- Preloader -->
{{--    <div class="preloader flex-column justify-content-center align-items-center">--}}
{{--      <img class="animation__shake" src="{{asset("dist/img/AdminLTELogo.png")}}" alt="AdminLTELogo"--}}
{{--        height="60" width="60">--}}
{{--    </div>--}}

    <!-- Navbar -->
    @include('partials.nav')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img src="{{asset("dist/img/AdminLTELogo.png")}}" alt="AdminLTE Logo"
          class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
      </a>

        <!-- Sidebar -->
    @include('partials.sidebar')
    <!-- /.sidebar -->
    </aside>


    @yield('content')

  <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
          <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->

  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="{{asset("plugins/jquery/jquery.min.js")}}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{asset("plugins/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
  <!-- overlayScrollbars -->
  <script src="{{asset("plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js")}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset("dist/js/adminlte.js")}}"></script>

  <!-- DataTables  & Plugins -->
  <script src="{{ asset("plugins/datatables/jquery.dataTables.min.js")}}"></script>
  <script src="{{ asset("plugins/datatables-bs4/js/dataTables.bootstrap4.min.js")}}"></script>
  <script src="{{ asset("plugins/datatables-responsive/js/dataTables.responsive.min.js")}}"></script>
  <script src="{{ asset("plugins/datatables-responsive/js/responsive.bootstrap4.min.js")}}"></script>
  <script src="{{ asset("plugins/datatables-buttons/js/dataTables.buttons.min.js")}}"></script>
  <script src="{{ asset("plugins/datatables-buttons/js/buttons.bootstrap4.min.js")}}"></script>
  <script src="{{ asset("plugins/jszip/jszip.min.js")}}"></script>
  <script src="{{ asset("plugins/pdfmake/pdfmake.min.js")}}"></script>
  <script src="{{ asset("plugins/pdfmake/vfs_fonts.js")}}"></script>
  <script src="{{ asset("plugins/datatables-buttons/js/buttons.html5.min.js")}}"></script>
  <script src="{{ asset("plugins/datatables-buttons/js/buttons.print.min.js")}}"></script>
  <script src="{{ asset("plugins/datatables-buttons/js/buttons.colVis.min.js")}}"></script>


  @stack('scripts')
</body>
</html>
