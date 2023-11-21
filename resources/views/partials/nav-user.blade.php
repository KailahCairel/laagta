    <!-- Sidenav Top -->
    <nav class="navbar bg-primary navbar-expand-lg flex-wrap top-0 px-0 py-0">
        <div class="container py-2">
            <nav aria-label="breadcrumb">
                <div class="d-flex align-items-center">
                    <a href="{{ route('user.dashboard') }}">
                        <span class="px-3 font-weight-bold text-lg text-dark me-4 mr-2 d-flex">
                            <img class="logo" src="{{ asset('imgs/lt.png') }}" alt="">
                        </span>
                    </a>
                </div>
            </nav>
            <ul class="navbar-nav d-none d-lg-flex">
                <li class="nav-item px-3 py-3 border-radius-sm  d-flex align-items-center">
                    <a href="{{ route('user.hotels', ['category' => 'hotels']) }}"
                        class="nav-link text-dark p-0">Hotels</a>

                </li>
                <li class="nav-item px-3 py-3 border-radius-sm  d-flex align-items-center">
                    <a href="{{ route('user.activities', ['category' => 'activities']) }}"
                        class="nav-link text-dark p-0">Activities</a>

                </li>
                <li class="nav-item px-3 py-3 border-radius-sm  d-flex align-items-center">
                    <a href="{{ route('user.landmarkds', ['category' => 'landmarks']) }}"
                        class="nav-link text-dark p-0">Landmarks</a>

                </li>
                <li class="nav-item px-3 py-3 border-radius-sm  d-flex align-items-center">
                    <a href="{{ route('user.events', ['category' => 'events']) }}"
                        class="nav-link text-dark p-0">Events</a>

                </li>
                <li class="nav-item px-3 py-3 border-radius-sm  d-flex align-items-center">
                    <a href="{{ route('user.attractions', ['category' => 'attractions']) }}"
                        class="nav-link text-dark p-0">Attractions</a>

                </li>
            </ul>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <ul class="navbar-nav ms-md-auto  justify-content-end">
                    <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-dark p-0" id="iconNavbarSidenav">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line bg-white"></i>
                                <i class="sidenav-toggler-line bg-white"></i>
                                <i class="sidenav-toggler-line bg-white"></i>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item dropdown pe-2 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-dark p-0 show" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-expanded="true" onclick="toggleDropdown()">
                            <div class="d-flex align-items-center gap-2">

                                <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg"
                                    class="fixed-plugin-button-nav cursor-pointer" viewBox="0 0 24 24"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M11.078 2.25c-.917 0-1.699.663-1.85 1.567L9.05 4.889c-.02.12-.115.26-.297.348a7.493 7.493 0 00-.986.57c-.166.115-.334.126-.45.083L6.3 5.508a1.875 1.875 0 00-2.282.819l-.922 1.597a1.875 1.875 0 00.432 2.385l.84.692c.095.078.17.229.154.43a7.598 7.598 0 000 1.139c.015.2-.059.352-.153.43l-.841.692a1.875 1.875 0 00-.432 2.385l.922 1.597a1.875 1.875 0 002.282.818l1.019-.382c.115-.043.283-.031.45.082.312.214.641.405.985.57.182.088.277.228.297.35l.178 1.071c.151.904.933 1.567 1.85 1.567h1.844c.916 0 1.699-.663 1.85-1.567l.178-1.072c.02-.12.114-.26.297-.349.344-.165.673-.356.985-.57.167-.114.335-.125.45-.082l1.02.382a1.875 1.875 0 002.28-.819l.923-1.597a1.875 1.875 0 00-.432-2.385l-.84-.692c-.095-.078-.17-.229-.154-.43a7.614 7.614 0 000-1.139c-.016-.2.059-.352.153-.43l.84-.692c.708-.582.891-1.59.433-2.385l-.922-1.597a1.875 1.875 0 00-2.282-.818l-1.02.382c-.114.043-.282.031-.449-.083a7.49 7.49 0 00-.985-.57c-.183-.087-.277-.227-.297-.348l-.179-1.072a1.875 1.875 0 00-1.85-1.567h-1.843zM12 15.75a3.75 3.75 0 100-7.5 3.75 3.75 0 000 7.5z"
                                        clip-rule="evenodd"></path>
                                </svg> {{Auth::user()->name}}
                            </div>

                            <script>
                                function toggleDropdown() {
                                    var dropdownMenu = document.getElementById('myDropdown');

                                    // Toggle the visibility of the dropdown-menu
                                    if (dropdownMenu.style.display === 'none' || dropdownMenu.style.display === '') {
                                        dropdownMenu.style.display = 'block';
                                    } else {
                                        dropdownMenu.style.display = 'none';
                                    }
                                }

                            </script>
                        </a>
                        <ul id="myDropdown" class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4 show"
                            aria-labelledby="dropdownMenuButton" data-bs-popper="static" style="display: none">
                            <li class="mb-2">
                                <a class="dropdown-item border-radius-md" href="{{ route('user.profile') }}">
                                    <div class="d-flex py-1">
                                        <div class="my-auto">
                                            <img src="{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : asset('imgs/default.png') }}"
                                                alt="profile_image" class="avatar avatar-sm  me-3 ">
                                        </div>

                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="text-sm font-weight-normal mb-1">
                                                <span class="font-weight-bold">Profile</span>
                                            </h6>
                                            <p class="text-xs text-secondary mb-0">
                                                <i class="fa fa-user me-1" aria-hidden="true"></i>{{Auth::user()->name}}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item border-radius-md" href="javascript:void(0);" onclick="logout()">
                                    Logout
                                    <form id="logoutForm" method="POST" action="{{ route('logout') }}">
                                        @csrf
                                    </form>

                                    <script>
                                        function logout() {
                                            document.getElementById('logoutForm').submit();
                                        }

                                    </script>
                                </a>
                            </li>
                        </ul>
                    </li> 
            </ul>
        </div>
        </div>
        <hr class="horizontal w-100 my-0 dark">
    </nav>
    <!-- End Sidenav Top -->
