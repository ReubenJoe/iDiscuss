<?php 
	$conn = mysqli_connect('localhost', 'root', '', 'discnet');

if (isset($_SESSION['username']))
{
  $username=$_SESSION['username'];
  $sql= "SELECT `id` FROM `users` WHERE `username` = '$username'";
  $result = mysqli_query($conn, $sql);
  
  $row=mysqli_fetch_assoc($result);
  $user_id = $row['id'];
$user_id=7;
}
	if (!$conn) {
		die("Error connecting to database: " . mysqli_connect_error($conn));
		exit();
	}

	// if user clicks like or dislike button
	if (isset($_POST['action'])) {
		$post_id = $_POST['post_id'];
		$action = $_POST['action'];

		switch ($action) {
			case 'like':
				$sql = "INSERT INTO rating_info (user_id, post_id, rating_action) 
					 		VALUES ($user_id, $post_id, 'like') 
					 		ON DUPLICATE KEY UPDATE rating_action='like'";
				break;
			case 'dislike':
				$sql  = "INSERT INTO rating_info (user_id, post_id, rating_action) 
					 		VALUES ($user_id, $post_id, 'dislike') 
					 		ON DUPLICATE KEY UPDATE rating_action='dislike'";
				break;
			case 'unlike':
				$sql = "DELETE FROM rating_info 
							WHERE user_id=$user_id 
							AND post_id=$post_id";
				break;
			case 'undislike':
				$sql = "DELETE FROM rating_info 
							WHERE user_id=$user_id 
							AND post_id=$post_id";
				break;
			default:
				break;
		}

		// execute query to effect changes in the database ...
		mysqli_query($conn, $sql);
		echo getRating($post_id);
		exit(0);
	}

	$sql = "SELECT * FROM questions";

	$result = mysqli_query($conn, $sql);

	// fetch all posts from database
	// return them as an associative array called $posts
	$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

	function getLikes($id)
	{
		global $conn;

		$sql = "SELECT COUNT(*) 
					FROM rating_info 
					WHERE post_id = $id 
					 AND rating_action='like'";

		$rs = mysqli_query($conn, $sql);
		$result = mysqli_fetch_array($rs);
		return $result[0];
	}


	function getDislikes($id)
	{
		global $conn;

		$sql = "SELECT COUNT(*) 
					FROM rating_info 
					WHERE post_id = $id 
					 AND rating_action='dislike'";

		$rs = mysqli_query($conn, $sql);
		$result = mysqli_fetch_array($rs);
		return $result[0];
	}

	function getRating($id)
	{
		global $conn;
		$rating = array();

		$likes_query = "SELECT COUNT(*) 
					FROM rating_info 
					WHERE post_id = $id 
					 AND rating_action='like'";

		$dislikes_query = "SELECT COUNT(*) 
					FROM rating_info 
					WHERE post_id = $id 
					 AND rating_action='dislike'";

		$likes_rs = mysqli_query($conn, $likes_query);
		$dislikes_rs = mysqli_query($conn, $dislikes_query);

		$likes = mysqli_fetch_array($likes_rs);
		$dislikes = mysqli_fetch_array($dislikes_rs);

		$rating = [
			'likes' => $likes[0],
			'dislikes' => $dislikes[0]
		];

		return json_encode($rating);
	}



	function userLiked($post_id)
	{
		global $conn;
		global $user_id;

			$sql = "SELECT * FROM rating_info 
					WHERE user_id=$user_id AND post_id=$post_id AND rating_action='like'";

		$result = mysqli_query($conn, $sql);


		if (mysqli_num_rows($result) > 0) {
			return true;
		}else{
			return false;
		}
	}

	function userDisliked($post_id)
	{
		global $conn;
		global $user_id;

			$sql = "SELECT * FROM rating_info 
					WHERE user_id=$user_id AND post_id=$post_id AND rating_action='dislike'";

		$result = mysqli_query($conn, $sql);


		if (mysqli_num_rows($result) > 0) {
			return true;
		}else{
			return false;
		}
	}



?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Like and Dislike system</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src = scriptvote.js></script>


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="discussion/tags/src/bootstrap-tagsinput.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/fontawesome.min.css" integrity="sha384-wESLQ85D6gbsF459vf1CiZ2+rr+CsxRY0RpiF1tLlQpDnAgg6rwdsUF1+Ics2bni" crossorigin="anonymous">


	<style>
		.posts-wrapper {
			width: 50%;
			margin: 20px auto;
			border: 1px solid #eee;
		}
		.post {
			width: 90%;
			margin: 20px auto;
			padding: 10px 5px 0px 5px;
			border: 1px solid green;
		}
		.post-info {
			margin: 10px auto 0px;
			padding: 5px;
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
</head>
<body>
	<div class="posts-wrapper">

		<?php foreach ($posts as $post): ?>
				<?php echo $post['Question Description']; ?>

				<div class="post-info">
					<i 
					  <?php if (userLiked($post['S.NO'])): ?>
						  class="fa fa-thumbs-up like-btn"
					  <?php else: ?>
						  class="fa fa-thumbs-o-up like-btn"
					  <?php endif ?>
					  data-id="<?php echo $post['S.NO'] ?>"></i>

					<span class="likes"><?php echo getLikes($post['S.NO']); ?></span>

					&nbsp;&nbsp;&nbsp;&nbsp;
					<i 
					  <?php if (userDisliked($post['S.NO'])): ?>
						  class="fa fa-thumbs-down dislike-btn"
					  <?php else: ?>
						  class="fa fa-thumbs-o-down dislike-btn"
					  <?php endif ?>
					  data-id="<?php echo $post['S.NO'] ?>"></i>

					<span class="dislikes"><?php echo getDislikes($post['S.NO']); ?></span>
				</div>
		<?php endforeach ?>

	</div>
</body>
</html>
<script>


</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="discussion/tags/src/bootstrap-tagsinput.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

