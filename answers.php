<?php include 'utils/nav.php'; 

//include 'delete_question.php';

?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Bootstrap CSS alerts-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<!--Bootstrap for tags-->


<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->
<link rel="stylesheet" href="discussion/tags/src/bootstrap-tagsinput.css">

<link rel="stylesheet" href="css/style_userverify.css">
<link rel="stylesheet" href="css/style_nav_pages.css">

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->



<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>




<script src="js/comments.js"></script>
<script src="js/scriptvote1.js"></script>
<!-- <script src="js/comments.js"></script> -->
<br><br><br>







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

a:hover {
    color: white;
}

#question {
    text-decoration: none;
}

#question:hover {
    text-decoration: underline;
}

section {
    margin-bottom: -15%;
}

section .contentBx {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 93%;
    height: 75%;
    margin-left: 3.5%;
}

section .contentBx .formBx {
    width: 83%;
}

textarea {
    width: 100%;
    padding: 10px 20px;
    outline: none;
    font-weight: 400;
    border: 1px solid #607d8b;
    font-size: 16px;
    letter-spacing: 1px;
    color: #607d8b;
    background: transparent;
    border-radius: 30px;
    margin-bottom: 5px;
    resize: none;
}

h2 {
    color: #607d8b;
    font-weight: 600;
    font-size: 1.5em;
    text-transform: uppercase;
    margin-bottom: 20px;
    border-bottom: 4px solid #ff4584;
    display: inline-block;
    letter-spacing: 1px;
}

.posthead {
    color: #607d8b;
    font-weight: 600;
    font-size: 1.5em;
    text-transform: uppercase;
    margin-bottom: 20px;
    border-bottom: 4px solid #ff4584;
    display: inline-block;
    letter-spacing: 1px;
}

::-webkit-scrollbar {
    width: 7px;
    height: 10px;
}

::-webkit-scrollbar-track {
    background: transparent;
    border-radius: 10px;
}

::-webkit-scrollbar-thumb {
    background: rgba(255, 69, 131, 0.7);
    border-radius: 10px;
}

::-webkit-scrollbar-button {
    width: 10px;
    height: 20px;
}
#tags {
    margin-bottom: 20px;
}

#iptag {
    color: #607d8b;
}

ol,
ul {
    padding-left: 0rem;
}

#readMore:hover {
    color: #fff;
    background-color: transparent;
    border-color: #fff;
}

/* ------------------------ search bar ------------------------- */
.search-box {
    position: relative;
    height: 50px;
    width: 40%;
    margin-bottom: 2rem;
}

.search-box input {
    height: 100%;
    width: 100%;
    border: none;
    outline: none;
    background-color: white;
    color: #000;
    font-weight: 100;
    font-size: 16px;
    border-radius: 50px;
    padding: 0 60px 0 20px;
    box-shadow: 0px 2px 4px rgba(12, 18, 18, 0.4);
}

.search-box input:placeholder-shown {
    font-weight: 100;
}

.search-box .search-btn {
    position: absolute;
    transform: translate(-15%, 12%);
    right: 0;
    top: 0;
    height: 2.5rem;
    width: 2.5rem;
    color: #fff;
    background: rgba(0, 0, 0, 0.774);
    line-height: 2.5rem;
    font-size: 1rem;
    text-align: center;
    border-radius: 50px;
    cursor: pointer;
}

.search-box .search-btn:hover {
    background: #e91e63;
    color: white;
}
</style>



<?php 
// $category= $_SESSION['category'];
// $sql = "SELECT category_desc FROM `categories` WHERE `category_name`='$category'"; 
// $result=mysqli_query($conn, $sql);
// $row=mysqli_fetch_assoc($result);
// $catdesc=$row['category_desc'];
?>


<?php if ($show_Alert_ans==TRUE):?>

<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Your answer is updated successfully!</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>



<?php endif ?>

<?php if ($show_Alert_wrong_edit_que==TRUE):?>

<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Your are not allowed to update this answer!</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

<?php endif ?>

<?php 

$id=$_GET['post_id'];
?>
<?php if ($show_Alert==TRUE):?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Your answer is posted successfully!</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

<?php endif ?>
<?php

$sql = "SELECT * FROM `answers` WHERE `post_id` = '$id'";
$result_answer = mysqli_query($conn, $sql);
$answering = mysqli_fetch_all($result_answer, MYSQLI_ASSOC);


$noResult=true;  
?>

<?php
    $sql = "SELECT * FROM `questions` WHERE `S.NO` = '$id'";

    $result2 = mysqli_query($conn, $sql); 
   
    while($row=mysqli_fetch_assoc($result2)){
        $title=$row['Question title'];
        $desc=$row['Question Description'];
        $thread_user=$row['Asked By'];
        
       }
    $username=$_SESSION['username'];
    $sql= "SELECT `id` FROM `users` WHERE `username` = '$username'";
    $result = mysqli_query($conn, $sql);
    
    $row=mysqli_fetch_assoc($result);
    $user_id = $row['id'];
?>

<div id="comment_message"></div>

