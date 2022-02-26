<?php include '../controllers/authController.php'?>

<?php
$uname=$_SESSION['username'];
$sql_id="SELECT `id` FROM `users` WHERE `username`='$uname'";
$result_id=mysqli_query($conn, $sql_id);
while($row=mysqli_fetch_assoc($result_id))
{
    $id=$row['id'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Question Likes Table</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../utils/plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../utils/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../utils/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../utils/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
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
                            <h1>Question Likes Table</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="http://localhost/iwp/user_profile/home.php">Home</a></li>
                                <li class="breadcrumb-item active">Question Likes Table</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Likes</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="users" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Question Title</th>
                                                <th>Question Description</th>
                                                <th>Category</th>
                                                <th>Tags</th>
                                                <th>Likes</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            <?php $sql_post_id="SELECT `S.NO` FROM `questions` WHERE `Asked By`='$uname'";
                                            $result_post_id=mysqli_query($conn, $sql_post_id);
                                            while($row=mysqli_fetch_assoc($result_post_id))
                                            {
                                                $post_id=$row['S.NO'];

                                                $sql_q_like="SELECT COUNT(rating_action) as `likerate`, `Question title`, `Question Description`, `Category`, `Tags`, `Asked By` FROM `rating_info`,`questions` WHERE `post_id`=$post_id AND questions.`S.NO`=rating_info.post_id AND rating_action='like'";
                                                $result_que_like=mysqli_query($conn, $sql_q_like);
                                                while($r=mysqli_fetch_assoc($result_que_like))
                                                {
                                                    echo '<tr>
                                                    <td>'.$r['Question title'].'</td>
                                                    <td>'.$r['Question Description'].'</td>
                                                    <td>'.$r['Category'].'</td>
                                                    <td>'.$r['Tags'].'</td>
                                                    <td>'.$r['likerate'].'</td>
                                                    
                                                    </tr>';
                                                }   
                                            } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Question Title</th>
                                                <th>Question Description</th>
                                                <th>Category</th>
                                                <th>Tags</th>
                                                <th>Likes</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
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
    <!-- Bootstrap 4 -->
    <script src="../utils/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="../utils/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../utils/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../utils/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../utils/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../utils/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../utils/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../utils/plugins/jszip/jszip.min.js"></script>
    <script src="../utils/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../utils/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../utils/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../utils/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../utils/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../utils/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../utils/dist/js/demo.js"></script>
    <!-- Page specific script -->
    <script>
    $(function() {
        $("#users").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#users_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
    </script>
</body>

</html>