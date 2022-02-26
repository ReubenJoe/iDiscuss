<?php include 'config/db.php';

?>
<br><br><br>
<?php

$post_id=$_GET['del_id'];
$cat_name='';
$cat_id='';
$comment_id='';
$sql1="SELECT `Category` FROM `questions` WHERE `S.NO`='$post_id'";

$result1 = mysqli_query($conn, $sql1);
// echo '<pre>' . print_r($result1, TRUE) . '</pre>';
while($rows = mysqli_fetch_assoc($result1))
{
    $cat_name = $rows['Category']; 

}


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
    echo '<pre>' . print_r($sql, TRUE) . '</pre>';
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



header("location: http://localhost/iwp/category.php?cat_id=$cat_id");
?>