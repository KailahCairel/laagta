    <!-- Sidenav Top -->
    <nav class="navbar bg-primary navbar-expand-lg flex-wrap top-0 px-0 py-0">
      <div class="container py-2">
        <nav aria-label="breadcrumb">
          <div class="d-flex align-items-center">
            <a href="{{ route('user.dashboard') }}">
              <span class="px-3 font-weight-bold text-lg text-white me-4">SUROYTA</span>
            </a>
          </div>
        </nav>
        <ul class="navbar-nav d-none d-lg-flex">
          {{-- <li class="nav-item px-3 py-3 border-radius-sm  d-flex align-items-center bg-slate-800">
             
          </li> --}}
           
        </ul>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <ul class="navbar-nav ms-md-auto  justify-content-end">
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                </div>
              </a>
            </li> 
            <li class="nav-item d-flex align-items-center ps-2">
              <a href="{{ route('user.profile') }}" class="nav-link text-white font-weight-bold px-0">
            <li class="nav-item dropdown pe-2 d-flex align-items-center">
              <div class="avatar avatar-sm position-relative">
                <img src="{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : asset('imgs/default.png') }}" alt="profile_image" class="w-100 border-radius-md">
              </div>
            </li>
            </a>
            </li>
          </ul>
        </div>
      </div>
      <hr class="horizontal w-100 my-0 dark"> 
    </nav>
    <!-- End Sidenav Top -->