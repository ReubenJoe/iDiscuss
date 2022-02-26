<?php include 'controllers/authController.php'; 

//include 'delete_question.php';

?>
<link rel="stylesheet" href="discussion/tags/src/bootstrap-tagsinput.css">
<link rel="stylesheet" href="css/style_nav_pages.css">
<script src="discussion/tags/src/bootstrap-tagsinput.js"></script>
<script src="js/scriptvote.js"></script>


<style>
.search-box {
    position: relative;
    height: 50px;
    width: 40%;
    margin-bottom: 2rem;
}

.search-box input {
    height: 100%;
    width: 100%;
    border: none;
    outline: none;
    background-color: white;
    color: #000;
    font-weight: 100;
    font-size: 16px;
    border-radius: 50px;
    padding: 0 60px 0 20px;
    box-shadow: 0px 2px 4px rgba(12, 18, 18, 0.4);
}

.search-box input:placeholder-shown {
    font-weight: 100;
}

.search-box .search-btn {
    position: absolute;
    transform: translate(-15%, 12%);
    right: 0;
    top: 0;
    height: 2.5rem;
    width: 2.5rem;
    color: #fff;
    background: rgba(0, 0, 0, 0.774);
    line-height: 2.5rem;
    font-size: 1rem;
    text-align: center;
    border-radius: 50px;
    cursor: pointer;
}

.search-box .search-btn:hover {
    background: #e91e63;
    color: white;
}

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
<?php
if(isset($_POST["query"]))
{
    $cname = $_POST['cname'];
	$search = mysqli_real_escape_string($conn, $_POST["query"]);
	$query = "SELECT * FROM `questions` WHERE  `category`='$cname' AND (`Tags` LIKE '%".$search."%' OR `Question title` LIKE '%".$search."%' OR `Asked By` LIKE '%".$search."%')";
    
}

elseif(isset($_POST["query_filter"]))
{
    $cname = $_POST['cname'];
    $search_text=$_POST["query_filter"];
    // echo '<pre>' . print_r($cname, TRUE) . '</pre>';
    $query="SELECT * FROM `questions` WHERE `category`='$cname' AND `Tags` REGEXP '[[:<:]](".$search_text.")[[:>:]]'";
    // echo '<pre>' . print_r($query, TRUE) . '</pre>';
}

else         
{
  $cname = $_POST['cname'];
  $query = "SELECT * FROM `questions` WHERE  `category`='$cname'";
}

?>


<?php
$result = mysqli_query($conn, $query);
?>
<?php if(mysqli_num_rows($result) > 0): ?>
<?php while($row = mysqli_fetch_array($result)): ?>

<?php $tags=$row['Tags'];
                    $str_arr = explode (",", $tags);?>
