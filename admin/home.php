<?php include '../config/db.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../utils/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../utils/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../utils/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../utils/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../utils/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../utils/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../utils/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../utils/plugins/summernote/summernote-bs4.min.css">

  <style>
._users{
  background-color: white;
}

._users .icon{
  color: #ff4583;
}

._users:hover{
background-color: #ff4583;
color: white;
}

._users:hover .icon{
color: white;
}

._users .small-box-footer{
  background-color: #ff4583;
  color: white;
}

  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <!-- <img class="animation__shake" src="../utils/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60"> -->
  </div>

  <?php include '../utils/admin_nav.php' ?>

  <?php include '../utils/admin_side.php' ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
<?php 
$sql="SELECT * FROM `users` WHERE `verified`=1";
$result = mysqli_query($conn, $sql);
$user_count = mysqli_num_rows($result);

$sql="SELECT * FROM `questions`";
$result = mysqli_query($conn, $sql);
$question_count = mysqli_num_rows($result);

$sql="SELECT * FROM `tbl_comment`";
$result = mysqli_query($conn, $sql);
$answer_count = mysqli_num_rows($result);

$sql="SELECT * FROM `categories`";
$result = mysqli_query($conn, $sql);
$cat_count = mysqli_num_rows($result);
?>

    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box _users">
              <div class="inner">
                <h3><?php echo $user_count ?></h3>

                <p>Users</p>
              </div>
              <div class="icon">
              <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box _users">
              <div class="inner">
                <h3><?php echo $question_count ?><!--<sup style="font-size: 20px">%</sup>--></h3>

                <p>Questions</p>
              </div>
              <div class="icon">
                <i class="ion ion-help-circled"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box _users">
              <div class="inner">
                <h3><?php echo $answer_count ?></h3>

                <p>Answers</p>
              </div>
              <div class="icon">
                <i class="ion ion-chatboxes"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box _users">
              <div class="inner">
                <h3><?php echo $cat_count ?></h3>

                <p>Categories</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-list"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
<?php include '../utils/admin_footer.php' ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../utils/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../utils/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../utils/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../utils/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../utils/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../utils/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../utils/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../utils/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../utils/plugins/moment/moment.min.js"></script>
<script src="../utils/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../utils/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../utils/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../utils/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../utils/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../utils/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../utils/dist/js/pages/dashboard.js"></script>
</body>
</html>
