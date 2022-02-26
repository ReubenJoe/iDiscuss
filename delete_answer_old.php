<?php include 'config/db.php';

?>

<?php

$comment_id=$_GET['comment_id'];
$sql1="SELECT `post_id` FROM `tbl_comment` WHERE `comment_id`='$comment_id'";
$result1 = mysqli_query($conn, $sql1);  
while($rows = mysqli_fetch_assoc($result1))
{
    $post_id = $rows['post_id']; 
}
//echo '<pre>' . print_r($post_id, TRUE) . '</pre>';

$sql2="SELECT `comment_id` FROM `tbl_comment` WHERE `parent_comment_id`='$comment_id'";
$result2 = mysqli_query($conn, $sql2); 
while($rows = mysqli_fetch_assoc($result2))
{
    $comment_id_reply = $rows['comment_id']; 
    $sql="DELETE FROM `rating_info` WHERE `post_id`='$comment_id_reply'";
    //echo '<pre>' . print_r($sql, TRUE) . '</pre>';
    $result = mysqli_query($conn, $sql); 
} 

$sql="DELETE FROM `tbl_comment` WHERE `parent_comment_id`='$comment_id'";
$result = mysqli_query($conn, $sql);  

$sql="DELETE FROM `tbl_comment` WHERE `comment_id`='$comment_id'";
$result = mysqli_query($conn, $sql);  

$sql="DELETE FROM `rating_info` WHERE `post_id`='$comment_id'";
$result = mysqli_query($conn, $sql);   

header("location: http://localhost/iwp/answers.php?post_id=$post_id");
?>



<!-- <a href="#" class="text-dark ms-2" title="Edit"><i class="fa fa-pencil-square-o">&nbsp;</i></a> -->