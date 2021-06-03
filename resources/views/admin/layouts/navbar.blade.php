  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light elevation-1">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
          <li class="nav-item">
              <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
      </ul>



      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
          <!-- Notifications Dropdown Menu -->
          <li class="nav-item dropdown">
              <a class="nav-link" data-toggle="dropdown" href="#">
                  <img src="{{ asset('AdminLTE/dist/img/user2-160x160.jpg') }}" width="25%" class="img-circle elevation-2 float-right"
                        alt="User Image">
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                  <span class="dropdown-header">Profile</span>
                  <div class="dropdown-divider"></div>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">
                    <i class="fas fa-user nav-icon mr-1"></i> Admin
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="{{ route('logout') }}" class="nav-link">
                    <i class="fas fa-sign-out-alt nav-icon"></i>
                    Logout
                </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item dropdown-footer">@2021</a>
              </div>
          </li>

      </ul>
  </nav>
  <!-- /.navbar -->
