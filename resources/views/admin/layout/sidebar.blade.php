<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('NewEnglandplaces.create') }}" class="brand-link">
        <img src="{{ asset('favicon.ico') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">nehidta Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">



        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                {{-- <li class="nav-item menu-open">
                    <a href="{{ route('dashboard') }}" class="nav-link ">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                </li> --}}


                <li class="nav-item">
                    <a href="{{ route('NewEnglandplaces.create') }}" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Manage NE Address

                        </p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="{{ route('NewEnglandmap') }}" class="nav-link ">
                        <i class="nav-icon fas fa-map-marker-alt"></i>

                        <p>
                            NewEngland-MAP

                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Logout
                        </p>
                  
                    </a>
                </li>

 
             
              

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
