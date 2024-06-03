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
          <a href="{{ route('applicants_dashboard') }}" class="navbar-brand mx-4 mb-3">
              <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>Applicant</h3>
          </a>
          <div class="d-flex align-items-center ms-4 mb-4">
              <div class="position-relative">
                  <img class="rounded-circle" src="{{ asset('admin/img/user.jpg')}}" alt="" style="width: 40px; height: 40px;">
                  <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
              </div>
              <div class="ms-3">
                <h6 class="mb-0">
                    @auth('applicants')
                    <p>{{ auth('applicants')->user()->name }}</p>
                @endauth
            
                    {{-- @auth('bank_branches')
                        <p>{{ auth()->user()->concerned_person }}</p>
                    @endauth
            
                    @auth('departments')
                        <p>{{ auth()->user()->contact_person }}</p>
                    @endauth
            
                    @auth
                        <p>{{ auth()->user()->name }}</p>
                    @endauth --}}
                </h6>
                <span>Applicant</span>
            </div>
          </div>
          <div class="navbar-nav w-100">
              <a href="{{ route('applicants_dashboard') }}" class="nav-item nav-link  {{ request()->is('bank-nodals') ? 'active' : '' }}"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
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
                      <span class="d-none d-lg-inline-flex">
                        @auth('applicants')
                        <p>{{ auth('applicants')->user()->name }} (Applicant)</p>
                    @endauth
                        {{-- @if (auth()->guard('applicants')->check())
                            <p>{{ auth()->guard('bank_nodals')->user()->name }} (Applicant</p>
                        @elseif(auth()->guard('bank_branches')->check())
                            <p>{{ auth()->guard('bank_branches')->user()->concerned_person }} (Bank Branch)</p>
                        @elseif(auth()->guard('departments')->check())
                            <p>{{ auth()->guard('departments')->user()->contact_person }} (Department)</p>
                        @elseif(auth()->check())
                            <p>{{ auth()->user()->name }} (Admin)</p>
                        @endif --}}
                    </span>
                    
                  </a>
                  <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">My Profile</a>
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
