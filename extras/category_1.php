<?php include 'utils/nav.php'; 
?>



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
<!-- Bootstrap CSS alerts-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
 
<!--Bootstrap for tags-->


<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->
<link rel="stylesheet" href="discussion/tags/src/bootstrap-tagsinput.css">

<br><br><br>

<?php

if ($show_Alert==TRUE)
{
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Your Question has been added successfully!</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    
}

?>
<?php 
    $id=$_GET['cat_id'];
    $sql = "SELECT `category_desc` FROM `categories` WHERE `category_id` = $id";
    $result = mysqli_query($conn, $sql);   

    while($rows = $result->fetch_assoc())
    {
        $catdesc = $rows['category_desc'];
    }
?>
    <div class="container my-4">

<div class="bg-dark p-5 rounded-lg m-3">
    <h1 class="display-4 text-light">Welcome to <?php echo $_SESSION['category'] ?> forums</h1>
    <p class="lead text-light"><?php echo $catdesc; ?></p>
    <hr class="my-4 text-light" style="border: 1.5px solid #ff4584;">
    <p class="text-light">This is a peer to peer forum. No Spam / Advertising /
            Self-promote in the forums is not allowed. Do not post copyright-infringing material. ...
            Do not post “offensive” posts, links or images. Do not cross post questions.
            Remain respectful of other members at all times.
    </p>
</div>
</div>

<form action="<?php $_SERVER['REQUEST_URI']?>" method="post">
<input type = "text" name = "enter_question" value="<?php echo $_SESSION['question_title'];?>" />
<br>
<textarea name = "que_desc" required></textarea>
<br>
<input type="text" name="que_tags" style="font-size: x-large;" data-role="tagsinput" />
<br>
<input type="text" name="category" value="<?php echo $_SESSION['category']?>" readonly />
<br><br>
<input type="submit" value="Ask" name="q-btn">
</form>

<?php
      
    $id=$_GET['cat_id'];
  
    $category= "SELECT `category_name` FROM `categories` WHERE `category_id` = $id";
    $result = mysqli_query($conn, $category);   
 
    while($rows = $result->fetch_assoc())
    {
      $catname = $rows['category_name'];
    }

      $sql="SELECT * FROM `questions` WHERE `Category`='$catname'";

      $result=mysqli_query($conn, $sql);
      $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

      $noResult=true;
      
    ?>
    <?php foreach ($posts as $post): 
        $tags=$post['Tags'];
        $str_arr = explode (",", $tags);
        ?>
       <div class="container">
          <div class="row justify-content-center">
              <div class="col-lg-9 bg-light rounder mt-3">
                  <div class="card mb-2 border-secondary">
                      <div class="card-header py-1 text-light" style="background-color: #ff4583b2;;">
                          <span class="font-italic text-dark">Posted By: <span class="fw-bold"></span><?php echo($post['Asked By'])?></span>
                          <span class="float-end font-italic text-light fw-bold"><?php echo($post['DATETIME'])?></span>
                      </div>
                      <div class="card-body py-2">
                          <p class="card-text">
                              <a href="#" class="text-dark" id="question"><?php echo($post['Question title'])?></a>
                          </p>
                      </div>

                      
                      <div class="card-footer py-2">
                      <?php foreach($str_arr as $value):?>
                        <div class="float-start ms-1">
                            <a href="#" class="text-decoration-none border border-primary rounded p-1 badge bg-primary bg-gradient">
                            <?php echo $value?>
                            </a>
                        </div>  
                        <?php endforeach?> 
                        <!-- <div class="float-start ms-1">
                            <a href="#" class="text-decoration-none border border-primary rounded p-1 badge bg-primary bg-gradient">
                               #sample-tag
                            </a>
                        </div>   
                        <div class="float-start ms-1">
                            <a href="#" class="text-decoration-none border border-primary rounded p-1 badge bg-primary bg-gradient">
                               #sample-tag
                            </a>
                        </div>    -->
                        <div class="float-end">
                              <a href="#" class="text-dark" title="Delete"><i class="far fa-thumbs-up">&nbsp;2</i></a>
                              <a href="#" class="text-dark ms-2" title="Edit"><i class="far fa-thumbs-down">&nbsp;7</i></a>
                        </div>
                        
                      </div>
                      
                  </div>
              </div>
        <?php endforeach ?>






<!-- Option 1: Bootstrap Bundle with Popper --><!--for alert-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>


<!--tags js-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="discussion/tags/src/bootstrap-tagsinput.js"></script>