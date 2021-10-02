<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title') - {{ config('app.name', 'Reservasi Bordir Online') }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="/assets/dashboard/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="/assets/dashboard/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="/assets/dashboard/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="/assets/dashboard/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="/assets/dashboard/dist/css/bootstrap-material-design.min.css">
  <link rel="stylesheet" href="/assets/dashboard/dist/css/ripples.min.css">
  <link rel="stylesheet" href="/assets/dashboard/dist/css/MaterialAdminLTE.min.css">
  <link rel="stylesheet" href="/assets/dashboard/dist/css/skins/all-md-skins.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
@stack('header')
</head>
@if(Auth::user()->role == 'admin')
<body class="hold-transition skin-yellow-light sidebar-mini">
@endif
@if(Auth::user()->role == 'pelanggan')
<body class="hold-transition skin-blue-light sidebar-mini">
@endif
@if(Auth::user()->role == 'pembordir')
<body class="hold-transition skin-blue-light sidebar-mini">
@endif
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
              <img src="/assets/dashboard/dist/img/user-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs">{{ ucwords(Auth::user()->name) }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header" style="color:black;">
                <img src="/assets/dashboard/dist/img/user-160x160.jpg" class="img-circle" alt="User Image">
                <p style="color:black">{{ ucwords(Auth::user()->name) }}<small>{{ ucwords(Auth::user()->role) }}</small></p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-default btn-flat">Sign out</a>
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
          <img src="/assets/dashboard/dist/img/user-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ ucwords(Auth::user()->name) }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="{{ Route::currentRouteName() == 'accounting.all' || Route::currentRouteName() == 'accounting.edit' ||Route::currentRouteName() == 'accounting.create'  ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-balance-scale"></i> <span>Accounting</span>
            <span class="pull-right-container">
              <!-- <small class="label pull-right bg-green">new</small> -->
            </span>
          </a>
        </li>
        <li class="{{ Route::currentRouteName() == 'cost.all' ||Route::currentRouteName() == 'cost.create' ||Route::currentRouteName() == 'cost.edit' ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-money"></i> <span>Cost</span>
            <span class="pull-right-container">
              <!-- <small class="label pull-right bg-green">new</small> -->
            </span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
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
<script src="/assets/dashboard/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="/assets/dashboard/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Material Design -->
<script src="/assets/dashboard/dist/js/material.min.js"></script>
<script src="/assets/dashboard/dist/js/ripples.min.js"></script>
<script>
    $.material.init();
</script>
<script src="/assets/dashboard/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="/assets/dashboard/bower_components/fastclick/lib/fastclick.js"></script>
<script src="/assets/dashboard/dist/js/adminlte.min.js"></script>
<script src="/assets/dashboard/dist/js/demo.js"></script>
<script src="/assets/frontend/js/main.js"></script>
@stack('footer')
</body>
</html>