<div class="card mb-4 shadow border-secondary">
    <div class="card-header py-1 text-light rounder" style="background: linear-gradient(to right, #ff4584, purple);">
        <span class="font-italic text-dark">Posted By: 
        <span class="fw-bold"><?php echo($row['Asked By'])?></span></span>
        <span class="float-end font-italic text-light fw-bold"><?php echo($row['DATETIME'])?></span>
    </div>
    <div class="card-body py-2">
        <p class="card-text">
            <a href="http://localhost/iwp/answers.php?post_id=<?php echo $row['S.NO']?>" class="text-dark"
                id="question"><?php echo($row['Question title'])?></a>
                <a id="<?php echo $row['Question Description']?>" value="<?php echo $row['Question Description']?>"></a>
        </p>
    </div>
    <div class="card-footer py-2 bg-gradient">
    <?php if(isset($str_arr)):?>
        <?php foreach($str_arr as $value):?>
        <div class="float-start ms-1">
            <a href="#" class="text-decoration-none border border-primary rounded p-1 badge bg-primary bg-gradient">
                <?php echo $value?>
            </a>
        </div>
        <?php endforeach?>
    <?php endif ?>
        <div class="float-end">
            <a class="text-dark ms-2 edit" id="<?php echo $row['S.NO']?>" value="<?php echo $row['S.NO']?>" title="Edit"><?php $row['S.NO']?><i class="fa fa-pencil-square-o">&nbsp;&nbsp;&nbsp;</i></a>
            
            <a id=<?php echo $row['S.NO']?> onclick="del(<?php echo $row['S.NO']?>)" class="text-dark delete"
                title="Delete"><i class="fa fa-trash">&nbsp;</i></a>

            
            <i <?php if (userLiked($row['S.NO'])): ?> class="fa fa-thumbs-up like-btn ms-2" <?php else: ?>
                class="fa fa-thumbs-o-up like-btn ms-2" <?php endif ?>
                data-id="<?php echo $row['S.NO'] ?>"></i>&nbsp;&nbsp;<span
                class="likes"><?php echo getLikes($row['S.NO']); ?></span>

            <i <?php if (userDisliked($row['S.NO'])): ?> class="fa fa-thumbs-down dislike-btn ms-2" <?php else: ?>
                class="fa fa-thumbs-o-down dislike-btn ms-2" <?php endif ?> data-id="<?php echo $row['S.NO'] ?>"></i>
            <span class="dislikes"><?php echo getDislikes($row['S.NO']); ?></span>
        </div>
    </div>
</div>

<?php endwhile ?>

<?php else: ?>

<!-- <div class="container my-4 col-lg-12">
    <div class="bg-secondary bg-gradient p-5 rounded m-3">
        <h1 class="display-4 text-light">No Threads Found!</h1>
        <hr class="my-4 text-light" style="height: 2px; background-color:#ffffff ;">
        <p class="lead text-light">Search Another Tag or Ask a new question! </p>
    </div>
</div> -->

<?php endif ?>

<script>
function del(post_id) {
    x = confirm("Are you sure that you want to delete this?");

    if (x == true) {
        window.location.href = 'delete_question.php?del_id=' + post_id;
        return true;
    }

}
</script>


  <!-- Edit Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit this Question</h5>
          <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> -->
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <span aria-hidden="true"></span>
          </button>
        </div>
        <form action="<?php $_SERVER['REQUEST_URI']?>" method="POST">
          <div class="modal-body">
            <input type="hidden" name="snoEdit" id="snoEdit">
            <div class="form-group">
              <label for="title">Question</label>
              <input type="text" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp">
            </div>

            <div class="form-group">
              <label for="desc">Question Description</label>
              <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="3"></textarea>
            </div> 
            <div class="form-group">
              <label for="tags">Tags</label>
              <input type="text" name="que_tags" id="que_tags" data-role="tagsinput">
            </div> 
          </div>
          <div class="modal-footer d-block mr-auto">
            <button type="button" class="btn btn-secondary" style="background-color:rgb(61, 61, 61); border-color:rgb(61, 61, 61);" data-dismiss="modal">Close</button>

            <button type="submit" name="edit_submit_question" style="background-color: #ff4583; border-color: #ff4583;" class="btn btn-primary">Save changes</button>
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
        // console.log("edit ",e.target.parentNode.parentNode.parentNode.parentNode);
        tr = e.target.parentNode.parentNode.parentNode.parentNode;
        title = tr.getElementsByTagName("a")[0].innerText;
        description = tr.getElementsByTagName("a")[1].id;

        tr_new=e.target.parentNode.parentNode.parentNode;
        
        tags=tr.getElementsByClassName("badge");
        var str='';
        // console.log(tags);
        for (tag in tags)
        {
          str=str+tags[tag].innerText+",";
        }
        var n=str.length;
        que_tags.value=str.slice(-n,-31);

        // que_tags.value = str;
        titleEdit.value = title;
        descriptionEdit.value = description;
        snoEdit.value = e.target.parentNode.id;
        
        $('#editModal').modal('toggle');
      })
    })
})
</script>
<script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</script>