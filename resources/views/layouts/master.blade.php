
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
    <link rel="stylesheet" href="{{asset('public/bower_components/summernote/summernote-bs4.css')}}">
    <link rel="stylesheet" href="{{asset('public/bower_components/jquery-selectric/selectric.css')}}">
    <link href="{{asset('public/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">
    <link href="{{asset('public/css/main.css?version=4.4.0')}}" rel="stylesheet">
    <link href="{{asset('public/bower_components/slick-carousel/slick/slick.css')}}" rel="stylesheet">
    <link href="{{asset('public/bower_components/perfect-scrollbar/css/perfect-scrollbar.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/bower_components/fullcalendar/dist/fullcalendar.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/bower_components/dropzone/dist/dropzone.css')}}" rel="stylesheet">
    <link href="{{asset('public/bower_components/custom/style.css')}}" rel="stylesheet">
    <!-- <link href="{{asset('public/select2-develop/dist/css/select2.min.css')}}" rel="stylesheet" /> -->
    <script src="{{asset('public/bower_components/jquery/dist/jquery.min.js')}}"></script>
    
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
          {{-- <div class="messages-notifications os-dropdown-trigger os-dropdown-position-left">
            <i class="os-icon os-icon-mail-14"></i>
            <div class="new-messages-count">
              12
            </div>
            <div class="os-dropdown light message-list">
              <ul>
                <li>
                  <a href="#">
                    <div class="user-avatar-w">
                      <img alt="" src="img/avatar1.jpg">
                    </div>
                    <div class="message-content">
                      <h6 class="message-from">
                        John Mayers
                      </h6>
                      <h6 class="message-title">
                        Account Update
                      </h6>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <div class="user-avatar-w">
                      <img alt="" src="img/avatar2.jpg">
                    </div>
                    <div class="message-content">
                      <h6 class="message-from">
                        Phil Jones
                      </h6>
                      <h6 class="message-title">
                        Secutiry Updates
                      </h6>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <div class="user-avatar-w">
                      <img alt="" src="img/avatar3.jpg">
                    </div>
                    <div class="message-content">
                      <h6 class="message-from">
                        Bekky Simpson
                      </h6>
                      <h6 class="message-title">
                        Vacation Rentals
                      </h6>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <div class="user-avatar-w">
                      <img alt="" src="img/avatar4.jpg">
                    </div>
                    <div class="message-content">
                      <h6 class="message-from">
                        Alice Priskon
                      </h6>
                      <h6 class="message-title">
                        Payment Confirmation
                      </h6>
                    </div>
                  </a>
                </li>
              </ul>
            </div>
          </div> --}}
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
                <img alt="" src="img/avatar1.jpg">
              </div>
              <div class="logged-user-menu color-style-dark">
                <div class="logged-user-avatar-info">
                  <div class="avatar-w">
                    <img alt="" src="img/avatar1.jpg">
                  </div>
                  <div class="logged-user-info-w">
                    <div class="logged-user-name">
                      {{ Auth::user()->name }}
                    </div>
                    <div class="logged-user-role">
                    {{ Auth::user()->user_role->name ?? '' }}
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
      {{-- <div class="search-with-suggestions-w">
        <div class="search-with-suggestions-modal">
          <div class="element-search">
            <input class="search-suggest-input" placeholder="Start typing to search..." type="text">
              <div class="close-search-suggestions">
                <i class="os-icon os-icon-x"></i>
              </div>
            </input>
          </div>
          <div class="search-suggestions-group">
            <div class="ssg-header">
              <div class="ssg-icon">
                <div class="os-icon os-icon-box"></div>
              </div>
              <div class="ssg-name">
                Projects
              </div>
              <div class="ssg-info">
                24 Total
              </div>
            </div>
            <div class="ssg-content">
              <div class="ssg-items ssg-items-boxed">
                <a class="ssg-item" href="users_profile_big.html">
                  <div class="item-media" style="background-image: url(img/company6.png)"></div>
                  <div class="item-name">
                    Integ<span>ration</span> with API
                  </div>
                </a><a class="ssg-item" href="users_profile_big.html">
                  <div class="item-media" style="background-image: url(img/company7.png)"></div>
                  <div class="item-name">
                    Deve<span>lopm</span>ent Project
                  </div>
                </a>
              </div>
            </div>
          </div>
          <div class="search-suggestions-group">
            <div class="ssg-header">
              <div class="ssg-icon">
                <div class="os-icon os-icon-users"></div>
              </div>
              <div class="ssg-name">
                Customers
              </div>
              <div class="ssg-info">
                12 Total
              </div>
            </div>
            <div class="ssg-content">
              <div class="ssg-items ssg-items-list">
                <a class="ssg-item" href="users_profile_big.html">
                  <div class="item-media" style="background-image: url(img/avatar1.jpg)"></div>
                  <div class="item-name">
                    John Ma<span>yer</span>s
                  </div>
                </a><a class="ssg-item" href="users_profile_big.html">
                  <div class="item-media" style="background-image: url(img/avatar2.jpg)"></div>
                  <div class="item-name">
                    Th<span>omas</span> Mullier
                  </div>
                </a><a class="ssg-item" href="users_profile_big.html">
                  <div class="item-media" style="background-image: url(img/avatar3.jpg)"></div>
                  <div class="item-name">
                    Kim C<span>olli</span>ns
                  </div>
                </a>
              </div>
            </div>
          </div>
          <div class="search-suggestions-group">
            <div class="ssg-header">
              <div class="ssg-icon">
                <div class="os-icon os-icon-folder"></div>
              </div>
              <div class="ssg-name">
                Files
              </div>
              <div class="ssg-info">
                17 Total
              </div>
            </div>
            <div class="ssg-content">
              <div class="ssg-items ssg-items-blocks">
                <a class="ssg-item" href="#">
                  <div class="item-icon">
                    <i class="os-icon os-icon-file-text"></i>
                  </div>
                  <div class="item-name">
                    Work<span>Not</span>e.txt
                  </div>
                </a><a class="ssg-item" href="#">
                  <div class="item-icon">
                    <i class="os-icon os-icon-film"></i>
                  </div>
                  <div class="item-name">
                    V<span>ideo</span>.avi
                  </div>
                </a><a class="ssg-item" href="#">
                  <div class="item-icon">
                    <i class="os-icon os-icon-database"></i>
                  </div>
                  <div class="item-name">
                    User<span>Tabl</span>e.sql
                  </div>
                </a><a class="ssg-item" href="#">
                  <div class="item-icon">
                    <i class="os-icon os-icon-image"></i>
                  </div>
                  <div class="item-name">
                    wed<span>din</span>g.jpg
                  </div>
                </a>
              </div>
              <div class="ssg-nothing-found">
                <div class="icon-w">
                  <i class="os-icon os-icon-eye-off"></i>
                </div>
                <span>No files were found. Try changing your query...</span>
              </div>
            </div>
          </div>
        </div>
      </div> --}}
      <div class="layout-w">
        <!--------------------
        START - Mobile Menu
        -------------------->
        <div class="menu-mobile menu-activated-on-click color-scheme-dark">
          <div class="mm-logo-buttons-w">
            <a class="mm-logo" href="index.html"><img src="img/logo.png"><span>{{ config('app.name') }}</span></a>
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
                <img alt="" src="img/avatar1.jpg">
              </div>
              <div class="logged-user-info-w">
                <div class="logged-user-name">
                  {{ Auth::user()->name }}
                </div>
                <div class="logged-user-role">
                  Administrator
                </div>
              </div>
            </div>
            <!--------------------
            START - Mobile Menu List
            -------------------->
            <ul class="main-menu">
              <li class="has-sub-menu">
                <a href="{{ route('dashboard') }}">
                  <div class="icon-w">
                    <div class="os-icon os-icon-layout"></div>
                  </div>
                  <span>Dashboard</span></a>
              </li>
              <li class="has-sub-menu">
                <a href="#">
                  <div class="icon-w">
                    <div class="os-icon os-icon-layers"></div>
                  </div>
                  <span>Club</span></a>
                <ul class="sub-menu">
                  <li>
                    <a href="{{route('club.create')}}">Add Club</a>
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
        <div class="menu-w menu-position-side menu-side-left menu-layout-compact sub-menu-style-flyout sub-menu-color-bright menu-activated-on-hover menu-has-selected-link color-scheme-dark color-style-transparent selected-menu-color-bright">
          <div class="logged-user-w avatar-inline">
            <div class="logged-user-i">
              <div class="avatar-w">
                <img alt="" src="img/avatar1.jpg">
              </div>
              <div class="logged-user-info-w">
                <div class="logged-user-name">
                  {{ Auth::user()->name }}
                </div>
                <div class="logged-user-role">
                  Administrator
                </div>
              </div>
              <div class="logged-user-toggler-arrow">
                <div class="os-icon os-icon-chevron-down"></div>
              </div>
              <div class="logged-user-menu color-style-bright">
                <div class="logged-user-avatar-info">
                  <div class="avatar-w">
                    <img alt="" src="img/avatar1.jpg">
                  </div>
                  <div class="logged-user-info-w">
                    <div class="logged-user-name">
                      {{ Auth::user()->name }}
                    </div>
                    <div class="logged-user-role">
                      Administrator
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
              <a href="{{route('club.index')}}">
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
                    @if(Auth::user()->hasRole('admin'))
    <a href="{{route('club.create')}}">Add Club</a>
