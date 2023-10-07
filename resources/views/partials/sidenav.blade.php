  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 bg-slate-900 fixed-start " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand d-flex align-items-center m-0" href=" https://demos.creative-tim.com/corporate-ui-dashboard/pages/dashboard.html " target="_blank">
        <span class="font-weight-bold text-lg">SUROYTA</span>
      </a>
    </div>
    <div class="collapse navbar-collapse px-4  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link  {{ Route::is('admin.dashboard') ? 'active':'' }}" href="{{ route('admin.dashboard') }}">
            <i class="fa-solid fa-table-columns"></i>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link  {{ Route::is('admin.destinations.index') ? 'active':'' }}" href="{{ route('admin.destinations.index') }}">
            <i class="fa-solid fa-map-location"></i>
            <span class="nav-link-text ms-1">Destinations</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link  {{ Route::is('admin.establishments.index') ? 'active':'' }}" href="{{ route('admin.establishments.index') }}">
            <i class="fa-solid fa-building"></i>
            <span class="nav-link-text ms-1">Establishments</span>
          </a>
        </li>
         
        <li class="nav-item">
          <a class="nav-link  {{ Route::is('admin.users') ? 'active':'' }}" href="{{ route('admin.users') }}"> 
            <i class="fa fa-users"></i>
            <span class="nav-link-text ms-1">Users</span>
          </a>
        </li>
         
         
        <li class="nav-item mt-2">
          <div class="d-flex align-items-center nav-link">
            <i class="fa-solid fa-user"></i>
            <span class="font-weight-normal text-md ms-2">Account Pages</span>
          </div>
        </li>
        <li class="nav-item border-start my-0 pt-2">
          <a class="nav-link position-relative ms-0 ps-2 py-2 {{ Route::is('admin.profile') ? 'active':'' }}" href="{{ route('admin.profile') }}">
            <i class="fa-solid fa-user"></i>
            <span class="nav-link-text">Profile</span>
          </a>
        </li>
        <li class="nav-item border-start my-0 pt-2">
          <a class="nav-link position-relative ms-0 ps-2 py-2 " href="#" onclick="document.getElementById('logout').submit();">
            <i class="fa-solid fa-right-from-bracket"></i>
            <span class="nav-link-text">Logout</span>
          </a>

          <form method="POST" action="{{ route('logout') }}" id="logout">
              @csrf
              
          </form> 
        </li>
         
      </ul>
    </div>
  </aside>