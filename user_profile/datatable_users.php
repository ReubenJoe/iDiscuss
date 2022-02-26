<?php include '../controllers/authController.php' ?>
<?php
$sql="SELECT * FROM `users` WHERE `username`<>'admin'";
$result_users=mysqli_query($conn, $sql);
$show_Alert_delete=false;

?>

<?php
if (isset($_POST['delete_user']))
{
    $uid=$_POST['snodelete'];

    $sql1="SELECT `username` FROM `users` WHERE `id`='$uid'";
    $result1 = mysqli_query($conn, $sql1);
    while ($row1 = mysqli_fetch_assoc($result1))
    {
        $result2 = $row1['username'];
    }

    $sql_mail="SELECT `email` FROM `users` WHERE `id`='$uid'";
    $result_mail = mysqli_query($conn, $sql_mail);
    while ($row2 = mysqli_fetch_assoc($result_mail))
    {
        $UserEmail = $row2['email'];
        user_delete($UserEmail);
    }

    // echo '<pre>' . print_r($result2, TRUE) . '</pre>';
    $sql2="DELETE FROM `questions` WHERE `Asked By`='$result2'";
    $result3 = mysqli_query($conn, $sql2);

    $sql3="DELETE FROM `tbl_comment` WHERE `comment_sender_name`='$result2'";
    $result4 = mysqli_query($conn, $sql3);

    $sql4="DELETE FROM `rating_info` WHERE `user_id`='$uid'";
    $result5 = mysqli_query($conn, $sql4);

    $sql5="DELETE FROM `users` WHERE `id`='$uid'";
    $result6 = mysqli_query($conn, $sql5);

    if($result6){
        $show_Alert_delete=true;
        }
        header("Refresh:1");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Table</title>

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
    <!-- Toastr -->
    <link rel="stylesheet" href="../utils/plugins/toastr/toastr.min.css">
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
                            <h1>User Table</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="http://localhost/iwp/user_profile/home.php">Home</a></li>
                                <li class="breadcrumb-item active">User Table</li>
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
                                                <th>User ID</th>
                                                <th>Username</th>
                                                <th>Email ID</th>
                                                <th>Verified</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php while ($row = mysqli_fetch_assoc($result_users))
                                        {
                                            echo '  <tr>
                                                        <td>'.$row['id'].'</td>
                                                        <td>'.$row['username'].'</td>
                                                        <td>'.$row['email'].'</td>
                                                        <td>'.$row['verified'].'</td>
                                                        <td><a class="btn btn-danger btn-sm delete" data-toggle="modal"
                                                        data-target="#modal-delete">
                                                        <i class="fas fa-trash">
                                                        </i>
                                                        Delete
                                                    </a></td>
                                                    </tr>
                                            ';
                                        }
                                        ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>User ID</th>
                                                <th>Username</th>
                                                <th>Email ID</th>
                                                <th>Verified</th>
                                                <th>Actions</th>
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
        <div class="modal fade" id="modal-delete">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php $_SERVER['REQUEST_URI']?>" method="POST">
                    <div class="modal-body">
                        <input type="text" name="snodelete" id="snodelete">
                        <p>Are you sure you want to delete this user?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-secondary"
                            style="background-color:rgb(61, 61, 61); border-color:rgb(61, 61, 61);"
                            data-dismiss="modal">Close</button>

                        <button type="submit" name="delete_user"
                            style="background-color: #ff4583; border-color: #ff4583;" class="btn btn-primary">Delete
                            User</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
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
    <!-- Toastr -->
    <script src="../utils/plugins/toastr/toastr.min.js"></script>
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
    <script>
$('document').ready(function() {
    edits = document.getElementsByClassName('delete');
    Array.from(edits).forEach((element) => {
        element.addEventListener("click", (e) => {
            console.log("edit ", e.target.parentNode.parentNode);
            tr = e.target.parentNode.parentNode;
            uid = tr.getElementsByTagName("td")[0].innerText;
            console.log(uid);
            snodelete.value = uid;
            $('#modal-delete').modal('toggle');
        })
    })
})
</script>


<script>
<?php if ($show_Alert_delete): ?>
toastr.success('Category deleted successfully')
<?php endif ?>
</script>
</body>

</html>