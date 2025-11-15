<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>HPM | @yield('title')</title>
  <!-- jQuery -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- AdminLTE -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>




{{-- sweet alert 2 --}}
<script src="{{ asset('sweetalert2/dist/sweetalert2.all.min.js') }}"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
  @include('admin.layouts.script')
      <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
{{-- semua link --}}
    @include('admin.layouts.style')

    @livewireStyles
  
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">


<div class="wrapper">
<!-- Navbar -->
    @include('admin.layouts.navbar')

<!-- Sidebar -->
    @include('admin.layouts.sidebar')

<!-- Content  -->
    @yield('content')

{{-- footer --}}
    @include('admin.layouts.footer')

</div>

<!-- jQuery -->


    @livewireScripts

</body>
</html>