<div class="container my-4 col-lg-10">
    <div class="bg-dark p-5 rounded m-3">
        <h1 class="display-4 text-light"><?php echo $title ?></h1>
        <hr class="my-4 text-light" style="height: 2px; background-color:#ffffff ;">
        <p class="lead text-light"><?php echo $desc; ?></p>
        <p class="text-light">Posted by :&nbsp;&nbsp;<button type="button" class="btn btn-outline-light" id="readMore"><?php echo $thread_user; ?></button></p>
        

    </div>
</div>





<?php if(isset($_SESSION['username'])):?>
<!-- <section>
    <div class="contentBx">
        <div class="formBx">
            <h2>Post a Comment</h2>
            <form action="<?php //$_SERVER['REQUEST_URI']?>" method="post" id="comment_form">
            <div class="inputBx">
                <input type="text" name="comment_name" id="comment_name" value="<?php //echo $_SESSION['username'];?>"/>
                </div>
                <div class="inputBx">
                    <span>Comment Description</span>
                    <textarea name="comment_content" id="comment_content" rows="5" required></textarea>
                </div>
                <div class="inputBx">
                <input type="hidden" name="post_id" value="<?php //echo ($id)?>">
                <input type="hidden" name="comment_id" id="comment_id" value="0" />
                <input type="hidden" name="user_id" value="<?php //echo ($user_id)?>">
                </div>
                <div class="inputBx">
                    <input type="submit" name="submit" id="submit" value="Post comment">
                </div>
            </form>
        </div>
    </div>
</section> -->

<?php
if(isset($_POST['submit']))
{
    $desc=$_POST['comment_content'];
    $comment_content = word_check($desc);
    $no=1;
    echo '<pre>' . print_r($no, TRUE) . '</pre>';
}

?>

<p id="post_id" hidden><?php echo $id; ?></p>
<section>
    <div class="contentBx">
        <div class="formBx">
            <h2>Post a Comment</h2>
            <form action="<?php $_SERVER['REQUEST_URI']?>" method="POST" id="comment_form">
                <div class="inputBx">
                    <input type="text" name="comment_name" id="comment_name" value="<?php echo $_SESSION['username'];?>"
                        placeholder="Enter Name" />
                </div>
                <div class="inputBx">
                    <span>Comment Description</span>
                    <textarea name="comment_content" id="comment_content" placeholder="Enter Comment"
                        rows="5"></textarea>
                </div>
                <div class="inputBx">
                    <input type="hidden" name="comment_id" id="comment_id" value="0" />
                    <input type="hidden" name="post_id" value="<?php echo ($id)?>">
                </div>

                <div class="inputBx">
                    <input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit" />
                </div>
            </form>

        </div>
    </div>
</section>



<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-11 rounder mt-4">
            <h2 class="posthead">Browse Comments</h2>
            
            <br />
            <div id="display_comment"></div>
        </div>
    </div>
</div>






<?php else: ?>
<div class="container">
    <p class="lead">You are not logged in. Please login to be able to Post comments.</p>
</div>
<?php endif?>

<!-- <span id="comment_message"></span>
   <br />
   <div id="display_comment"></div> -->




<?php
$sql = "SELECT * FROM `tbl_comment` WHERE `post_id`=$id";
$result = mysqli_query($conn, $sql);
$numExistRows = mysqli_num_rows($result);
if ($numExistRows > 0) {
    $noResult=false;
} 

?>



<?php if($noResult):?>

<div class="container my-4 col-lg-10">
    <div class="bg-secondary bg-gradient p-5 rounded m-3">
        <h1 class="display-4 text-light">No Answers Found!</h1>
        <hr class="my-4 text-light" style="height: 2px; background-color:#ffffff ;">
        <p class="lead text-light">Be the first person to answer the question.</p>
    </div>
</div>
<?php endif ?>
<?php include 'utils/footer.php' ?>





<script>
// $(document).ready(function() {
//     var post_id = document.getElementById('post_id').innerHTML;

//     $('#comment_form').on('submit', function(event) {
//         event.preventDefault();
//         var form_data = $(this).serialize();
//         alert(form_data);
//         $.ajax({
//             url: "add_comment.php",
//             method: "POST",
//             data: form_data,
//             dataType: "JSON",
//             success: function(data) {
//                 if (data.error != '') {
//                     $('#comment_form')[0].reset();
//                     $('#comment_message').html(data.error);
//                     $('#comment_id').val('0');
//                     load_comment();
//                 }
//             }
//         })
//     });

//     load_comment();



//     function load_comment() {
//         $.ajax({
//             url: "fetch_comment.php",
//             method: "POST",
//             data: {
//                 post_id: post_id
//             },
//             success: function(data) {
//                 $('#display_comment').html(data);
//             }
//         })
//     }

//     $(document).on('click', '.reply', function() {
//         var comment_id = $(this).attr("id");
//         $('#comment_id').val(comment_id);
//         $('#comment_name').focus();
//     });

// });
</script>





<!-- Option 1: Bootstrap Bundle with Popper -->
<!--for alert-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
</script>


<!--tags js-->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->

<script src="discussion/tags/src/bootstrap-tagsinput.js"></script>