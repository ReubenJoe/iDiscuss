<?php include 'controllers/authController.php' ?>
<script src="js/scriptvote1.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<?php

//fetch_comment.php

$connect = new PDO('mysql:host=localhost;dbname=discnet', 'root', '');

$post_id = $_POST['post_id'];
$query = "
SELECT * FROM tbl_comment 
WHERE post_id='$post_id' AND parent_comment_id = '0' 
ORDER BY comment_id DESC
";


// $query = "SELECT * FROM tbl_comment  WHERE post_id=':post_id' AND parent_comment_id = '0' ORDER BY comment_id DESC";

// $statement = $connect->prepare($query);
// $statement->execute(
//  array(
//   ':post_id' => $_POST['post_id']
//  )
// );



$class1='';
$class2='';
$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();
$output = '';
foreach($result as $row)
{
//  $output .= '
//  <div class="panel panel-default">
//   <div class="panel-heading">By <b>'.$row["comment_sender_name"].'</b> on <i>'.$row["date"].'</i></div>
//   <div class="panel-body">'.$row["comment"].'</div>
//   <div class="panel-footer" align="right"><button type="button" class="btn btn-default reply" id="'.$row["comment_id"].'">Reply</button></div>
//  </div>
//  ';
//  $output .= get_reply_comment($connect, $row["comment_id"]);
if (userLiked($row['comment_id'])){
    $class1="fa fa-thumbs-up like-btn";
}
else
{
    $class1="fa fa-thumbs-o-up like-btn";
}

if (userDisliked($row['comment_id'])){
    $class2="fa fa-thumbs-down dislike-btn";
}

else
{
    $class2="fa fa-thumbs-o-down dislike-btn";
}
$output.='<div class="card mb-4 shadow border-secondary">
<div class="card-header py-1 text-light rounder"
    style="background: linear-gradient(to right, #ff4584, purple);">
    <span class="font-italic text-dark">Posted By: <span
            class="fw-bold">'.$row["comment_sender_name"].'</span></span>
    <span class="float-end font-italic text-light fw-bold">'.$row["date"].'</span>
</div>
<div class="card-body py-2">
    <p class="card-text">
        <a href="#" class="text-dark fw-normal"
            id="question">'.$row["comment"].'</a>
    </p>
</div>
<div class="card-footer py-2 bg-light bg-gradient">
<div class="float-end">
<a class="text-dark ms-2 edit" id="'.$row["comment_id"].'" title="Edit"><i class="fa fa-pencil-square-o">&nbsp;&nbsp;&nbsp;</i></a>
<a onclick="del('.$row["comment_id"].')" class="text-dark" title="Edit"><i class="fa fa-trash">&nbsp;</i></a>
<a class="text-dark ms-2 reply" id="'.$row["comment_id"].'" title="Reply"><i class="fa fa-reply">&nbsp;&nbsp;&nbsp;&nbsp;</i></a>
<i class="'.$class1.'" data-id="'.$row['comment_id'].'"></i>
&nbsp;&nbsp;
<span class="likes">'.getLikes($row["comment_id"]).'</span>

&nbsp;&nbsp;&nbsp;

<i class="'.$class2.'" data-id="'.$row['comment_id'].'"></i>
<span class="dislikes">'.getDislikes($row["comment_id"]).'</span>
</div>
</div>
</div>';
$output .= get_reply_comment($connect, $row["comment_id"]);
}


echo $output;

