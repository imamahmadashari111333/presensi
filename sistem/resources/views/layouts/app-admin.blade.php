<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="Presensi Olnine Universitas Harapan Bangsa" />
  <meta name="author" content="Fakultas Sains dan Teknologi - Universitas Harapan Bangsa" />
  <link rel="shortcut icon" href="{{asset('img/icon/logo.png')}}">
  <title>Admin Sistem Presensi Online Universitas Harapan Bangsa</title>
  <link href="{{asset('assets/css/styles.css')}}" rel="stylesheet" />
  <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
  <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand" href="{{url('/dashboard')}}">DASHBOARD</a><button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">

    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i> {{ Auth::user()->name}}</a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="{{url('/biodata')}}"><i class="fa fa-fw fa-user"></i>  Biodata</a>

          <a class="dropdown-item" href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-fw fa-sign-out"></i> Logout</a>
          <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
          {{ csrf_field() }}</form>
        </div>
      </li>
    </ul>
  </nav>
  <div id="layoutSidenav">
    <div id="layoutSidenav_nav" class="d-print-none">
      <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
          <div class="nav">
            <div class="sb-sidenav-menu-heading">Core</div>
            <a class="nav-link" href="{{url('/dashboard')}}"
            ><div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
          Dashboard</a>
          <div class="sb-sidenav-menu-heading">Presensi</div>
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts"
          ><div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
          Manajemen Presensi
          <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div
            ></a>
            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
              <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link" href="{{url('/jam-masuk')}}">Jam Kerja</a>
                <a class="nav-link" href="{{url('/ijin-cuti')}}">Ijin Kerja</a>
                <a class="nav-link" href="{{url('/presensi')}}">Presensi Kerja</a>
              </nav>
            </div>
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages"
            ><div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
            Laporan Presensi
            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div
              ></a>
              <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                  <a class="nav-link" href="{{url('/jumlah-kehadiran')}}">Jumlah Kehadiran</a>
                  <!-- Cetak Presensi -->
                  <a class="nav-link" href="{{url('/detail-presensi')}}">Detail Presensi</a>
                </nav>
              </div>
              <div class="sb-sidenav-menu-heading">User</div>
              <a class="nav-link" href="{{url('/tambah-user')}}">
                <button type="button" class="btn btn-primary">
                 <i class="fa fa-plus"></i> Input User
               </button></a>
               <a class="nav-link" href="{{url('/admin')}}">
                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>Admin</a>
                <a class="nav-link" href="{{url('/kepala-unit')}}"
                ><div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
              Pimpinan</a>
              <a class="nav-link" href="{{url('/pegawai')}}"
              ><div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
            Pegawai</a>
          </div>
        </div>
      </nav>
    </div>
    <div id="layoutSidenav_content">
      <main>
        <div class="container-fluid">
          @yield('content')
        </div>
      </main>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="{{asset('assets/js/scripts.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
  <script src="{{asset('assets/js/datatables-demo.js')}}"></script>
</body>
</html>