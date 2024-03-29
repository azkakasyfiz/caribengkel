<!DOCTYPE html>
<html lang="en">
<head>

  <!-- SITE TITTLE -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>

  <!-- PLUGINS CSS STYLE -->
  <link href="/main/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet">
  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <!-- Font Awesome -->
  <link href="/fontawesome/css/all.css" rel="stylesheet"> <!--load all styles -->
  <link href="/main/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- CUSTOM CSS -->
  <link href="/main/css/style.css" rel="stylesheet">
  <link href="/search-box/css/main.css" rel="stylesheet" />

  <!-- FAVICON -->
  <link href="/main/img/favicon.png" rel="shortcut icon">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>

<body class="body-wrapper">
    <section class="navbar-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav class="navbar navbar-expand-lg navigation py-1">
                        <a class="navbar-brand" href="/">
                            <img src="/main/images/logo.png" style="height:90px; width:auto" alt="">
                        </a>
                        <button class="navbar-toggler toggler-example" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="dark-blue-text"><i class="fas fa-bars fa-1x"></i></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto main-nav">
                              @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Sign Up') }}</a>
                                    </li>
                                @endif
                                @else
                                <li class="nav-item dropdown dropdown-slide">
                                    <a class="nav-link dropdown-toggle" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }} <span><i class="fa fa-angle-down"></i></span>
                                    </a>
                                    <!-- Dropdown list -->
                                    <div class="dropdown-menu dropdown-menu-right">
                                        @if (auth()->user()->role == "consumer")
                                        <a class="dropdown-item" href="/wishlist">Wishlist</a>
                                        @endif
                                        @if (auth()->user()->role == "consumer")
                                        <a class="dropdown-item" href="/keranjang">Keranjang</a>
                                        @endif
                                        @if (auth()->user()->role == "consumer")
                                        <a class="dropdown-item" href="/bengkel-favorit">Bengkel Favorit</a>
                                        @endif
                                        @if (auth()->user()->role == "consumer")
                                        <a class="dropdown-item" href="/pesantowing">Pesan Towing</a>
                                        @endif
                                        @if (auth()->user()->role == "consumer")
                                        <a class="dropdown-item" href="/statustowing">Status Towing</a>
                                        @endif
                                        @if (auth()->user()->role == "admin")
                                        <a class="dropdown-item" href="/dashboard">List Barang</a>
                                        @endif
                                        @if (auth()->user()->role == "admin")
                                        <a class="dropdown-item" href="/admin">Input Barang</a>
                                        @endif
                                        @if (auth()->user()->role == "admin")
                                        <a class="dropdown-item" href="/inputspecialties">Input Specialties</a>
                                        @endif
                                        @if (auth()->user()->role == "admin")
                                        <a class="dropdown-item" href="/listpesanan">List Pesanan</a>
                                        @endif
                                        @if (auth()->user()->role == "towing")
                                        <a class="dropdown-item" href="/admintowing">Dasboard Towing</a>
                                        @endif
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                          onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                              @endguest
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    @yield('content')
<!--============================
=            Footer            =
=============================-->

<!-- Footer Bottom -->
<footer class="footer-bottom">
    <!-- Container Start -->
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-12">
          <!-- Copyright -->
          <div class="copyright">
            <p>Copyright © 2020. caribengkel.id | All Rights Reserved</p>
          </div>
        </div>
        <div class="col-sm-6 col-12">
          <!-- Social Icons -->
          <ul class="social-media-icons text-right">
              <li><a class="fa fa-facebook" href=""></a></li>
              <li><a class="fa fa-twitter" href=""></a></li>
              <li><a class="fa fa-pinterest-p" href=""></a></li>
              <li><a class="fa fa-vimeo" href=""></a></li>
            </ul>
        </div>
      </div>
    </div>
    <!-- Container End -->
</footer>
<!-- JAVASCRIPTS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="/main/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="/main/plugins/tether/js/tether.min.js"></script>
<script src="/main/plugins/raty/jquery.raty-fa.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCC72vZw-6tGqFyRhhg5CkF2fqfILn2Tsw"></script>
<script src="/main/js/scripts.js"></script>
<script src="/search-box/js/extention/choices.js"></script>


</body>

</html>