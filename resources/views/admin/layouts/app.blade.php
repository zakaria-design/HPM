<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>HPM | @yield('title')</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])

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
