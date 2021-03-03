<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- <link href="https://fonts.googleapis.com/css2?family=Mukta:wght@400;800&display=swap" rel="stylesheet"> -->

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/c7890ac5ad.js" crossorigin="anonymous"></script>

    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

    <!-- Font Awesome JS -->
    <!-- <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script> -->
    <script src="https://kit.fontawesome.com/c7890ac5ad.js" crossorigin="anonymous"></script>

</head>

<body>

    <div class="wrapper" id="app">
      <admin>
        <!-- Sidebar  -->
        <nav id="sidebar" class="check-active-link" :class="{active: isToggeled}">
            <div class="sidebar-header">
                <span class="f-30 font-weight-bold">MitLeaf</span>
                <span class="float-right sidebar-toggle-btn">
                  <button type="button" id="sidebarCollapse" class="btn bg-theme text-white" @click="toggleSidebar">
                      <i class="fas fa-chevron-left"></i>
                  </button>
                </span>
            </div>

            <ul class="list-unstyled components">
                @guest


                @else

                <p>Welcome {{Auth()->user()->name}}</p>

                @if(Auth()->user()->role_id == 1)
                  @include('layouts._admin_menus')
                @endif

                @include('layouts._user_menus')
                @include('layouts._affilate_menus')

                @endguest

            </ul>

            <ul class="list-unstyled CTAs">
                <li>
                    <a href="#" class="download">Download source</a>
                </li>
                <li>
                    <a href="#" class="article">Back to article</a>
                </li>
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content" :class="{active: isToggeled}">

            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom sticky-top">

              <button type="button" id="sidebarCollapse" class="btn bg-theme text-white" @click="toggleSidebar">
                  <i class="fas fa-align-left"></i>
                  <span>Menus</span>
              </button>

              <!-- <button class="btn btn-primary" id="menu-toggle" @click="toggleSidebar">
                <i class="fas fa-bars"></i>
              </button> -->

              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>

              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto mt-2 mt-lg-0">

                  @guest

                  @else
                    <li class="nav-item active">
                      <a class="nav-link" href="{{url('/home')}}">Home <span class="sr-only">(current)</span></a>
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

            @yield('content')

        </div>
      </admin>
    </div>

</body>

</html>
