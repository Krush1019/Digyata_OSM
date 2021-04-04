<nav class="navbar navbar-expand-lg navbar-dark bg-default fixed-top" id="mainNav">

  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
    data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
    aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <link rel="shortcut icon" href="{{asset('client_user/img/favicon.svg')}}" type="image/x-icon">
  <a class="navbar-brand mr-4" href="{{route('client-dashboard')}}"><img class="width-logo-auto" src="{{asset('client_user/img/logo.svg')}}"
      data-retina="true" alt="" width="120" height="35"></a>

  <span class="nav-item dropdown d-lg-none d-md-block">
    <a class="nav-link dropdown-toggle mr-lg-2 link-color logo-a" id="clientDropdown1" href="#" data-toggle="dropdown"
      aria-haspopup="true" aria-expanded="false">
      <span class="logo-figure"><img class="logo-img"
          src="{{Auth::guard('client')->user()->sClPhotoURL}}"
          alt=""></span><span class="d-none d-sm-inline-block">{{Auth::guard('client')->user()->sClName}}</span>
    </a>
    <div class="dropdown-menu dropdown-menu-right dropdown-menu-end width-min-auto" aria-labelledby="clientDropdown1">
      <a class="nav-link text-black-50" href="#exampleModal" data-toggle="modal">
        <i class="fa fa-fw fa-sign-out"></i>Logout</a>
    </div>
  </span>

  {{-- <span class="nav-item dropdown d-lg-none d-md-block">
    <a class="nav-link dropdown-toggle mr-lg-2 link-color logo-a" id="userDropdown1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <span hidden class="logo-figure d-none d-sm-block"><img class="logo-img" src="{{Auth::guard('customer')->user()->sUserImgURL}}"
  alt=""></span><span>{{Auth::guard('customer')->user()->sUserName}}</span>
  </a>
  <div class="dropdown-menu dropdown-menu-right dropdown-menu-end width-min-auto" aria-labelledby="userDropdown1">
    <a class="nav-link text-black-50" href="#exampleModal" data-toggle="modal">
      <i class="fa fa-fw fa-sign-out"></i>Logout</a>
  </div>
  </span> --}}

  <div class="collapse navbar-collapse" id="navbarResponsive">
    <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">

      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
        <a class="nav-link" href="{{route('client-dashboard')}}">
          <i class="fa fa-fw fa-dashboard"></i>
          <span class="nav-link-text">Dashboard</span>
        </a>
      </li>

      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="My profile">
        <a class="nav-link" href="{{route('client-profile')}}">
          <i class="fa fa-fw fa-user"></i>
          <span class="nav-link-text">My Profile</span>
        </a>
      </li>

      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Service Listings">
        <a class="nav-link" href="{{route('service-listing')}}">
          <i class="fa fa-fw fa-list"></i>
          <span class="nav-link-text">Service Listings</span>
          <span class="badge badge-pill badge-warning text-secondary">6</span>
        </a>
      </li>

      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Order Manage"
        data-original-title="Order Manage">
        <a class="nav-link" href="{{route('order-manage.index')}}">
          <i class="fa fa-fw fa-calendar-check-o"></i>
          <span class="nav-link-text">Order Manage <span class="badge badge-pill badge-primary">6 New</span></span>
        </a>
      </li>

      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Reviews">
        <a class="nav-link" href="{{route('client-review')}}">
          <i class="fa fa-fw fa-star"></i>
          <span class="nav-link-text">Reviews</span>
        </a>
      </li>
    </ul>

    <ul class="navbar-nav sidenav-toggler">
      <li class="nav-item">
        <a class="nav-link text-center" id="sidenavToggler">
          <i class="fa fa-fw fa-angle-left"></i>
        </a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-fw fa-envelope"></i>
          <span class="d-lg-none">Messages</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="messagesDropdown">
          <h6 class="dropdown-header">Messages:</h6>
          <div class="dropdown-divider"></div>
          <span class="small text-center text-muted ml-4">No messages.</span>
        </div>
      </li>

      <li class="nav-item">
        <form class="form-inline my-2 my-lg-0 w-75">
          <div class="input-group">
            <input class="form-control search-top" type="text" placeholder="Search for...">
            <span class="input-group-btn">
              <button class="btn btn-primary" type="button">
                <i class="fa fa-search"></i>
              </button>
            </span>
          </div>
        </form>
      </li>

      <li class="nav-item dropdown d-lg-block d-none">
        <a class="nav-link dropdown-toggle mr-lg-2 logo-a" id="clientDropdown" href="#" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <span class="logo-figure"><img class="logo-img" src="{{Auth::guard('client')->user()->sClPhotoURL}}"
              alt=""></span>{{Auth::guard('client')->user()->sClName}}
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-menu-end width-min" aria-labelledby="clientDropdown">
          <a class="nav-link text-black-50" href="#exampleModal" data-toggle="modal">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
        </div> 
      </li>
    </ul>
  </div>
</nav>