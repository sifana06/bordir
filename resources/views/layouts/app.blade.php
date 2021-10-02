<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title') - {{ config('app.name', 'Reservasi Bordir Online') }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="/assets/material/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/assets/material/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="/assets/material/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/assets/material/dist/css/AdminLTE.min.css">
  <!-- Material Design -->
  <link rel="stylesheet" href="/assets/material/dist/css/bootstrap-material-design.min.css">
  <link rel="stylesheet" href="/assets/material/dist/css/ripples.min.css">
  <link rel="stylesheet" href="/assets/material/dist/css/MaterialAdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="/assets/material/dist/css/skins/all-md-skins.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  @stack('header')
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue-light layout-top-nav">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
		  <a href="{{route('home')}}" class="navbar-brand">Reservasi<b>Bordir</b>Online</a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="{{ Route::currentRouteName() == 'home.index' || Route::currentRouteName() == 'home' ? 'active' : ''}}">
              <a href="{{route('home')}}">Dashboard <span class="sr-only">(current)</span></a>
            </li>
            <li class="{{ Route::currentRouteName() == 'toko.index' ? 'active' : ''}}">
              <a href="{{route('store.index')}}">Toko</a>
            </li>
            <li class="{{ Route::currentRouteName() == 'po.index' ? 'active' : ''}}">
                <a href="{{route('po.index')}}">Pesanan Saya</a>
            </li>
            <li>
                <a href="{{route('history.index')}}">History</a>
            </li>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                @if(auth()->user()->foto != null)
                  <img src="/uploads/{{auth()->user()->foto}}" class="user-image" alt="User Image">
                @else
                  <img src="/assets/images/user.png" class="user-image" alt="User Image">
                @endif
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs">{{ucwords(Auth::user()->name)}}</span>
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                @if(auth()->user()->foto != null)
                  <img src="/uploads/{{auth()->user()->foto}}" class="img-circle" alt="User Image">
                @else
                  <img src="/assets/images/user.png" class="img-circle" alt="User Image">
                @endif
                  <p>
                    {{ucwords(Auth::user()->name)}} - {{Auth::user()->role}}
                    <small>Join since {{date('j,F-Y')}}</small>
                  </p>
                </li>
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="{{route('profile')}}" class="btn btn-default btn-flat">Profile</a>
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
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          @yield('title')
        </h1>
      </section>

      <!-- Main content -->
      <section class="content">
        @yield('content')
        <!-- /.box -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="container">
      <strong>Copyright &copy; {{date('Y')}}.</strong>
    </div>
    <!-- /.container -->
  </footer>
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
<!-- SlimScroll -->
<script src="/assets/material/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/assets/material/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="/assets/material/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/assets/material/dist/js/demo.js"></script>
<script src="/assets/frontend/js/main.js"></script>
@stack('footer')
</body>
</html>
