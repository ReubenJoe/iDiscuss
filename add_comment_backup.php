<?php

//add_comment.php

$connect = new PDO('mysql:host=localhost;dbname=discnet', 'root', '');

$error = '';
$comment_name = '';
$comment_content = '';
$badwords=['aaa','idiot','shit'];


if(empty($_POST["comment_name"]))
{
 $error .= '<p class="text-danger">Name is required</p>';
}
else
{
 $comment_name = $_POST["comment_name"];
}

if(empty($_POST["comment_content"]))
{
 $error .= '<p class="text-danger">Comment is required</p>';
}
else
{
 $comment_content = $_POST["comment_content"];
 $string_to_array= explode(" ", $comment_content);
 // echo '<pre>' . print_r($string_to_array, TRUE) . '</pre>';
 
 foreach ($string_to_array as $word)
 {
    //  $sql="SELECT * FROM `badwords` WHERE `words` LIKE '$word'";
    //  $result=mysqli_query($conn,$sql);
     // $query = mysqli_query("SELECT * FROM `badwords` WHERE `words` LIKE '$word'");
    //  while($row = mysqli_fetch_array($result))
    //  {
        $arr=array();
  foreach ($badwords as $i)
  {

      if ($i==$word)
      {
        array_push($arr,$i);
      }
  }
        foreach ($arr as $w)
        {
            $word_found = $w;
            $new_word = preg_replace('/(?!^.?).(?!.{0}$)/', '*', $word_found);
            
            $key = array_search($word_found,$string_to_array);
            $length = strlen($word_found)-1;
    
            $replace = array($key => $new_word);
            $string_to_array = array_replace($string_to_array,$replace);
        }
    //  }
 }
 
 $new_string = implode(" ", $string_to_array);
 $comment_content= $new_string;
}

if($error == '')
{
 $query = "INSERT INTO tbl_comment (parent_comment_id, comment, comment_sender_name, post_id) VALUES (:parent_comment_id, :comment, :comment_sender_name,:post_id)
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':parent_comment_id' => $_POST["comment_id"],
   ':comment'    => $comment_content,
   ':comment_sender_name' => $comment_name,
   ':post_id' => $_POST['post_id']
  )
 );
 $error = ' 

            <script>
            window.scrollTo(0, 0);
            function timeRefresh(timeoutPeriod) {
                setTimeout("location.reload(true);", timeoutPeriod);
            }
            
            timeRefresh(5000);
            
            
            </script>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>'.$comment_content.'</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';

}

$data = array(
 'error'  => $error
);

echo json_encode($data);

?>
