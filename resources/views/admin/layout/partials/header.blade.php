<div class="container-xxl position-relative bg-white d-flex p-0">
  <!-- Spinner Start -->
  <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
      <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
          <span class="sr-only">Loading...</span>
      </div>
  </div>
  <!-- Spinner End -->


  <!-- Sidebar Start -->
  <div class="sidebar pe-4 pb-3">
      <nav class="navbar bg-light navbar-light">
          <a href="{{ route('dashboard') }}" class="navbar-brand mx-4 mb-3">
              <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>DASHMIN</h3>
          </a>
          <div class="d-flex align-items-center ms-4 mb-4">
              <div class="position-relative">
                  <img class="rounded-circle" src="{{ asset('admin/img/user.jpg')}}" alt="" style="width: 40px; height: 40px;">
                  <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
              </div>
              <div class="ms-3">
                  <h6 class="mb-0">Jhon Doe</h6>
                  <span>Admin</span>
              </div>
          </div>
          <div class="navbar-nav w-100">
              <a href="{{ route('dashboard') }}" class="nav-item nav-link  {{ request()->is('cms-admin') ? 'active' : '' }}"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
              <a href="{{ route('dcos_contacts') }}" class="nav-item nav-link {{ request()->is('cms-admin/dcos_contacts') ? 'active' : '' }}"><i class="fa fa-th me-2"></i>Bank Nodals </a>
              <a href="{{ route('govt_schemes') }}" class="nav-item nav-link {{ request()->is('cms-admin/govt_schemes') ? 'active' : '' }}"><i class="fa fa-table me-2"></i>Govt Schemes</a>
              <a href="{{ route('bank_branches') }}" class="nav-item nav-link {{ request()->is('cms-admin/bank_branches') ? 'active' : '' }}"><i class="fa fa-table me-2"></i>Bank Branches</a>
              <a href="{{ route('services') }}" class="nav-item nav-link {{ request()->is('cms-admin/services') ? 'active' : '' }}"><i class="fa fa-table me-2"></i>Services</a>
              <a href="{{ route('useful_links') }}" class="nav-item nav-link {{ request()->is('cms-admin/useful_links') ? 'active' : '' }}"><i class="fa fa-table me-2"></i>Useful Links</a>
              <a href="{{ route('public_notices') }}" class="nav-item nav-link {{ request()->is('cms-admin/public_notices') ? 'active' : '' }}"><i class="fa fa-table me-2"></i>Public Notices</a>
              <a href="{{ route('departments') }}" class="nav-item nav-link {{ request()->is('cms-admin/departments') ? 'active' : '' }}"><i class="fa fa-table me-2"></i>Department</a>
              {{-- <a href="{{ route('schemes') }}" class="nav-item nav-link {{ request()->is('cms-admin/schemes') ? 'active' : '' }}"><i class="fa fa-table me-2"></i>Schemes</a> --}}
              <a href="{{ route('advertisement_rates') }}" class="nav-item nav-link {{ request()->is('cms-admin/advertisement_rates') ? 'active' : '' }}"><i class="fa fa-table me-2"></i>Ads. Rates</a>
              {{-- <a href="form.html" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Forms</a>
              <a href="table.html" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Tables</a>
              <a href="chart.html" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Charts</a> --}}
              {{-- <div class="nav-item dropdown">
                  <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Pages</a>
                  <div class="dropdown-menu bg-transparent border-0">
                      <a href="signin.html" class="dropdown-item">Sign In</a>
                      <a href="signup.html" class="dropdown-item">Sign Up</a>
                      <a href="404.html" class="dropdown-item">404 Error</a>
                      <a href="blank.html" class="dropdown-item">Blank Page</a>
                  </div>
              </div> --}}
          </div>
      </nav>
  </div>
  <!-- Sidebar End -->


  <!-- Content Start -->
  <div class="content">
      <!-- Navbar Start -->
      <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
          <a href="{{ route('dashboard') }}" class="navbar-brand d-flex d-lg-none me-4">
              <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
          </a>
          <a href="#" class="sidebar-toggler flex-shrink-0">
              <i class="fa fa-bars"></i>
          </a>
          <!-- <form class="d-none d-md-flex ms-4">
              <input class="form-control border-0" type="search" placeholder="Search">
          </form> -->
          <div class="navbar-nav align-items-center ms-auto">
             
              <div class="nav-item dropdown">
                  <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                      <img class="rounded-circle me-lg-2" src="{{ asset('admin/img/user.jpg')}}" alt="" style="width: 40px; height: 40px;">
                      <span class="d-none d-lg-inline-flex">John Doe</span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                      <a href="#" class="dropdown-item">My Profile</a>
                      <a href="#" class="dropdown-item">Settings</a>
                      {{-- <a href="#" class="dropdown-item">Log Out</a> --}}
                      <form method="POST" action="{{ route('logout') }}">
                          @csrf
                          <a href="route('logout')"
                          onclick="event.preventDefault();
                                      this.closest('form').submit();" class="dropdown-item">Log Out</a>

                          {{-- <x-dropdown-link :href="route('logout')"
                                  onclick="event.preventDefault();
                                              this.closest('form').submit();">
                              {{ __('Log Out') }}
                          </x-dropdown-link> --}}
                      </form>
                  </div>
              </div>
          </div>
      </nav>
      <!-- Navbar End -->
