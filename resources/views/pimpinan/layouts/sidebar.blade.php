      <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link" style="text-decoration: none;">
      <img src="{{ asset('hpm-logo-2.jpg') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">HPM</span>
    </a>
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a wire:navigate href="{{ route('pimpinan.dashboard.index') }}" class="nav-link  @yield('menuPimpinanDashboard')">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item ">
            <a wire:navigate href="{{ route('pimpinan.clients.index') }}" class="nav-link  @yield('menuPimpinanClients')">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Clients
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a wire:navigate href="{{ route('pimpinan.daftarsurat.index') }}" class="nav-link @yield('menuPimpinanDaftarSurat')">
              <i class="nav-icon fas fa-mail-bulk"></i>
              <p>
                Daftar Surat
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a wire:navigate href="{{ route('pimpinan.sphprogres.index') }}" class="nav-link @yield('menuPimpinanSphProgres')">
              <i class="nav-icon fas fa-history"></i>
              <p>
                Sph In Progres
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a wire:navigate href="{{ route('pimpinan.sphsuccess.index') }}" class="nav-link @yield('menuPimpinanSphSuccess')">
              <i class="nav-icon fas fa-check-circle"></i>
              <p>
                Sph Success
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a wire:navigate href="{{ route('pimpinan.sphgagal.index') }}" class="nav-link @yield('menuPimpinanSphGagal')">
              <i class="nav-icon fas fa-times-circle"></i>
              <p>
                Sph Gagal
              </p>
            </a>
          </li>
          

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
