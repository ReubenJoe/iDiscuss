$output.='<div class="card mb-4 shadow border-secondary">
<div class="card-header py-1 text-light rounder"
    style="background: linear-gradient(225deg, #e91e63, #03a9f4);">
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
        <i class="far fa-thumbs-up"></i>
        <i '.((userLiked($row["comment_id"])))?'class="fa fa-thumbs-up like-btn"':'class="fa fa-thumbs-o-up like-btn"' .'data-id="'.$row["comment_id"].'"></i>&nbsp;&nbsp;
        <span class="likes">'.getLikes($row["comment_id"]).'</span>

        
        <i '.((userDisliked($row["comment_id"])))?'class="fa fa-thumbs-down dislike-btn"':'class="fa fa-thumbs-o-down dislike-btn"'. 'data-id="'.$row["comment_id"].'"></i>
        <span class="dislikes">'.getDislikes($row["comment_id"]).'</span>
    </div>
</div>
</div>';






































<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-11 rounder mt-4">
            <h2 class="posthead">Browse Comments</h2>
            <?php foreach ($answering as $answer): 
                  $noResult=false;
                    ?>
            <?php 
                    $use_id=$answer["user_id"];
                        $sql= "SELECT `username` FROM `users` WHERE `id` = '$use_id'";
                        $result = mysqli_query($conn, $sql);
                        while($row=mysqli_fetch_assoc($result)){
                            $name=$row['username'];                            
                           }
                    ?>
            <div class="card mb-4 shadow border-secondary">
                <div class="card-header py-1 text-light rounder"
                    style="background: linear-gradient(225deg, #e91e63, #03a9f4);">
                    <span class="font-italic text-dark">Posted By: <span
                            class="fw-bold"><?php echo($name)?></span></span>
                    <span class="float-end font-italic text-light fw-bold"><?php echo($answer['comment_time'])?></span>
                </div>
                <div class="card-body py-2">
                    <p class="card-text">
                        <a href="#" class="text-dark fw-normal"
                            id="question"><?php echo($answer['answer'])?></a>
                    </p>
                </div>
                <div class="card-footer py-2 bg-light bg-gradient">
                    <div class="float-end">
                        <i <?php if (userLiked($answer['answer_id'])): ?> class="fa fa-thumbs-up like-btn"
                            <?php else: ?> class="fa fa-thumbs-o-up like-btn" <?php endif ?>
                            data-id="<?php echo $answer['answer_id'] ?>"></i>&nbsp;&nbsp;<span
                            class="likes"><?php echo getLikes($answer['answer_id']); ?></span>

                        &nbsp;&nbsp;&nbsp;

                        <i <?php if (userDisliked($answer['answer_id'])): ?> class="fa fa-thumbs-down dislike-btn"
                            <?php else: ?> class="fa fa-thumbs-o-down dislike-btn" <?php endif ?>
                            data-id="<?php echo $answer['answer_id'] ?>"></i>
                        <span class="dislikes"><?php echo getDislikes($answer['answer_id']); ?></span>
                    </div>
                </div>
            </div>
            <?php endforeach?>
        </div>
    </div>
</div> 