<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title') - {{ config('app.name', 'Reservasi Bordir Online') }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="/assets/material/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="/assets/material/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="/assets/material/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="/assets/material/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="/assets/material/dist/css/bootstrap-material-design.min.css">
  <link rel="stylesheet" href="/assets/material/dist/css/ripples.min.css">
  <link rel="stylesheet" href="/assets/material/dist/css/MaterialAdminLTE.min.css">
  <link rel="stylesheet" href="/assets/material/dist/css/skins/all-md-skins.min.css">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  @stack('header')
</head>

<body class="hold-transition skin-blue-light sidebar-mini">
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="#" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">R<b>B</b>O</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">Reservasi<b>Bordir</b>Online</span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                @if(auth()->user()->foto != null)
                <img src="/uploads/{{auth()->user()->foto}}" class="user-image" alt="User Image">
                @else
                <img src="/assets/images/user.png" class="user-image" alt="User Image">
                @endif
                <span class="hidden-xs">{{ucwords(Auth::user()->name)}}</span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  @if(auth()->user()->foto != null)
                  <img src="/uploads/{{auth()->user()->foto}}" class="img-circle" alt="User Image">
                  @else
                  <img src="/assets/images/user.png" class="img-circle" alt="User Image">
                  @endif
                  <p>{{ucwords(Auth::user()->name)}}<small>{{ucwords(Auth::user()->role)}}</small></p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="{{ route('profile')}}" class="btn btn-default btn-flat">Profile</a>
                  </div>
                  <div class="pull-right">
                    <a href="{{ route('logout') }}"
                      onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                      class="btn btn-default btn-flat">Sign out</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                    </form>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            @if(auth()->user()->foto != null)
            <img src="/uploads/{{auth()->user()->foto}}" class="img-circle" alt="User Image">
            @else
            <img src="/assets/images/user.png" class="img-circle" alt="User Image">
            @endif
          </div>
          <div class="pull-left info">
            <p style="color:black;">{{ucwords(Auth::user()->name)}}</p>
            <a style="color:black;" href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">MAIN NAVIGATION</li>
          <li
            class="{{Route::currentRouteName() == 'dashboard.index' || Route::currentRouteName() == 'dashboard' ? 'active' : ''}}">
            <a href="{{route('dashboard.index')}}">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
          </li>
          @if(Auth::user()->role == 'admin')
          <li
            class="{{ Route::currentRouteName() == 'user.index' || Route::currentRouteName() == 'user.edit' ||Route::currentRouteName() == 'user.create'  ? 'active' : '' }}">
            <a href="{{route('user.index')}}">
              <i class="fa fa-users"></i> <span>Data Users</span>
            </a>
          </li>
          <li>
            <a href="{{route('dashboard.lapTransaksi')}}">
              <i class="fa fa-file"></i> <span>Laporan Transaksi</span>
            </a>
          </li>
          <li>
            <a href="{{route('dashboard.lapPesanan')}}">
              <i class="fa fa-file"></i> <span>Laporan Pesanan</span>
            </a>
          </li>
          <li>
            <a href="{{route('dashboard.lapUser')}}">
              <i class="fa fa-file"></i> <span>Laporan User</span>
            </a>
          </li>
          @endif
          @if(Auth::user()->role == 'pemilik')
          <li
            class="{{ Route::currentRouteName() == 'toko.index' || Route::currentRouteName() == 'toko.edit' ||Route::currentRouteName() == 'toko.create'  ? 'active' : '' }}">
            <a href="{{route('toko.index')}}">
              <i class="fa fa-building-o"></i> <span>Data Toko</span>
            </a>
          </li>
          <li
            class="{{ Route::currentRouteName() == 'product.index' || Route::currentRouteName() == 'product.edit' ||Route::currentRouteName() == 'product.create'  ? 'active' : '' }}">
            <a href="{{route('product.index')}}">
              <i class="fa fa-cubes"></i> <span>Data Produk</span>
            </a>
          </li>
          <li
            class="{{ Route::currentRouteName() == 'order.index' || Route::currentRouteName() == 'order.edit' ||Route::currentRouteName() == 'order.create'  ? 'active' : '' }}">
            <a href="{{route('order.index')}}">
              <i class="fa fa-cubes"></i> <span>Data Order</span>
            </a>
          </li>
          <li
            class="{{ Route::currentRouteName() == 'transaksi.index' || Route::currentRouteName() == 'transaksi.edit' ||Route::currentRouteName() == 'transaksi.create'  ? 'active' : '' }}">
            <a href="{{route('transaksi.index')}}">
              <i class="fa fa-refresh"></i> <span>Data Transaksi</span>
            </a>
          </li>
          <li
            class="{{ Route::currentRouteName() == 'rekening.index' || Route::currentRouteName() == 'rekening.edit' ||Route::currentRouteName() == 'rekening.create'  ? 'active' : '' }}">
            <a href="{{route('rekening.index')}}">
              <i class="fa fa-credit-card"></i> <span>Data Rekening</span>
            </a>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-file"></i>
              <span>Laporan</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{route('dashboard.lapTransaksi')}}"><i class="fa fa-circle-o"></i> Laporan Transaksi</a>
              </li>
              <li><a href="{{route('dashboard.lapPesanan')}}"><i class="fa fa-circle-o"></i> Laporan Pesanan</a></li>
            </ul>
          </li>
          @endif
          <!-- @if(Auth::user()->role == 'pelanggan')
        <li class="{{ Route::currentRouteName() == 'toko.index' || Route::currentRouteName() == 'toko.edit' ||Route::currentRouteName() == 'toko.create'  ? 'active' : '' }}">
          <a href="">
            <i class="fa fa-building-o"></i> <span>Data Toko</span>
          </a>
        </li>
        <li class="{{ Route::currentRouteName() == 'order.index' || Route::currentRouteName() == 'order.edit' ||Route::currentRouteName() == 'order.create'  ? 'active' : '' }}">
          <a href="">
            <i class="fa fa-building-o"></i> <span>Data Pesanan</span>
          </a>
        </li>
        @endif -->
          <li
            class="{{ Route::currentRouteName() == 'cost.all' ||Route::currentRouteName() == 'cost.create' ||Route::currentRouteName() == 'cost.edit' ? 'active' : '' }}">
            <a href="{{ route('logout') }}"
              onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                class="fa fa-sign-out"></i><span>Keluar</span></a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </li>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Main content -->
      <section class="content">
        <h3 style="margin-top:0px;">@yield('title')</h3>
        @yield('content')
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong>Copyright &copy; {{date('Y')}} </strong>
    </footer>
    <div class="control-sidebar-bg"></div>
  </div>
  <!-- ./wrapper -->

  <!-- jQuery 3 -->
  <script src="/assets/material/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="/assets/material/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- Material Design -->
  <script src="/assets/material/dist/js/material.min.js"></script>
  <script src="/assets/material/dist/js/ripples.min.js"></script>
  <script>
    $.material.init();
  </script>
  <script src="/assets/material/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <script src="/assets/material/bower_components/fastclick/lib/fastclick.js"></script>
  <script src="/assets/material/dist/js/adminlte.min.js"></script>
  <script src="/assets/material/dist/js/demo.js"></script>
  <script type="text/javascript">
    //logout
  $(document).ready(function() {
  $('#keluar').on('show.bs.modal', function(e) {
  $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
  });
  });
  </script>
  @stack('footer')
  <div class="modal fade" id="keluar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body text-center">
          <b>Anda yakin ingin sign out?</b>
          <br><br>
          <a class="btn btn-danger btn-ok"> Yakin dong</a><button type="button" class="btn btn-primary"
            data-dismiss="modal"><i class="fa fa-close"></i> Gak jadi</button>
        </div>
      </div>
    </div>

</body>

</html>