function get_reply_comment($connect, $parent_id = 0, $marginleft = 0)
{
$query = "
SELECT * FROM tbl_comment WHERE parent_comment_id = '".$parent_id."'
";
$output = '';
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$count = $statement->rowCount();
if($parent_id == 0)
{
$marginleft = 0;
}
else
{
$marginleft = $marginleft + 48;
}
if($count > 0)
{
foreach($result as $row)
{
// $output .= '
// <div class="panel panel-default" style="margin-left:'.$marginleft.'px">
//     <div class="panel-heading">By <b>'.$row["comment_sender_name"].'</b> on <i>'.$row["date"].'</i></div>
//     <div class="panel-body">'.$row["comment"].'</div>
//     <div class="panel-footer" align="right"><button type="button" class="btn btn-default reply" id="'.$row["comment_id"].'">Reply</button></div>
// </div>
// ';

if (userLiked($row['comment_id'])){
    $class1="fa fa-thumbs-up like-btn";
}
else
{
    $class1="fa fa-thumbs-o-up like-btn";
}

if (userDisliked($row['comment_id'])){
    $class2="fa fa-thumbs-down dislike-btn";
}

else
{
    $class2="fa fa-thumbs-o-down dislike-btn";
}
$output.='<div class="card mb-4 shadow border-secondary" style="margin-left:'.$marginleft.'px">
<div class="card-header py-1 text-light rounder"
    style="background: linear-gradient(to right, #ff4584, purple);">
    <span class="font-italic text-dark">Posted By: <span
            class="fw-bold">'.$row["comment_sender_name"].'</span></span>
    <span class="float-end font-italic text-light fw-bold">'.$row["date"].'</span>
</div>
<div class="card-body py-2">
    <p class="card-text">
        <a href="#" class="text-dark fw-normal"
            id="question">'.$row["comment"].'</a>
    </p>
</div>
<div class="card-footer py-2 bg-light bg-gradient">
<div class="float-end">
<a class="text-dark ms-2 edit" id="'.$row["comment_id"].'" title="Edit"><i class="fa fa-pencil-square-o">&nbsp;&nbsp;&nbsp;</i></a>
<a onclick="del('.$row["comment_id"].')" class="text-dark" title="Edit"><i class="fa fa-trash">&nbsp;</i></a>
<a class="text-dark ms-2 reply" id="'.$row["comment_id"].'" title="Reply"><i class="fa fa-reply">&nbsp;&nbsp;&nbsp;&nbsp;</i></a>
<i class="'.$class1.'" data-id="'.$row['comment_id'].'"></i>
&nbsp;&nbsp;
<span class="likes">'.getLikes($row["comment_id"]).'</span>

&nbsp;&nbsp;&nbsp;

<i class="'.$class2.'" data-id="'.$row['comment_id'].'"></i>
<span class="dislikes">'.getDislikes($row["comment_id"]).'</span>
</div>
</div>
</div>';

$output .= get_reply_comment($connect, $row["comment_id"], $marginleft);
}
}
return $output;
}

?>

<script>
function del(comment_id)
{
    x=confirm("Are you sure that you want to delete this?");

    if (x==true)
    {
        window.location.href='delete_answer.php?comment_id='+comment_id;
        return true;
    }
}
</script>
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit this Answer</h5>
          <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> -->
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <span aria-hidden="true"></span>
          </button>
        </div>
        <form action="<?php $_SERVER['REQUEST_URI']?>" method="POST">
          <div class="modal-body">
            <input type="hidden" name="comment_id_edit" id="comment_id_edit">
            <div class="form-group">
              <label for="desc">Answer Description</label>
              <textarea class="form-control" id="commentEdit" name="commentEdit" rows="3"></textarea>
            </div> 
          </div>
          <div class="modal-footer d-block mr-auto">
            <button type="button" class="btn btn-secondary" style="background-color:rgb(61, 61, 61); border-color:rgb(61, 61, 61);" data-dismiss="modal">Close</button>

            <button type="submit" name="edit_submit_answer" style="background-color: #ff4583; border-color: #ff4583;" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<script>
$('document').ready(function(){
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
       element.addEventListener("click", (e) => {
        console.log("edit ",e.target.parentNode.parentNode.parentNode.parentNode);
        tr = e.target.parentNode.parentNode.parentNode.parentNode;
        comment = tr.getElementsByTagName("a")[0].innerText;
        // description = tr.getElementsByTagName("a")[1].innerText;
        // console.log(title);
        // titleEdit.value = title;
        commentEdit.value = comment;
        comment_id_edit.value = e.target.parentNode.id;
        console.log(e.target.parentNode.id);
        $('#editModal').modal('toggle');
      })
    })
})
</script>