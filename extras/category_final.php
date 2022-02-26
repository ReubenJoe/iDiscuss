<?php include 'utils/nav.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Like and Dislike system</title>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="stylesheet" href="main.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/fontawesome.min.css" integrity="sha384-wESLQ85D6gbsF459vf1CiZ2+rr+CsxRY0RpiF1tLlQpDnAgg6rwdsUF1+Ics2bni" crossorigin="anonymous">

</head>
<body>
  <div class="posts-wrapper">
   <?php foreach ($posts as $post): ?>
    <?php echo '<pre>' . print_r($post, TRUE) . '</pre>';?>
   	<div class="post">
      <?php echo $post['Question title']; ?>
      <div class="post-info">
	    <!-- if user likes post, style button differently -->
		<i <?php if (userLiked($post['S.NO'])): ?>
                                class="fa fa-thumbs-up like-btn"
                            <?php else: ?>
                                class="fa fa-thumbs-o-up like-btn"
                            <?php endif ?>
                            data-id="<?php echo $post['S.NO'] ?>"></i>&nbsp;&nbsp;<span class="likes"><?php echo getLikes($post['S.NO']); ?></span>
      	
      	&nbsp;&nbsp;&nbsp;&nbsp;

	    <!-- if user dislikes post, style button differently -->
      	<i 
      	  <?php if (userDisliked($post['S.NO'])): ?>
      		  class="fa fa-thumbs-down dislike-btn"
      	  <?php else: ?>
      		  class="fa fa-thumbs-o-down dislike-btn"
      	  <?php endif ?>
      	  data-id="<?php echo $post['S.NO'] ?>"></i>
      	<span class="dislikes"><?php echo getDislikes($post['S.NO']); ?></span>
      </div>
   	</div>
   <?php endforeach ?>
  </div>
  <script src="scriptest.js"></script>


</body>
</html>