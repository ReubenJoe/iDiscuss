<?php include '../controllers/authController.php'?>



<?php
$cat_name='';
$cat_id='';
$comment_id='';
$show_Alert_edit=false;
$show_Alert_delete=false;
$uname=$_SESSION['username'];
$sql_question="SELECT `S.NO`, `Question title`, `Question Description`, `Category`, `Tags`, `DATETIME` FROM `questions` WHERE `Asked By`= '$uname'";
$result_question=mysqli_query($conn, $sql_question);


?>
<?php
if (isset($_POST['edit_question']))
{
    $Question_title=$_POST['Question_title'];
    $Question_title=word_check($Question_title);
    $Question_Description=$_POST['Question_Description'];
    $Question_Description=word_check($Question_Description);
    $Category=$_POST['Category_name'];
    $Tags=$_POST['Tags'];
    $Tags=tags_check($Tags);
    $sno = $_POST['snoEdit'];
    $sql = "UPDATE `questions` SET `Question title` = '$Question_title',`Question Description` = '$Question_Description',`Category` = '$Category',`Tags` = '$Tags', `DATETIME`=current_timestamp()  WHERE `S.NO` = '$sno'";
    $result = mysqli_query($conn, $sql);
    if($result){
        $show_Alert_edit=true;
        
    }
    header("Refresh:1");
}

