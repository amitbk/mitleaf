<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style8.css') }}" rel="stylesheet">
    <link href="{{ asset('css/simple-sidebar.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/c7890ac5ad.js" crossorigin="anonymous"></script>
</head>
<body>
    <div id="app">
      <div class="d-flex" :class="{toggled: isToggeled}" id="wrapper">

        <!-- Sidebar -->
        <div class="bg-light border-right" id="sidebar-wrapper">
          <div class="sidebar-heading">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>

            <button id="menu-toggle" type="button" class="btn btn-info float-right text-white" @click="toggleSidebar">
              <i class="fas fa-arrow-left"></i>
            </button>


          </div>
          <div class="sidebar_card">
            {{ Auth::user()->name }} <br>
            {{ Auth::user()->email }}
          </div>
          <div class="list-group list-group-flush">
            <a href="{{route('admin')}}" class="list-group-item list-group-item-action bg-light">
              <i class="fas fa-tachometer-alt"></i> Dashboard</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">
              <i class="fas fa-bars"></i> Menus</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">
              <i class="fas fa-ice-cream"></i> Items</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">
              <i class="fas fa-lightbulb"></i> Offers</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">
              <i class="fas fa-images"></i> Banners</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">
              <i class="fas fa-hand-holding-usd "></i> Orders</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">
              <i class="fas fa-users"></i> Users</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">
              <i class="fas fa-sms"></i> SMS</a>

          </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">

          <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
            <button class="btn btn-primary" id="menu-toggle" @click="toggleSidebar">
              <i class="fas fa-bars"></i>
            </button>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ml-auto mt-2 mt-lg-0">

                @guest

                @else
                  <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      {{ !!Auth::user()->name ? Auth::user()->name : ( !!Auth::user()->mobile ? Auth::user()->mobile : 'No name' ) }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>

                  </li>
                @endguest
              </ul>
            </div>
          </nav>

          <main class="py-4">
              @yield('content')
          </main>
        </div>
        <!-- /#page-content-wrapper -->

      </div>
      <!-- /#wrapper -->

    </div>

</body>
</html>
