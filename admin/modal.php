<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Modals & Alerts</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../utils/plugins/fontawesome-free/css/all.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="../utils/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="../utils/plugins/toastr/toastr.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../utils/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

  </div>
  <!-- /.content-wrapper -->
  <button type="button" class="btn btn-success toastrDefaultSuccess">
                  Launch Success Toast
                </button>

<!-- jQuery -->
<script src="../utils/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../utils/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Toastr -->
<script src="../utils/plugins/toastr/toastr.min.js"></script>
<!-- AdminLTE App -->
<script src="../utils/dist/js/adminlte.min.js"></script>
<!-- Page specific script -->
<script>
  $(function() {
    $('.toastrDefaultSuccess').click(function() {
      toastr.success('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
  });
</script>
</body>
</html>