@else
    <a href="{{route('club.create')}}">Writer Club</a>
@endif      
                      <a href="{{route('club.index')}}">All Club</a>
                    </li>
                    
                  </ul>
                </div>
              </div>
            </li>
            <li class=" has-sub-menu">
              <a href="{{route('judges.index')}}">
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
              <a href="{{route('breeds.index')}}">
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
              <a href="{{route('events.index')}}">
                <div class="icon-w">
                  <div class="os-icon os-icon-layers"></div>
                </div>
                <span>Events</span></a>
              <div class="sub-menu-w">
                <div class="sub-menu-header">
                Events
                </div>
                <div class="sub-menu-icon">
                  <i class="os-icon os-icon-layers"></i>
                </div>
                <div class="sub-menu-i">
                  <ul class="sub-menu">
                    <li>
                      <a href="{{route('events.create')}}">Add Events</a>
                      <a href="{{route('events.index')}}">All Events</a>
                    </li>
                    
                  </ul>
                </div>
              </div>
            </li>
            <li class=" has-sub-menu">
              <a href="{{route('events.index')}}">
                <div class="icon-w">
                  <div class="os-icon os-icon-layers"></div>
                </div>
                <span>Event Result</span></a>
              <div class="sub-menu-w">
                <div class="sub-menu-header">
                Event Result
                </div>
                <div class="sub-menu-icon">
                  <i class="os-icon os-icon-layers"></i>
                </div>
                <div class="sub-menu-i">
                  <ul class="sub-menu">
                    <li>
                      <a href="{{route('event_results.create')}}">Add Event Result</a>
                      <a href="{{route('event_results.index')}}">All Event Result</a>
                    </li>
                    
                  </ul>
                </div>
              </div>
            </li>
            <li class=" has-sub-menu">
              <a href="{{route('dogs.index')}}">
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
            <li class=" has-sub-menu">
              <a href="{{route('users.index')}}">
                <div class="icon-w">
                  <div class="os-icon os-icon-layers"></div>
                </div>
                <span>Users</span></a>
              <div class="sub-menu-w">
                <div class="sub-menu-header">
                Users
                </div>
                <div class="sub-menu-icon">
                  <i class="os-icon os-icon-layers"></i>
                </div>
                <div class="sub-menu-i">
                  <ul class="sub-menu">
                    <li>
                      <a href="{{route('users.create')}}">Add Users</a>
                    </li>
                    <li>
                      <a href="{{route('users.index')}}">All Users</a>
                    </li>     
                  </ul>
                </div>
              </div>
            </li>
            <li class=" has-sub-menu">
              <a href="{{route('akc_groups.index')}}">
                <div class="icon-w">
                  <div class="os-icon os-icon-layers"></div>
                </div>
                <span>AKC Groups</span></a>
              <div class="sub-menu-w">
                <div class="sub-menu-header">
                AKC Groups
                </div>
                <div class="sub-menu-icon">
                  <i class="os-icon os-icon-layers"></i>
                </div>
                <div class="sub-menu-i">
                  <ul class="sub-menu">
                    <li>
                      <a href="{{route('akc_groups.create')}}">Add Groups</a>
                    </li>
                    <li>
                      <a href="{{route('akc_groups.index')}}">All Groups</a>
                    </li>     
                  </ul>
                </div>
              </div>
            </li>
            <li class=" has-sub-menu">
              <a href="{{route('fci_groups.index')}}">
                <div class="icon-w">
                  <div class="os-icon os-icon-layers"></div>
                </div>
                <span>FCI Groups</span></a>
              <div class="sub-menu-w">
                <div class="sub-menu-header">
                FCI Groups
                </div>
                <div class="sub-menu-icon">
                  <i class="os-icon os-icon-layers"></i>
                </div>
                <div class="sub-menu-i">
                  <ul class="sub-menu">
                    <li>
                      <a href="{{route('fci_groups.create')}}">Add Groups</a>
                    </li>
                    <li>
                      <a href="{{route('fci_groups.index')}}">All Groups</a>
                    </li>     
                  </ul>
                </div>
              </div>
            </li>
            <li class=" has-sub-menu">
              <a href="{{route('cities.index')}}">
                <div class="icon-w">
                  <div class="os-icon os-icon-layers"></div>
                </div>
                <span>Cities</span></a>
              <div class="sub-menu-w">
                <div class="sub-menu-header">
                Cities
                </div>
                <div class="sub-menu-icon">
                  <i class="os-icon os-icon-layers"></i>
                </div>
                <div class="sub-menu-i">
                  <ul class="sub-menu">
                    <li>
                      <a href="{{route('cities.create')}}">Add Cities</a>
                      <a href="{{route('cities.index')}}">All Cities</a>
                    </li>
                    
                  </ul>
                </div>
              </div>
            </li>
            <li class=" has-sub-menu">
              <a href="{{route('species.index')}}">
                <div class="icon-w">
                  <div class="os-icon os-icon-layers"></div>
                </div>
                <span>Species</span></a>
              <div class="sub-menu-w">
                <div class="sub-menu-header">
                Species
                </div>
                <div class="sub-menu-icon">
                  <i class="os-icon os-icon-layers"></i>
                </div>
                <div class="sub-menu-i">
                  <ul class="sub-menu">
                    <li>
                      <a href="{{route('species.create')}}">Add Species</a>
                    </li>
                    <li>
                      <a href="{{route('species.index')}}">All Species</a>
                    </li>     
                  </ul>
                </div>
              </div>
            </li>
            <li class=" has-sub-menu">
              <a href="">
                <div class="icon-w">
                  <div class="os-icon os-icon-layers"></div>
                </div>
                <span>Logged in as:</span></a>
              <div class="sub-menu-w">
                <div class="sub-menu-header">
                Logged in as:
                </div>
                <div class="sub-menu-icon">
                  <i class="os-icon os-icon-layers"></i>
                </div>
                <div class="sub-menu-i">
                  <ul class="sub-menu">
                    <li>
                      <!-- check if the user have logged in as admin  -->
                    @if(Auth::check() && Auth::user()->role_id == '1')
                      <a href="">Admin</a>
                      @endif
                      <!-- check in if the user have logged in as writer  -->
                      @if(Auth::check() && Auth::user()->role_id == '2')
                      <a href="">Writer</a>
                      @endif
                      <!-- check if the user have logged in as user  -->
                      @if(Auth::check() && Auth::user()->role_id == '3')
                      <a href="">User</a>
                      @endif
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

       
        <script src="{{asset('public/bower_components/popper.js/dist/umd/popper.min.js')}}"></script>
        <script src="{{asset('public/bower_components/moment/moment.js')}}"></script>
        <script src="{{asset('public/bower_components/chart.js/dist/Chart.min.js')}}"></script>
        <!-- <script src="{{asset('public/bower_components/select2/dist/js/select2.full.min.js')}}"></script> -->
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
    <!-- <script src="{{asset('public/bower_components/ckeditor/ckeditor.js')}}"></script> -->

