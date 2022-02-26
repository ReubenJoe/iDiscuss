<?php include '../controllers/authController.php'?>
<?php
$uname=$_SESSION['username'];


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Answer Dislikes</title>

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
                            <h1>Answer Dislikes Table</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="http://localhost/iwp/user_profile/home.php">Home</a></li>
                                <li class="breadcrumb-item active">Answer Dislikes Table</li>
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
                                    <h3 class="card-title">Dislikes</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="users" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Comment</th>
                                                <th>Comment Sender Name</th>
                                                <th>Replying To</th>
                                                <th>Dislikes</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                            $sql_comment_id= "SELECT `comment_id` FROM `tbl_comment` WHERE `comment_sender_name`='$uname'";
                                            $result_comment_id=mysqli_query($conn, $sql_comment_id);
                                            while($row1=mysqli_fetch_assoc($result_comment_id))
                                            {
                                                $comment_id=$row1['comment_id'];
                                                $sql_pid="SELECT `post_id` FROM `tbl_comment` WHERE `comment_id`='$comment_id'";
                                                $sql_post_id=mysqli_query($conn, $sql_pid);
                                                while($row1=mysqli_fetch_assoc($sql_post_id))
                                                {
                                                    $post_id=$row1['post_id'];
                                                    $sql_q_title="SELECT `Question Title` FROM `questions` WHERE `S.NO`='$post_id'";
                                                    $sql_que_title=mysqli_query($conn, $sql_q_title);
                                                    while($row1=mysqli_fetch_assoc($sql_que_title))
                                                    {
                                                        $que_title=$row1['Question Title'];
                                                        $sql_ans_like="SELECT COUNT(rating_action) as `dislikerate`, `comment`, `comment_sender_name` FROM `rating_info`,`tbl_comment` WHERE `comment_id`=$comment_id AND rating_action='like' AND rating_info.post_id=tbl_comment.comment_id";
                                                            $result_ans_like=mysqli_query($conn, $sql_ans_like);
                                                            while($r=mysqli_fetch_assoc($result_ans_like))
                                                            {
                                                                echo '<tr>
                                                                <td>'.$r['comment'].'</td>
                                                                <td>'.$r['comment_sender_name'].'</td>
                                                                <td>'.$que_title.'</td>
                                                                <td>'.$r['dislikerate'].'</td>
                                                                
                                                                </tr>';
                                                            } 
                                                    
                                                    }

                                                }
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Comment</th>
                                                <th>Comment Sender Name</th>
                                                <th>Replying To</th>
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