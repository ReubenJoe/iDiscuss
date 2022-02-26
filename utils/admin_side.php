  <style>
.main-sidebar,
nav li:hover .nav li:hover {
    background-color: #ff4583;
}

.main-sidebar .brand-link {
    color: white;
    font-size: 2rem;
}

.main-sidebar .sidebar .fas,
.far,
.main-sidebar .sidebar p,
nav li:hover .nav li:hover .nav-link p,
nav li:hover .nav li:hover .nav-link .far,
nav li:hover .nav li:hover .nav-link .fas {
    color: white;
}

nav li:hover,
#ld_hover:hover {
    background-color: white;
}

nav li:hover .nav-link p,
nav li:hover .nav-link .fas,
nav li:hover .nav-link .far,
.nav-treeview:hover .nav-item .nav-link p,
#ld_hover:hover .nav-link p,
#ld_hover:hover .nav-link .far{
    color: #ff4583;
}
#s_btn:hover{
    background-color: #6c757d;
}
  </style>
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
      <img src="../images/logo.png" alt="ReunAite Logo" height=40px width=40px style="opacity: .8; margin: -5px auto auto 10px">
          <span class="brand-text font-weight-bolder">iDiscuss</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">


          <!-- SidebarSearch Form -->
          <div class="form-inline">
              <div class="input-group" data-widget="sidebar-search">
                  <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                      aria-label="Search" style="border: 0.5px solid white">
                  <div class="input-group-append" id="s_btn">
                      <button class="btn btn-sidebar" style="border: 0.5px solid white">
                          <i class="fas fa-search fa-fw"></i>
                      </button>
                  </div>
              </div>
          </div>



          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                  <li class="nav-item">
                      <a href="http://localhost/iwp/admin/home.php" class="nav-link">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              Dashboard
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="http://localhost/iwp/admin/datatable_users.php" class="nav-link">
                          <i class="nav-icon fas fa-user"></i>
                          <p>
                              Users
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="http://localhost/iwp/admin/category.php" class="nav-link">
                          <i class="nav-icon fas fa-th"></i>
                          <p>
                              Categories
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-table"></i>
                          <p>
                              Tables
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="http://localhost/iwp/admin/datatable_que_ans.php" class="nav-link">
                                  <i class="nav-icon fas fa-circle"></i>
                                  <p>Threads</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="#" class="nav-link">
                                  <i class="nav-icon fas fa-circle"></i>
                                  <p>
                                      Questions
                                      <i class="right fas fa-angle-left"></i>
                                  </p>
                              </a>
                              <ul class="nav nav-treeview">
                                  <li class="nav-item" id="ld_hover">
                                      <a href="http://localhost/iwp/admin/datatable_que_like.php" class="nav-link">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>Likes</p>
                                      </a>
                                  </li>
                                  <li class="nav-item" id="ld_hover">
                                      <a href="http://localhost/iwp/admin/datatable_que_dislike.php" class="nav-link">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>Dislikes</p>
                                      </a>
                                  </li>
                              </ul>
                          </li>
                          <li class="nav-item">
                              <a href="#" class="nav-link">
                                  <i class="nav-icon fas fa-circle"></i>
                                  <p>
                                      Answers
                                      <i class="right fas fa-angle-left"></i>
                                  </p>
                              </a>
                              <ul class="nav nav-treeview">
                                  <li class="nav-item" id="ld_hover">
                                      <a href="http://localhost/iwp/admin/datatable_ans_like.php" class="nav-link">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>Likes</p>
                                      </a>
                                  </li>
                                  <li class="nav-item" id="ld_hover">
                                      <a href="http://localhost/iwp/admin/datatable_ans_dislike.php" class="nav-link">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>Dislikes</p>
                                      </a>
                                  </li>
                              </ul>
                          </li>
                      </ul>
                  </li>
              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>