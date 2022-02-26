<?php include 'utils/nav.php' ?> 
<script src="js/scriptvote.js"></script>
<?php
if($_POST["query_filter"] != '')
{
    $cname = $_POST['cname'];
	$search_array = explode(",", $_POST["query_filter"]);
	$search_text = "'" . implode("', '", $search_array) . "'";
	$query = "SELECT * FROM `questions` WHERE `Tags` REGEXP ".$search_text." AND `category`='$cname'";
}
else
{
    $cname = $_POST['cname'];
    echo '<pre>' . print_r($cname, TRUE) . '</pre>';
	"SELECT * FROM `questions` WHERE `category`='$cname' ORDER BY `S.NO`";
}

$result = mysqli_query($conn, $query);


?>

<?php if(mysqli_num_rows($result) > 0): ?>
	<?php while($row = mysqli_fetch_array($result)): ?>
	
        <?php $tags=$row['Tags'];
                    $str_arr = explode (",", $tags);?>
        <div class="card mb-4 shadow border-secondary">
                <div class="card-header py-1 text-light rounder"
                    style="background: linear-gradient(225deg, #e91e63, #03a9f4);">
                    <span class="font-italic text-dark">Posted By: <span
                            class="fw-bold"><?php echo($row['Asked By'])?></span></span>
                    <span class="float-end font-italic text-light fw-bold"><?php echo($row['DATETIME'])?></span>
                </div>
                <div class="card-body py-2">
                    <p class="card-text">
                        <a href="http://localhost/iwp/answers.php?post_id=<?php echo $row['S.NO']?>" class="text-dark"
                            id="question"><?php echo($row['Question title'])?></a>
                    </p>
                </div>
                <div class="card-footer py-2 bg-gradient">
                    <?php foreach($str_arr as $value):?>
                    <div class="float-start ms-1">
                        <a href="#"
                            class="text-decoration-none border border-primary rounded p-1 badge bg-primary bg-gradient">
                            <?php echo $value?>
                        </a>
                    </div>
                    <?php endforeach?>
                    <div class="float-end">
                        <i <?php if (userLiked($row['S.NO'])): ?> class="fa fa-thumbs-up like-btn" <?php else: ?>
                            class="fa fa-thumbs-o-up like-btn" <?php endif ?>
                            data-id="<?php echo $row['S.NO'] ?>"></i>&nbsp;&nbsp;<span
                            class="likes"><?php echo getLikes($row['S.NO']); ?></span>

                        &nbsp;&nbsp;&nbsp;

                        <i <?php if (userDisliked($row['S.NO'])): ?> class="fa fa-thumbs-down dislike-btn"
                            <?php else: ?> class="fa fa-thumbs-o-down dislike-btn" <?php endif ?>
                            data-id="<?php echo $row['S.NO'] ?>"></i>
                        <span class="dislikes"><?php echo getDislikes($row['S.NO']); ?></span>
                    </div>
                </div>
            </div>
	
    <?php endwhile ?>

<?php else: ?>

	<div class="container my-4 col-lg-12">
    <div class="bg-secondary bg-gradient p-5 rounded m-3">
        <h1 class="display-4 text-light">No Threads Found!</h1>
        <hr class="my-4 text-light" style="height: 2px; background-color:#ffffff ;">
        <p class="lead text-light">Search Another Tag or Ask a new question! </p>
    </div>
</div>

<?php endif ?>