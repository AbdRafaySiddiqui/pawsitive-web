
<!DOCTYPE html>
<html>
  <head>
    <title>{{ config('app.name') }}</title>
    <meta charset="utf-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <meta content="template language" name="keywords">
    <meta content="Tamerlan Soziev" name="author">
    <meta content="Admin dashboard html template" name="description">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link href="favicon.png" rel="shortcut icon">
    <link href="apple-touch-icon.png" rel="apple-touch-icon">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500" rel="stylesheet" type="text/css">
    <link href="{{asset('public/bower_components/select2/dist/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/bower_components/select2/dist/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">
    <link href="{{asset('public/css/main.css?version=4.4.0')}}" rel="stylesheet">
    <link href="{{asset('public/bower_components/slick-carousel/slick/slick.css')}}" rel="stylesheet">
    <link href="{{asset('public/bower_components/perfect-scrollbar/css/perfect-scrollbar.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/bower_components/fullcalendar/dist/fullcalendar.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/bower_components/dropzone/dist/dropzone.css')}}" rel="stylesheet">
    <link href="{{asset('public/bower_components/custom/style.css')}}" rel="stylesheet">

  </head>
  <body class="menu-position-side menu-side-left full-screen color-scheme-dark">
    <div class="all-wrapper solid-bg-all">
      <!--------------------
      START - Top Bar
      -------------------->
      <div class="top-bar color-scheme-dark">
        <div class="logo-w menu-size">
          <a class="logo" href="index.html">
            <div class="logo-element"></div>
            <div class="logo-label">
              {{ config('app.name') }}
            </div>
          </a>
        </div>
        
        <!--------------------
        START - Top Menu Controls
        -------------------->
        <div class="top-menu-controls">
          <div class="element-search autosuggest-search-activator">
            <input placeholder="Start typing to search..." type="text">
          </div>
          <!--------------------
          START - Messages Link in secondary top menu
          -------------------->
          <!--------------------
          END - Messages Link in secondary top menu
          --------------------><!--------------------
          START - Settings Link in secondary top menu
          -------------------->
          <div class="top-icon top-settings os-dropdown-trigger os-dropdown-position-left">
            <i class="os-icon os-icon-ui-46"></i>
            <div class="os-dropdown">
              <div class="icon-w">
                <i class="os-icon os-icon-ui-46"></i>
              </div>
              <ul>
                <li>
                  <a href="users_profile_small.html"><i class="os-icon os-icon-ui-49"></i><span>Profile Settings</span></a>
                </li>
                
                <li>
                  <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <a><button class="trans_btn" type="submit"> <i class="os-icon os-icon-signs-11"></i><span>Logout</span></button></a>
                  </form>
                </li>
              </ul>
            </div>
          </div>
          <!--------------------
          END - Settings Link in secondary top menu
          --------------------><!--------------------
          START - User avatar and menu in secondary top menu
          -------------------->
          <div class="logged-user-w">
            <div class="logged-user-i">
              <div class="avatar-w">
                <img alt="" src="{{ asset('public/img/avatar1.jpg') }}">
              </div>
              <div class="logged-user-menu color-style-dark">
                <div class="logged-user-avatar-info">
                  <div class="avatar-w">
                    <img alt="" src="{{ asset('public/img/avatar1.jpg') }}">
                  </div>
                  <div class="logged-user-info-w">
                    <div class="logged-user-name">
                      {{ Auth::user()->name }}
                    </div>
                    <div class="logged-user-role">
                      {{ Auth::user()->user_role()->name }}
                    </div>
                  </div>
                </div>
                <div class="bg-icon">
                  <i class="os-icon os-icon-wallet-loaded"></i>
                </div>
                <ul>
                  <li>
                    <a href="users_profile_big.html"><i class="os-icon os-icon-user-male-circle2"></i><span>Profile Details</span></a>
                  </li>
                  <li>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                      @csrf
                      <a><button class="trans_btn" type="submit"> <i class="os-icon os-icon-signs-11"></i><span>Logout</span></button></a>
                    </form>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <!--------------------
          END - User avatar and menu in secondary top menu
          -------------------->
        </div>
        <!--------------------
        END - Top Menu Controls
        -------------------->
      </div>
      <!--------------------
      END - Top Bar
      -------------------->
      
      <div class="layout-w">
        <!--------------------
        START - Mobile Menu
        -------------------->
        <div class="menu-mobile menu-activated-on-click color-scheme-dark">
          <div class="mm-logo-buttons-w">
            <a class="mm-logo" href="index.html"><img src="{{ asset('public/img/logo.png') }}"><span>{{ config('app.name') }}</span></a>
            <div class="mm-buttons">
              <div class="content-panel-open">
                <div class="os-icon os-icon-grid-circles"></div>
              </div>
              <div class="mobile-menu-trigger">
                <div class="os-icon os-icon-hamburger-menu-1"></div>
              </div>
            </div>
          </div>
          <div class="menu-and-user">
            <div class="logged-user-w">
              <div class="avatar-w">
                <img alt="" src="{{ asset('public/img/avatar1.jpg') }}">
              </div>
              <div class="logged-user-info-w">
                <div class="logged-user-name">
                  {{ Auth::user()->name }}
                </div>
                <div class="logged-user-role">
                  {{ Auth::user()->user_role->name }}
                </div>
              </div>
            </div>
            <!--------------------
            START - Mobile Menu List
            -------------------->
            <ul class="main-menu">
              <li class="selected">
                <a href="{{ route('dashboard') }}">
                  <div class="icon-w">
                    <div class="os-icon os-icon-layout"></div>
                  </div>
                  <span>Dashboard</span></a>
              </li>
              <li class=" has-sub-menu">
                <a href="#">
                  <div class="icon-w">
                    <div class="os-icon os-icon-layers"></div>
                  </div>
                  <span>Club</span></a>
                <ul class="sub-menu">
                  <li>
                    <a href="{{route('club.create')}}">Add Club</a>
                    <a href="{{route('club.index')}}">All Club</a>
                  </li>
                  
                </ul>
              </li>
              <li class=" has-sub-menu">
                <a href="#">
                  <div class="icon-w">
                    <div class="os-icon os-icon-layers"></div>
                  </div>
                  <span>Judges</span></a>
                <ul class="sub-menu">
                  <li>
                    <a href="{{route('judges.create')}}">Add Judges</a>
                    <a href="{{route('judges.index')}}">All Judges</a>
                  </li>
                  
                </ul>
              </li>
              <li class=" has-sub-menu">
                <a href="#">
                  <div class="icon-w">
                    <div class="os-icon os-icon-layers"></div>
                  </div>
                  <span>Breeds</span></a>
                <ul class="sub-menu">
                  <li>
                    <a href="{{route('breeds.create')}}">Add Breeds</a>
                    <a href="{{route('breeds.index')}}">All Breeds</a>
                  </li>
                  
                </ul>
              </li>
              <li class=" has-sub-menu">
                <a href="#">
                  <div class="icon-w">
                    <div class="os-icon os-icon-layers"></div>
                  </div>
                  <span>Dogs</span></a>
                <ul class="sub-menu">
                  <li>
                    <a href="{{route('dogs.create')}}">Add Dogs</a>
                    <a href="{{route('dogs.index')}}">All Dogs</a>
                  </li>
                  
                </ul>
              </li>
            </ul>
            <!--------------------
            END - Mobile Menu List
            -------------------->
            
          </div>
        </div>
        <!--------------------
        END - Mobile Menu
        --------------------><!--------------------
        START - Main Menu
        -------------------->
        <div class="menu-w menu-position-side menu-side-left menu-layout-compact sub-menu-style-over sub-menu-color-bright menu-activated-on-hover menu-has-selected-link color-scheme-dark color-style-transparent selected-menu-color-bright">
          <div class="logged-user-w avatar-inline">
            <div class="logged-user-i">
              <div class="avatar-w">
                <img alt="" src="{{ asset('public/img/avatar1.jpg') }}">
              </div>
              <div class="logged-user-info-w">
                <div class="logged-user-name">
                  {{ Auth::user()->name }}
                </div>
                <div class="logged-user-role">
                  {{ Auth::user()->user_role->name }}
                </div>
              </div>
              <div class="logged-user-toggler-arrow">
                <div class="os-icon os-icon-chevron-down"></div>
              </div>
              <div class="logged-user-menu color-style-bright">
                <div class="logged-user-avatar-info">
                  <div class="avatar-w">
                    <img alt="" src="{{ asset('public/img/avatar1.jpg') }}">
                  </div>
                  <div class="logged-user-info-w">
                    <div class="logged-user-name">
                      {{ Auth::user()->name }}
                    </div>
                    <div class="logged-user-role">
                      {{ Auth::user()->user_role->name }}
                    </div>
                  </div>
                </div>
                <div class="bg-icon">
                  <i class="os-icon os-icon-wallet-loaded"></i>
                </div>
                <ul>
                  <li>
                    <a href="users_profile_big.html"><i class="os-icon os-icon-user-male-circle2"></i><span>Profile Details</span></a>
                  </li>
                  <li>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                      @csrf
                      <a><button class="trans_btn" type="submit"><i class="os-icon os-icon-signs-11"></i><span>Logout</span></button></a>
                    </form>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          
          <div class="element-search autosuggest-search-activator">
            <input placeholder="Start typing to search..." type="text">
          </div>
          
          <ul class="main-menu">
            <li class="sub-header">
              <span>Main Menu</span>
            </li>
            <li class="selected">
              <a href="{{ route('dashboard') }}">
                <div class="icon-w">
                  <div class="os-icon os-icon-layout"></div>
                </div>
                <span>Dashboard</span></a>
            </li>
            <li class=" has-sub-menu">
              <a href="#">
                <div class="icon-w">
                  <div class="os-icon os-icon-layers"></div>
                </div>
                <span>Club</span></a>
              <div class="sub-menu-w">
                <div class="sub-menu-header">
                  Club
                </div>
                <div class="sub-menu-icon">
                  <i class="os-icon os-icon-layers"></i>
                </div>
                <div class="sub-menu-i">
                  <ul class="sub-menu">
                    <li>
                      <a href="{{route('club.create')}}">Add Club</a>
                      <a href="{{route('club.index')}}">All Club</a>
                    </li>
                    
                  </ul>
                </div>
              </div>
            </li>
            <li class=" has-sub-menu">
              <a href="#">
                <div class="icon-w">
                  <div class="os-icon os-icon-layers"></div>
                </div>
                <span>Judges</span></a>
              <div class="sub-menu-w">
                <div class="sub-menu-header">
                Judges
                </div>
                <div class="sub-menu-icon">
                  <i class="os-icon os-icon-layers"></i>
                </div>
                <div class="sub-menu-i">
                  <ul class="sub-menu">
                    <li>
                      <a href="{{route('judges.create')}}">Add Judges</a>
                      <a href="{{route('judges.index')}}">All Judges</a>
                    </li>
                    
                  </ul>
                </div>
              </div>
            </li>
            <li class=" has-sub-menu">
              <a href="#">
                <div class="icon-w">
                  <div class="os-icon os-icon-layers"></div>
                </div>
                <span>Breeds</span></a>
              <div class="sub-menu-w">
                <div class="sub-menu-header">
                Breeds
                </div>
                <div class="sub-menu-icon">
                  <i class="os-icon os-icon-layers"></i>
                </div>
                <div class="sub-menu-i">
                  <ul class="sub-menu">
                    <li>
                      <a href="{{route('breeds.create')}}">Add Breeds</a>
                      <a href="{{route('breeds.index')}}">All Breeds</a>
                    </li>
                    
                  </ul>
                </div>
              </div>
            </li>
            <li class=" has-sub-menu">
              <a href="#">
                <div class="icon-w">
                  <div class="os-icon os-icon-layers"></div>
                </div>
                <span>Dogs</span></a>
              <div class="sub-menu-w">
                <div class="sub-menu-header">
                Dogs
                </div>
                <div class="sub-menu-icon">
                  <i class="os-icon os-icon-layers"></i>
                </div>
                <div class="sub-menu-i">
                  <ul class="sub-menu">
                    <li>
                      <a href="{{route('dogs.create')}}">Add Dogs</a>
                      <a href="{{route('dogs.index')}}">All Dogs</a>
                    </li>
                    
                  </ul>
                </div>
              </div>
            </li>
          </ul>
          
        </div>
        <!--------------------
        END - Main Menu
        -------------------->

        @yield('content')

        <script src="{{asset('public/bower_components/jquery/dist/jquery.min.js')}}"></script>
        <script src="{{asset('public/bower_components/popper.js/dist/umd/popper.min.js')}}"></script>
        <script src="{{asset('public/bower_components/moment/moment.js')}}"></script>
        <script src="{{asset('public/bower_components/chart.js/dist/Chart.min.js')}}"></script>
        <script src="{{asset('public/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
        <script src="{{asset('public/bower_components/jquery-bar-rating/dist/jquery.barrating.min.js')}}"></script>
        <script src="{{asset('public/bower_components/ckeditor/ckeditor.js')}}"></script>
        <script src="{{asset('public/bower_components/bootstrap-validator/dist/validator.min.js')}}"></script>
        <script src="{{asset('public/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
        <script src="{{asset('public/bower_components/ion.rangeSlider/js/ion.rangeSlider.min.js')}}"></script>
        <script src="{{asset('public/bower_components/dropzone/dist/dropzone.js')}}"></script>
        <script src="{{asset('public/bower_components/editable-table/mindmup-editabletable.js')}}"></script>
        <script src="{{asset('public/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('public/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
        <script src="{{asset('public/bower_components/fullcalendar/dist/fullcalendar.min.js')}}"></script>
        <script src="{{asset('public/bower_components/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js')}}"></script>
        <script src="{{asset('public/bower_components/tether/dist/js/tether.min.js')}}"></script>
        <script src="{{asset('public/bower_components/slick-carousel/slick/slick.min.js')}}"></script>
        <script src="{{asset('public/bower_components/bootstrap/js/dist/util.js')}}"></script>
        <script src="{{asset('public/bower_components/bootstrap/js/dist/alert.js')}}"></script>
        <script src="{{asset('public/bower_components/bootstrap/js/dist/button.js')}}"></script>
        <script src="{{asset('public/bower_components/bootstrap/js/dist/carousel.js')}}"></script>
        <script src="{{asset('public/bower_components/bootstrap/js/dist/collapse.js')}}"></script>
        <script src="{{asset('public/bower_components/bootstrap/js/dist/dropdown.js')}}"></script>
        <script src="{{asset('public/bower_components/bootstrap/js/dist/modal.js')}}"></script>
        <script src="{{asset('public/bower_components/bootstrap/js/dist/tab.js')}}"></script>
        <script src="{{asset('public/bower_components/bootstrap/js/dist/tooltip.js')}}"></script>
        <script src="{{asset('public/bower_components/bootstrap/js/dist/popover.js')}}"></script>
        <script src="{{asset('public/js/demo_customizer.js?version=4.4.0')}}"></script>
        <script src="{{asset('public/js/main.js?version=4.4.0')}}"></script>
        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
          
          ga('create', 'UA-XXXXXXX-9', 'auto');
          ga('send', 'pageview');
        </script>
      </body>
    </html>