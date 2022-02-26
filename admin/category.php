<?php include '../controllers/authController.php' ?>
<?php
$show_Alert_add=false;
$show_Alert_edit=false;
$show_Alert_delete=false;
$sql="SELECT * FROM `categories`";
$result_categories=mysqli_query($conn, $sql);
?>
<?php
if (isset($_POST['add_category']))
{
    $cname=$_POST['category_name'];
    $cdesc=$_POST['category_desc'];
    $sql = "INSERT INTO `categories` (`category_name`, `category_desc`) VALUES ('$cname', '$cdesc')";
    $result = mysqli_query($conn, $sql);
    if($result){
        $show_Alert_add=true;
        
    }
    header("Refresh:1");
}
?>

<?php
if (isset($_POST['edit_category']))
{
    $cname=$_POST['category'];
    $cdesc=$_POST['desc'];
    $cid=$_POST['snoEdit'];
    $sql = "UPDATE `categories` SET `category_name` = '$cname',`category_desc` = '$cdesc' WHERE `category_id` = '$cid'";
    $result = mysqli_query($conn, $sql);
    if($result){
        $show_Alert_edit=true;
        
    }
    header("Refresh:1");
}
?>
<?php
if (isset($_POST['delete_category']))
{

    $cid=$_POST['snodelete'];

    $sql1="SELECT `category_name` FROM `categories` WHERE `category_id`='$cid'";
    $result1 = mysqli_query($conn, $sql1);
    while ($row1 = mysqli_fetch_assoc($result1))
    {
        $result1 = $row1['category_name'];
    }

    // echo '<pre>' . print_r($result1, TRUE) . '</pre>';

    $sql2="SELECT `S.NO` FROM `questions` WHERE `Category`='$result1'";
    $result2 = mysqli_query($conn, $sql2);
  
    while ($row2 = mysqli_fetch_assoc($result2))
    {
        $result8 = $row2['S.NO'];
        
        // echo '<pre>' . print_r($result8, TRUE) . '</pre>';
        $sql_new="DELETE FROM `rating_info` WHERE `post_id`='$result8'";
        // echo '<pre>' . print_r($sql_new, TRUE) . '</pre>';
        $result_new = mysqli_query($conn, $sql_new);


        $sql3="SELECT `comment_id` FROM `tbl_comment` WHERE `post_id`='$result8'";
        // echo '<pre>' . print_r($sql3, TRUE) . '</pre>';
        $result3 = mysqli_query($conn, $sql3);
        // echo '<pre>' . print_r($result3, TRUE) . '</pre>';
        while ($row3 = mysqli_fetch_assoc($result3))
        {
            $result4 = $row3['comment_id'];
            // echo '<pre>' . print_r($result4, TRUE) . '</pre>';
    
            $sql4="DELETE FROM `rating_info` WHERE `post_id`='$result4'";
            // echo '<pre>' . print_r($sql4, TRUE) . '</pre>';


            $result5 = mysqli_query($conn, $sql4);
    
            $sql5="DELETE FROM `tbl_comment` WHERE `comment_id`='$result4'";
            $result6 = mysqli_query($conn, $sql5);
        }
        $sql6 = "DELETE FROM `categories` WHERE `category_id` = '$cid'";
        $result7 = mysqli_query($conn, $sql6);

        $sql7="DELETE FROM `questions` WHERE `Category`='$result1'";
        $result8 = mysqli_query($conn, $sql7);

        if($result7){
        $show_Alert_delete=true;
        }
        header("Refresh:1");
    }



}
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
    <!-- Toastr -->
    <link rel="stylesheet" href="../utils/plugins/toastr/toastr.min.css">
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
                            <h1>Categories</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="http://localhost/iwp/admin/home.php">Home</a></li>
                                <li class="breadcrumb-item active">Categories</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <a class="btn btn-default btn-lg mb-3 text-white create_category" id="create_category"
                        style="background-color: #ff4583; border-color: #ff4583;" data-toggle="modal"
                        data-target="#modal-default">
                        <i class="fa fa-plus">
                        </i>
                        &nbsp;&nbsp;
                        Add Category
                    </a>
                    <br><br>
                    <div class="card card-success">
                        <div class="card-body">
                            <div class="row">
                                <?php while ($row = mysqli_fetch_assoc($result_categories)):?>
                                <div class="col-md-12 col-lg-6 col-xl-4">
                                    <div class="card mb-2 bg-gradient-dark">
                                        <img class="card-img-top"
                                            src="https://source.unsplash.com/362x242/?<?php echo $row['category_name']?>"
                                            alt="<?php echo $row['category_desc']?>">
                                        <div class="card-img-overlay d-flex flex-column justify-content-end">
                                            <h5 class="card-title text-primary text-white mb-3"
                                                style="font-weight: bold; font-size: 2rem; text-shadow: 0px 0px 4px #000">
                                                <?php echo $row['category_name']?></h5>
                                            <h5 hidden><?php echo $row['category_desc']?></h5>
                                            <!--edit and delete btn-->
                                            <div class="flex justify-content-end">
                                                <a class="btn btn-info btn-sm edit"
                                                    id="<?php echo $row['category_id']?>" data-toggle="modal"
                                                    data-target="#modal-edit">
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
                                            </div>
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

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Category</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php $_SERVER['REQUEST_URI']?>" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Category</label>
                            <input type="text" class="form-control" id="category_name" name="category_name"
                                aria-describedby="emailHelp" required>
                        </div>

                        <div class="form-group">
                            <label for="desc">Category Description</label>
                            <textarea class="form-control" id="category_desc" name="category_desc" rows="3"
                                required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-secondary"
                            style="background-color:rgb(61, 61, 61); border-color:rgb(61, 61, 61);"
                            data-dismiss="modal">Close</button>

                        <button type="submit" name="add_category"
                            style="background-color: #ff4583; border-color: #ff4583;" class="btn btn-primary">Add
                        </button>
                    </div>
                </form>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Category</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php $_SERVER['REQUEST_URI']?>" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="snoEdit" id="snoEdit">
                        <div class="form-group">
                            <label for="title">Category</label>
                            <input type="text" class="form-control" id="category" name="category"
                                aria-describedby="emailHelp" required>
                        </div>

                        <div class="form-group">
                            <label for="desc">Category Description</label>
                            <textarea class="form-control" id="desc" name="desc" rows="5" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-secondary"
                            style="background-color:rgb(61, 61, 61); border-color:rgb(61, 61, 61);"
                            data-dismiss="modal">Close</button>

                        <button type="submit" name="edit_category"
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
                    <h4 class="modal-title">Delete Category</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php $_SERVER['REQUEST_URI']?>" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="snodelete" id="snodelete">
                        <p>Are you sure you want to delete this category?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-secondary"
                            style="background-color:rgb(61, 61, 61); border-color:rgb(61, 61, 61);"
                            data-dismiss="modal">Close</button>

                        <button type="submit" name="delete_category"
                            style="background-color: #ff4583; border-color: #ff4583;" class="btn btn-primary">Delete
                            Category</button>
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
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <!-- Bootstrap 4 -->
    <script src="../utils/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../utils/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../utils/dist/js/demo.js"></script>
    <!-- Toastr -->
    <script src="../utils/plugins/toastr/toastr.min.js"></script>
