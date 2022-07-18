<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
      <div class="sidebar-brand-icon">
          <i class="fas fa-microscope"></i>
      </div>
      <div class="sidebar-brand-text mx-3">SIMANIS<sup>v1</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
      <a class="nav-link" href={{ url('/') }}>
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    {{--<hr class="sidebar-divider">--}}

    <!-- Heading -->
    {{--<div class="sidebar-heading">
      Interface
    </div>--}}

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-database"></i>
        <span>Master Data</span>
      </a>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Master Data:</h6>
            <a class="collapse-item" href="{{ url('alat/') }}">Alat</a>
            <a class="collapse-item" href="{{ url('alatruangan/') }}">Alat Ruangan</a>
            <a class="collapse-item" href="{{ url('ruangan/') }}">Ruangan</a>
            <a class="collapse-item" href="{{ url('ruangankategori/') }}">Ruangan Kategori</a>
        </div>
      </div>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href={{ url('/inspeksi') }}>
            <i class="far fa-calendar-alt"></i>
            <span>Jadwal Inspeksi</span></a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href={{ url('/kalibrasi') }}>
            <i class="far fa-calendar-alt"></i>
            <span>Jadwal Kalibrasi</span></a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href={{ url('/perbaikan') }}>
            <i class="fas fa-tools"></i>
            <span>Perbaikan Alat</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
            <i class="fas fa-fw fa-table"></i>
            <span>Laporan</span>
        </a>
        <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Laporan:</h6>
                <a class="collapse-item" href="{{ url('report-kerusakan/') }}">Laporan Kerusakan Alat</a>
                <a class="collapse-item" href="{{ url('report-kalibrasi/') }}">Laporan Kalibrasi Alat</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

  </ul>
