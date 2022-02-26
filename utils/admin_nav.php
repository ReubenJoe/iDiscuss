  <style>
  .main-header .navbar-nav .nav-item:hover .nav-link{
    color: #ff4583;
  }
  .main-header .navbar-nav .nav-item .nav-link{
    color: black;
  }

  #hello{
    color:#ff4583; 
    font-weight: bold;
  }
  #hello:hover{
    color:white; 
    background-color: #6c757d;
    cursor: pointer;
  }
  </style>
  
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="http://localhost/iwp/admin/home.php" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">


      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <!-- Logout Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" id="hello" data-toggle="dropdown">Hello Admin
        </a>
        <div class="dropdown-menu" style="min-width: 7.5rem;">
          <a href="../user-verification/logout.php" class="dropdown-item">
          <i class="fas fa-sign-out-alt mr-2"></i> Logout
          </a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->