<!-- <script src="{{asset('public/bower_components/summernote/summernote-bs4.js')}}"></script> -->

        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
          
          ga('create', 'UA-XXXXXXX-9', 'auto');
          ga('send', 'pageview');



        </script>
 
 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<!-- <script>
    var $j = jQuery.noConflict();
    // Use $j instead of $ to reference the jQuery library
</script> -->



<script>

  

// hover 
$(".has-sub-menu").hover(
  function(){ $(this).addClass('active') },
  function(){ $(this).removeClass('active') }
);


    
function previewImages() {

  
  if (this.files) {
    [].forEach.call(this.files, readAndPreview);
  }

  function readAndPreview(file) {

    // Make sure `file.name` matches our extensions criteria
    if (!/\.(jpe?g|png|gif)$/i.test(file.name)) {
      return alert(file.name + " is not an image");
    } // else...
    
    var reader = new FileReader();
    
    reader.addEventListener("load", function() {
      var image = new Image();
      image.height = 100;
      image.title  = file.name;
      image.src    = this.result;
      preview.appendChild(image);
    });
    
    reader.readAsDataURL(file);
    
  }

}
document.querySelector('#img').addEventListener("change", previewImages);
// function previewSignature() {

//   var preview = document.querySelector('#preview_sig');
  
//   if (this.files) {
//     [].forEach.call(this.files, readAndPreview);
//   }

//   function readAndPreview(file) {

//     // Make sure `file.name` matches our extensions criteria
//     if (!/\.(jpe?g|png|gif)$/i.test(file.name)) {
//       return alert(file.name + " is not an image");
//     } // else...
    
//     var reader = new FileReader();
    
//     reader.addEventListener("load", function() {
//       var image = new Image();
//       image.height = 100;
//       image.title  = file.name;
//       image.src    = this.result;
//       preview.appendChild(image);
//     });
    
//     reader.readAsDataURL(file);
    
//   }

// }

// document.querySelector('#sig').addEventListener("change", previewSignature);







    </script>
</body>
    </html>