?>
<?php
if (isset($_POST['delete_question']))
{
    
    $post_id=$_POST['snodelete'];
    $sql1="SELECT `Category` FROM `questions` WHERE `S.NO`='$post_id'";
    $result1 = mysqli_query($conn, $sql1);
    
    while($rows = mysqli_fetch_assoc($result1))
    {
        $cat_name = $rows['Category']; 
        
    }

    // echo '<pre>' . print_r($cat_name, TRUE) . '</pre>';
    $sql2="SELECT `category_id` FROM `categories` WHERE `category_name`='$cat_name'";
    $result2 = mysqli_query($conn, $sql2);
    while($rows = mysqli_fetch_assoc($result2))
    {
        $cat_id = $rows['category_id']; 
    }
    
    
    $sql3="SELECT `comment_id` FROM `tbl_comment` WHERE `post_id`='$post_id'";
    $result3 = mysqli_query($conn, $sql3);
    while($rows = mysqli_fetch_assoc($result3))
    {
        $comment_id = $rows['comment_id']; 
        $sql="DELETE FROM `rating_info` WHERE `post_id`='$comment_id'";
        // echo '<pre>' . print_r($sql, TRUE) . '</pre>';
        $result = mysqli_query($conn, $sql);   
    }
    
    
    $sql="DELETE FROM `questions` WHERE `S.NO`='$post_id'";
    $result = mysqli_query($conn, $sql);   
    //  echo '<pre>' . print_r($cat_id, TRUE) . '</pre>';
    $sql="DELETE FROM `tbl_comment` WHERE `post_id`='$post_id'";
    $result = mysqli_query($conn, $sql);  
    $sql="DELETE FROM `rating_info` WHERE `post_id`='$post_id'";
    // echo '<pre>' . print_r($sql, TRUE) . '</pre>';
    $result = mysqli_query($conn, $sql); 
    if($result){
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
    <title>Question Threads</title>





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

    
    <link rel="stylesheet" href="../discussion/tags/src/bootstrap-tagsinput.css">
    
    
    <style>
    .bootstrap-tagsinput .tag {
        margin-right: 2px;
        color: white;
    }

    .label-info {
        background-color: #ff4584;
    }

    .label {
        display: inline;
        padding: .2em .6em .3em;
        font-size: 75%;
        font-weight: 700;
        line-height: 1;
        color: #fff;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: .25em;
    }
    </style>


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
                            <h1>Threads Table</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="http://localhost/iwp/user_profile/home.php">Home</a></li>
                                <li class="breadcrumb-item active">Question Threads Table</li>
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
                                    <h3 class="card-title">Question Threads</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="users" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Question title</th>
                                                <th>Question Description</th>
                                                <th>Question Posted At</th>
                                                <th>Category</th>
                                                <th>Tags</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($row = mysqli_fetch_assoc($result_question))
                                        {
                                            echo '  <tr>
                                                        <td style="display:none">'.$row['S.NO'].'</td>
                                                        <td>'.$row['Question title'].'</td>
                                                        <td>'.$row['Question Description'].'</td>
                                                        <td>'.$row['DATETIME'].'</td>
                                                        <td>'.$row['Category'].'</td>
                                                        <td>'.$row['Tags'].'</td>
                                                        <td><a class="btn btn-info btn-sm edit" id=\'<?php echo $row["category_id"]?>\'
                                            data-toggle="modal" data-target="#modal-edit">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Edit
                                            </a>
                                            &nbsp;&nbsp;
                                            <a class="btn btn-danger btn-sm delete" data-toggle="modal"
                                                data-target="#modal-delete">
                                                <i class="fas fa-trash">
                                                </i>
                                                Delete
                                            </a>
                                            </td>
                                            </tr>
                                            ';
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Question title</th>
                                                <th>Question Description</th>
                                                <th>Question Posted At</th>
                                                <th>Category</th>
                                                <th>Tags</th>
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


        <?php include '../utils/admin_footer.php' ?>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Question</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php $_SERVER['REQUEST_URI']?>" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="snoEdit" id="snoEdit">
                        <div class="form-group">
                            <label for="title">Question Title</label>
                            <input type="text" class="form-control" id="Question_title" name="Question_title" required>
                        </div>

                        <div class="form-group">
                            <label for="desc">Question Description</label>
                            <textarea class="form-control" id="Question_Description" name="Question_Description"
                                rows="5" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="title">Category</label>
                            <input type="text" class="form-control" id="Category_name" name="Category_name" readonly>
                        </div>
                        <!-- <div class="form-group">
                            <label for="title">Tags</label>
                            <input type="text" class="form-control" id="Tags" name="Tags" aria-describedby="tagHelp"
                                required>
                            <div id="tagHelp" class="form-text">Enter the tags separated by commas</div>
                        </div> -->
                        <div class="form-group">
                            <label for="tags">Tags</label>
                            <input type="text" name="Tags" id="Tags" data-role="tagsinput">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-secondary"
                            style="background-color:rgb(61, 61, 61); border-color:rgb(61, 61, 61);"
                            data-dismiss="modal">Close</button>

                        <button type="submit" name="edit_question"
                            style="background-color: #ff4583; border-color: #ff4583;" class="btn btn-primary">Save
                            changes</button>
                    </div>
                </form>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="modal fade" id="modal-delete">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Question</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php $_SERVER['REQUEST_URI']?>" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="snodelete" id="snodelete">
                        <p>Are you sure you want to delete this question?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-secondary"
                            style="background-color:rgb(61, 61, 61); border-color:rgb(61, 61, 61);"
                            data-dismiss="modal">Close</button>

                        <button type="submit" name="delete_question"
                            style="background-color: #ff4583; border-color: #ff4583;" class="btn btn-primary">Delete
                            Question</button>
                    </div>
                </form>


            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

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
    <!-- Toastr -->
    <script src="../utils/plugins/toastr/toastr.min.js"></script>

    <script src="../discussion/tags/src/bootstrap-tagsinput.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    
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
        edits = document.getElementsByClassName('edit');
        Array.from(edits).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("edit ", e.target.parentNode.parentNode);
                tr = e.target.parentNode.parentNode;
                Question_title.value = tr.getElementsByTagName("td")[1].innerText;
                Question_Description.value = tr.getElementsByTagName("td")[2].innerText;
                Category_name.value = tr.getElementsByTagName("td")[4].innerText;

                Tags.value = tr.getElementsByTagName("td")[5].innerText;

                snoEdit.value = tr.getElementsByTagName("td")[0].innerText;
                // console.log(tr);
                $('#modal-edit').modal('toggle');
            })
        })
    })
    </script>

    <script>
    $('document').ready(function() {
        edits = document.getElementsByClassName('delete');
        Array.from(edits).forEach((element) => {
            element.addEventListener("click", (e) => {
                tr = e.target.parentNode.parentNode;
                snodelete.value = tr.getElementsByTagName("td")[0].innerText;
                $('#modal-delete').modal('toggle');
            })
        })
    })
    </script>
</body>

<script>
<?php if ($show_Alert_edit): ?>
toastr.success('Question updated successfully');
<?php endif ?>
</script>
<script>
<?php if ($show_Alert_delete): ?>
toastr.success('Question deleted successfully');
<?php endif ?>
</script>

</html>