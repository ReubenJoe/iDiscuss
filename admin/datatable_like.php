<?php include '../config/db.php' ?>

<?php

$sql_like="SELECT COUNT(rating_action) as `likerate`,`comment`, `comment_sender_name` 
FROM tbl_comment, rating_info WHERE rating_action='like' AND tbl_comment.comment_id=rating_info.post_id";
$sql_like=mysqli_query($conn, $sql_like);
$sql_dislike="SELECT COUNT(rating_action) as `dislikerate` FROM tbl_comment, rating_info WHERE rating_action='dislike' AND tbl_comment.comment_id=rating_info.post_id";
$sql_dislike=mysqli_query($conn, $sql_dislike);
// $result_dislike=mysqli_query($conn, $sql_dislike);
// echo '<pre>' . print_r($result_answer, TRUE) . '</pre>';


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | DataTables</title>

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
        <?php include '../utils/admin_nav.php' ?>

        <?php include '../utils/admin_side.php' ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>DataTables</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">DataTables</li>
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
                                    <h3 class="card-title">Users</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="users" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Comment</th>
                                                <th>Comment Sender Name</th>
                                                <th>Likes</th>
                                                <th>Dislikes</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                        <?php 
                                        // while($row1=mysqli_fetch_assoc($sql_like) or $row2=mysqli_fetch_assoc($sql_dislike))
                                        // {
                                        //     echo '<tr>
                                        //     <td>'.$row1['comment'].'</td>
                                        //     <td>'.$row1['comment_sender_name'].'</td>
                                        //     <td>'.$row1['likerate'].'</td>
                                        //     <td>'.$row2['dislikerate'].'</td>
                                        //     </tr>
                                        //     ';
                                        // }
                                        
                                        // while($row2=mysqli_fetch_assoc($sql_dislike))
                                        // {
                                        //     echo '  
                                        //                 <td>'.$row2['dislikerate'].'</td>
                                                    
                                        //                 </tr>';
                                        // }
                                        
                                        ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Comment</th>
                                                <th>Comment Sender Name</th>
                                                <th>Likes</th>
                                                <th>Dislikes</th>
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