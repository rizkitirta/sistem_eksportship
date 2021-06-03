<aside class="main-sidebar sidebar-light-success elevation-4">
    <!-- Brand Logo -->
    {{-- <a href="index3.html" class="brand-link">
        <img src="{{ asset('AdminLTE/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a> --}}

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <h3 class="text-bold">PERUSAHAAN X</h3>
            </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Container
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('container.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Container</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('katalogContainer.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Katalog Container</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Kapal Cargo
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('kapal.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Kapal</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('katalogKapal.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Katalog Kapal</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Pelabuhan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('pelabuhan.index') }}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Pelabuhan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('katalogPelabuhan.index') }}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Katalog Pelabuhan</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Data Pengiriman
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('pengiriman.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pengiriman</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('status.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tambah Status</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Tracking Pengiriman
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('tracking.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tracking Pengiriman</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link">
                        <i class="fas fa-sign-out-alt nav-icon"></i>
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
