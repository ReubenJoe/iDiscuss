<?php include 'utils/nav.php'; 
?>
<!-- Bootstrap CSS -->
<!-- Latest compiled and minified CSS -->
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->
<!--upvote downvote-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="discussion/tags/src/bootstrap-tagsinput.css">
<!-- Optional theme -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/fontawesome.min.css" integrity="sha384-wESLQ85D6gbsF459vf1CiZ2+rr+CsxRY0RpiF1tLlQpDnAgg6rwdsUF1+Ics2bni" crossorigin="anonymous">



<style>

.alert_close{
    line-height: 0.5;
}

.qa-tag-link{
  color: #337ab7;
  text-decoration: none;
  cursor: pointer;
  padding: 4px 10px;
  border: 1px solid #e2e2e2;
  border-radius: 3px;
}

.fa {
    font-size: 1.2em;
  }
  .fa-thumbs-down, .fa-thumbs-o-down {
    transform:rotateY(180deg);
  }
  .logged_in_user {
    padding: 10px 30px 0px;
  }
</style>

<br><br><br><br>
<body>
<?php










if ($show_Alert==TRUE)
{
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Your Question has been added successfully</strong>
    <button type="button" class="close alert_close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>';
    
}
?>

    <?php 
        $id=1;
        $sql = "SELECT `category_desc` FROM `categories` WHERE `category_id` = $id";
        $result = mysqli_query($conn, $sql);   

        while($rows = $result->fetch_assoc())
        {
          $catdesc = $rows['category_desc'];
        }
    ?>
    
<div class="container my-4">

    <div class="jumbotron">
        <h1 class="display-4">Welcome to <?php echo $_SESSION['category'] ?> forums</h1>
        <p class="lead"><?php echo $catdesc; ?></p>
        <hr class="my-4">
        <p>This is a peer to peer forum. No Spam / Advertising /
            Self-promote in the forums is not allowed. Do not post copyright-infringing material. ...
            Do not post “offensive” posts, links or images. Do not cross post questions.
            Remain respectful of other members at all times.</p>
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

<div class="container mb-5">
    <h1 class="py-2">Browse Questions</h1>
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

      $noResult=true;

    ?>

<?php while($row=mysqli_fetch_assoc($result)): ?>
<?php
       $noResult=false;
       $id=$row['S.NO'];
       $title=$row['Question title'];
       $desc=$row['Question Description'];
       $thread_time=$row['DATETIME'];
       $thread_user_id=$row['Asked By'];
       $tags=$row['Tags'];
       $votes=$row['Upvotes'];
       $str_arr = explode (",", $tags);
        
       
      $sql2="SELECT user_email FROM `users` WHERE sno='$thread_user_id'";
      $result2=mysqli_query($conn,$sql2);
       $row2=mysqli_fetch_assoc($result2);

       ?>
  <div class="media my-3">
    <img src="images/user.jpg" width="54px" class="mr-3" alt="...">
    <div class="media-body">
    <p class="font-weight-bold my-0 float-right"><?php echo $thread_user_id ?> at <kbd class="text-danger"><?php echo $thread_time?></kbd></p>
      <h5 class="mt-0"><a class="text-dark" href="thread.php?threadid='.$id.'"><?php echo $title?></a></h5>  
    </div>
</div>
<?php if ($votes==NULL):?>
<?php $votes=0;?>
<?php endif?>

<?php foreach($str_arr as $value):?>
  <a href class="qa-tag-link" original-title="" title=""><?php echo $value?></a>&nbsp;&nbsp;
<?php endforeach?>
<br><br>



<div class="post-info">
  <i class="fa fa-thumbs-o-up like-btn" data-id="<?php echo $id?>"></i>
  <i class="fa fa-thumbs-o-down dislike-btn" data-id="<?php echo $id?>"></i>
</div>






<br><br>
<?php endwhile?>




<?php if($noResult):?>

  <div class="jumbotron jumbotron-fluid">
    <div class="container">
      <p class="display-4">No threads found</p>
      <p class="lead"><b>Be the first person to ask the question</b></p>
    </div>
  </div>

<?php endif?>

</div>





<script>

$(document).ready(function(){
		// if the user clicks on the like button ...
		$('.like-btn').on('click', function(){
			var post_id = $(this).data('id');
			$clicked_btn = $(this);

			if ($clicked_btn.hasClass('fa-thumbs-o-up')) {
				action = 'like';
				
			} else if($clicked_btn.hasClass('fa-thumbs-up')){
				action = 'unlike';
			}
			

			$.ajax({
				url: 'category.php',
				type: 'post',
				
				data: {
					'action': action,
					'post_id': post_id
				},
				success: function(data){
					
					res = JSON.parse(data);

					if (action == "like") {
						$clicked_btn.removeClass('fa-thumbs-o-up');
						$clicked_btn.addClass('fa-thumbs-up');
					} else if(action == "unlike") {
						$clicked_btn.removeClass('fa-thumbs-up');
						$clicked_btn.addClass('fa-thumbs-o-up');
					}
                
					$clicked_btn.siblings('span.likes').text(res.likes);
					$clicked_btn.siblings('span.dislikes').text(res.dislikes);

					$clicked_btn.siblings('i.fa-thumbs-down').removeClass('fa-thumbs-down').addClass('fa-thumbs-o-down');
				}
			});		

		});

		// if the user clicks on the dislike button ...
		$('.dislike-btn').on('click', function(){
			var post_id = $(this).data('id');
			$clicked_btn = $(this);

			if ($clicked_btn.hasClass('fa-thumbs-o-down')) {
				action = 'dislike';
			} else if($clicked_btn.hasClass('fa-thumbs-down')){
				action = 'undislike';
			}
			
			$.ajax({
				url: 'category.php',
				type: 'post',
				data: {
					'action': action,
					'post_id': post_id
				},
				success: function(data){
					res = JSON.parse(data);
					if (action == "dislike") {
						$clicked_btn.removeClass('fa-thumbs-o-down');
						$clicked_btn.addClass('fa-thumbs-down');
					} else if(action == "undislike") {
						$clicked_btn.removeClass('fa-thumbs-down');
						$clicked_btn.addClass('fa-thumbs-o-down');
					}

					$clicked_btn.siblings('span.likes').text(res.likes);
					$clicked_btn.siblings('span.dislikes').text(res.dislikes);

					$clicked_btn.siblings('i.fa-thumbs-up').removeClass('fa-thumbs-up').addClass('fa-thumbs-o-up');
				}
			});	

		});



	});
</script>





 <!-- Latest compiled and minified JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="discussion/tags/src/bootstrap-tagsinput.js"></script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


</body>
</html>