</body>


<script>
$('document').ready(function() {
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
        element.addEventListener("click", (e) => {
            console.log("edit ", e.target.parentNode.parentNode);
            tr = e.target.parentNode.parentNode;
            comment = tr.getElementsByTagName("h5")[0].innerText;
            description = tr.getElementsByTagName("h5")[1].innerText;
            // console.log(title);
            category.value = comment;
            desc.value = description;
            console.log(comment, description);
            snoEdit.value = e.target.id;
            console.log(e.target.id);
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
            console.log("edit ", e.target.parentNode);
            tr = e.target.parentNode;
            comment = tr.getElementsByTagName("a")[0].id;
            // description = tr.getElementsByTagName("h5")[1].innerText;
            // console.log(title);
            // category.value = comment;
            // desc.value = description;
            // console.log(comment, description);
            snodelete.value = comment;
            $('#modal-delete').modal('toggle');
        })
    })
})
</script>


<script>
<?php if ($show_Alert_add): ?>
toastr.success('Category added successfully')
<?php endif ?>
</script>

<script>
<?php if ($show_Alert_edit): ?>
toastr.success('Category updated successfully')
<?php endif ?>
</script>

<script>
<?php if ($show_Alert_delete): ?>
toastr.success('Category deleted successfully')
<?php endif ?>
</script>

</html>



