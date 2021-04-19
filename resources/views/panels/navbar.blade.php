@if($configData["mainLayoutType"] == 'horizontal' && isset($configData["mainLayoutType"]))
<nav class="header-navbar navbar-expand-lg navbar navbar-with-menu {{ $configData['navbarColor'] }} navbar-fixed">
  <div class="navbar-header d-xl-block d-none">
    <ul class="nav navbar-nav flex-row">
      <li class="nav-item"><a class="navbar-brand" href="{{route('admin-dashboard')}}">
          <div class="brand-logo"></div>
        </a></li>
    </ul>
  </div>
  @else
  <nav
    class="header-navbar navbar-expand-lg navbar navbar-with-menu {{ $configData['navbarClass'] }} navbar-light navbar-shadow {{ $configData['navbarColor'] }}">
    @endif
    <div class="navbar-wrapper">
      <div class="navbar-container content">
        <div class="navbar-collapse" id="navbar-mobile">
          <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
            <ul class="nav navbar-nav">
              <li class="nav-item mobile-menu d-xl-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs"
                  href="#"><i class="ficon feather icon-menu"></i></a></li>
            </ul>
          </div>
          <ul class="nav navbar-nav float-right">
            <li class="dropdown dropdown-language nav-item">
              <a class="dropdown-toggle nav-link" id="dropdown-flag" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="flag-icon flag-icon-us"></i>
                <span class="selected-language">English</span>
              </a>
              <div class="dropdown-menu" aria-labelledby="dropdown-flag">
                <a class="dropdown-item" href="{{url('lang/en')}}" data-language="en">
                  <i class="flag-icon flag-icon-us"></i> English
                </a>
                <a class="dropdown-item" href="{{url('lang/fr')}}" data-language="fr">
                  <i class="flag-icon flag-icon-fr"></i> French
                </a>
                <a class="dropdown-item" href="{{url('lang/de')}}" data-language="de">
                  <i class="flag-icon flag-icon-de"></i> German
                </a>
                <a class="dropdown-item" href="{{url('lang/pt')}}" data-language="pt">
                  <i class="flag-icon flag-icon-pt"></i> Portuguese
                </a>
              </div>
            </li>
            <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i
                  class="ficon feather icon-maximize"></i></a></li>
            {{-- <li class="nav-item nav-search"><a class="nav-link nav-link-search"><i
                  class="ficon feather icon-search"></i></a>
              <div class="search-input">
                <div class="search-input-icon"><i class="feather icon-search primary"></i></div>
                <input class="input" type="text" placeholder="Explore Digyata..." tabindex="-1"
                  data-search="starter-list" />
                <div class="search-input-close"><i class="feather icon-x"></i></div>
                <ul class="search-list search-list-main"></ul>
              </div>
            </li> --}}
            {{-- <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#"
                data-toggle="dropdown"><i class="ficon feather icon-bell"></i></a>
              <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                <li class="dropdown-menu-header">
                  <div class="dropdown-header m-0 p-2">
                    <h3 class="white">1 New</h3><span class="grey darken-2">App Notifications</span>
                  </div>
                </li>
                <li class="scrollable-container media-list">
                  <a class="d-flex justify-content-between" href="javascript:void(0)">
                    <div class="media d-flex align-items-start">
                      <div class="media-left"><i class="feather icon-plus-square font-medium-5 primary"></i></div>
                      <div class="media-body">
                        <h6 class="primary media-heading">Welcome!</h6>
                      </div><small>
                        <time class="media-meta" datetime="2015-06-11T18:29:20+08:00">1 min ago</time></small>
                    </div>
                  </a>
                </li>
                <li class="dropdown-menu-footer"><a class="dropdown-item p-1 text-center" href="javascript:void(0)">Read
                    all notifications</a></li>
              </ul>
            </li> --}}
            <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#"
                data-toggle="dropdown">
                <div class="user-nav d-sm-flex d-none"><span class="user-name text-bold-600">{{Auth::user()->name}}</span><span class="user-status">Available</span></div><span><img class="round"
                    src="{{asset('images/default-img/user.png') }}" alt="avatar" height="40"
                    width="40" /></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="logout"><i class="feather icon-power"></i> Logout</a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>

  {{-- Search Start Here --}}
  {{-- <ul class="main-search-list-defaultlist d-none">
  </ul>
  <ul class="main-search-list-defaultlist-other-list d-none">
    <li class="auto-suggestion d-flex align-items-center justify-content-between cursor-pointer">
      <a class="d-flex align-items-center justify-content-between w-100 py-50">
        <div class="d-flex justify-content-start"><span class="mr-75 feather icon-alert-circle"></span><span>No results found.</span></div>
      </a>
    </li>
  </ul> --}}
  {{-- Search Ends --}}
  <!-- END: Header-->
