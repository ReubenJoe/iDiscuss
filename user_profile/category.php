<?php include '../controllers/authController.php' ?>
<?php
$uname=$_SESSION['username'];

$sql="SELECT DISTINCT `Category` FROM `questions` WHERE `Asked By`='$uname'";
$result_categories=mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Categories</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../utils/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../utils/dist/css/adminlte.min.css">
</head>


<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php include '../utils/user_nav.php' ?>

        <?php include '../utils/user_side.php' ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Categories</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="http://localhost/iwp/user_profile/home.php">Home</a></li>
                                <li class="breadcrumb-item active">Categories</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <br><br>
                    <div class="card card-success">
                        <div class="card-body">
                            <div class="row">
                                <?php while ($row = mysqli_fetch_assoc($result_categories)):?>
                                <div class="col-md-12 col-lg-6 col-xl-4">
                                    <div class="card mb-2 bg-gradient-dark">
                                        <img class="card-img-top"
                                            src="https://source.unsplash.com/362x242/?<?php echo $row['Category']?>"
                                            alt="<?php echo $row['Category']?>">
                                        <div class="card-img-overlay d-flex flex-column justify-content-end">
                                            <h5 class="card-title text-primary text-white mb-3"
                                                style="font-weight: bold; font-size: 2rem; text-shadow: 0px 0px 4px #000">
                                                <?php echo $row['Category']?></h5>
                                        </div>
                                    </div>
                                </div>
                                <?php endwhile?>
                            </div>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->

            <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
                <i class="fas fa-chevron-up"></i>
            </a>
        </div>

        <!-- /.content-wrapper -->

        <?php include '../utils/admin_footer.php' ?>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="../utils/plugins/jquery/jquery.min.js"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <!-- Bootstrap 4 -->
    <script src="../utils/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../utils/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../utils/dist/js/demo.js"></script>
</body>

</html>