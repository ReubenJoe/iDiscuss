<?php include 'utils/nav.php'; 

//include 'delete_question.php';

?>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<link rel="stylesheet" href="discussion/tags/src/bootstrap-tagsinput.css">
<link rel="stylesheet" href="css/style_userverify.css">
<link rel="stylesheet" href="css/style_nav_pages.css">

<script src="js/scriptvote.js"></script>
<script src="js/searchfilter.js"></script>
<br><br><br>

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

a:hover {
    color: white;
}

#question {
    text-decoration: none;
}

#question:hover {
    text-decoration: underline;
}

section .contentBx {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 100%;
}

section .contentBx .formBx {
    width: 76%;
}

textarea {
    width: 100%;
    padding: 10px 20px;
    outline: none;
    font-weight: 400;
    border: 1px solid #607d8b;
    font-size: 16px;
    letter-spacing: 1px;
    color: #607d8b;
    background: transparent;
    border-radius: 30px;
    margin-bottom: 5px;
    resize: none;
}

h2 {
    color: #607d8b;
    font-weight: 600;
    font-size: 1.5em;
    text-transform: uppercase;
    margin-bottom: 20px;
    border-bottom: 4px solid #ff4584;
    display: inline-block;
    letter-spacing: 1px;
}

::-webkit-scrollbar {
    width: 7px;
    height: 10px;
}

::-webkit-scrollbar-track {
    background: transparent;
    border-radius: 10px;
}

::-webkit-scrollbar-thumb {
    background: rgba(255, 69, 131, 0.7);
    border-radius: 10px;
}

::-webkit-scrollbar-button {
    width: 10px;
    height: 20px;
}

#readMore:hover {
    color: #fff;
    background-color: transparent;
    border-color: #fff;
}

#tags {
    margin-bottom: 20px;
}

#iptag {
    color: #607d8b;
}

.justify-content-between {
    justify-content: space-between !important;
    margin-top: -3%;
}

.headbrowse {
    margin-bottom: 3rem;
}

ol,
ul {
    padding-left: 0rem;
}


/* ------------------ filter -------------------- */
select {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    width: 305px;
    padding: 5px 20px;
    font-family: "Poppins", sans-serif;
    font-weight: 600;
    font-size: 20px;
    letter-spacing: 0.5px;
    cursor: pointer;
    background-color: rgb(61, 61, 61);
    color: #ffffff;
    border: 6px solid rgb(61, 61, 61);
    border-radius: 50px;
    background-image: url("images/arrow-down-1.png");
    background-repeat: no-repeat;
    background-size: 37px;
    background-position: 255px 0.55px;
    outline: none;
    box-shadow: 0 0 20px rgba(20, 20, 30, 0.25);
    filter: grayscale(100%);
    /* margin: 10rem; */
}

select:hover {
    border: 6px solid #ff66a3;
}

select option {
    background-color: rgb(61, 61, 61);
    letter-spacing: 1.2px;
    font-weight: 400;
    font-size: 18px;
    filter: grayscale(100%);
}

.selected {
    display: none;
}
</style>

<?php

if ($show_Alert==TRUE)
{
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Your Question has been added successfully!</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    
}

?>

<?php if ($show_Alert_que==TRUE):?>

<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Your question is updated successfully!</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

<?php endif ?>

<?php if ($show_Alert_wrong_edit_que==TRUE):?>

<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Your are not allowed to update this question!</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

<?php endif ?>

<?php //$alert_del_q=$_SESSION['alert_del_que'];
// echo '<pre>' . print_r($_SESSION['alert_del_que'], TRUE) . '</pre>';
?>

<?php //if ($alert_del_q==TRUE):?>

<!-- <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Question deleted successfully!</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div> -->
<?php //$_SESSION['alert_del_que']=false; ?>
<?php //endif ?>

<?php 
    $id=$_GET['cat_id'];
    $sql = "SELECT `category_desc` FROM `categories` WHERE `category_id` = '$id'";
    $result = mysqli_query($conn, $sql);   
    
    while($rows = $result->fetch_assoc())
    {
        $catdesc = $rows['category_desc'];
    }
    $noResult=true;
    $sql = "SELECT `category_name` FROM `categories` WHERE `category_id` = '$id'";
    $result = mysqli_query($conn, $sql);   
    
    while($rows = $result->fetch_assoc())
    {
        $catname = $rows['category_name'];
    }

?>
<p id="catname" hidden><?php echo $catname; ?></p>

<div class="container my-4 col-lg-10">
    <div class="bg-dark p-5 rounded m-3">
        <h1 class="display-4 text-light">Welcome to <?php echo $catname ?> forums</h1>
        <p class="lead text-light"><?php echo $catdesc; ?></p>
        <hr class="my-4 text-light" style="height: 2px; background-color:#ffffff ;">
        <p class="text-light" style="text-align: justify">
        1. This discussion forum is for educational purposes. Shared knowledge helps us all to
        learn more. Please respect that this forum is for educational purposes only.</p>
        <p class="text-light" style="text-align: justify">
        2. Please hold to a single topic for each thread. Be sure to list your topic in the message
        header/subject box before sending. This will aid the reader(s) in identifying the topic.</p>
        <p class="text-light" style="text-align: justify">
        3. In responding the discussion questions posted, please answer the question completely.</p>
        <p class="text-light" style="text-align: justify">
        4. You can suggest ideas, but remember we should base our opinions with evidence,
        research, and scholarly writings. You are expected to support your comments with the
        literature. You are encouraged to post internet links, articles in your postings to aid in
        understanding however you must also include reference to scholarly literature.<p>
        <p class="text-light" style="text-align: justify">
        5. Original postings and replies should be relevant and contain substance. Please refrain
        from 'I agree' or 'yes' replies; this will aid in respecting your classmates time spent in the
        discussion board. </p>
        
        
        <button type="button" class="btn btn-light" id="readMore">Read More</button>
    </div>
</div>
<?php 

if (isset($_SESSION['question_title']))
{
    $qtitle=$_SESSION['question_title'];
}

else{
    $qtitle='';
}
?>

<section>
    <div class="contentBx">
        <div class="formBx">
            <h2>Start a Discussion</h2>
            <form action="<?php $_SERVER['REQUEST_URI']?>" method="post" id="question_form">
                <div class="inputBx">
                    <span>Question</span>
                    <input type="text" name="enter_question" id="enter_question" value="<?php echo $qtitle;?>" />
                </div>
                <div class="inputBx">
                    <span>Question Description</span>
                    <textarea name="que_desc" rows="5" required></textarea>
                </div>

                <div id="tags">
                    <span id="iptag">Tags</span><br>
                    <input type="text" name="que_tags" data-role="tagsinput" required>
                </div>
                <div class="inputBx">
                    <span>Category</span>
                    <input type="text" name="category" value="<?php echo $catname?>" readonly>
                </div>

                <div class="inputBx">
                    <input type="submit" value="Ask Question" name="q-btn">
                </div>

        </div>
    </div>
</section>

<?php
      
    $id=$_GET['cat_id'];
  
    $category= "SELECT `category_name` FROM `categories` WHERE `category_id` = $id";
    $result = mysqli_query($conn, $category);   
 
    while($rows = $result->fetch_assoc())
    {
      $catname = $rows['category_name'];
    }

    //   $sql="SELECT * FROM `questions` WHERE `Category`='$catname'";

    //   $result=mysqli_query($conn, $sql);
    //   $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

                                             
      
    ?>

<!-- <div class="container">
        <div class="search-box">
            <span class="input-group-addon">Search</span>
            <input type="text" name="search_text" id="search_text" placeholder="Search by Tags" class="form-control" />
        </div>



    <br />
</div> -->
<?php 
$sql = "SELECT `tags` FROM `questions` WHERE `category`='$catname'";
$result = mysqli_query($conn, $sql);

?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-11 rounder mt-4">
            <h2 class="headbrowse">Browse Questions</h2>
            <div class="d-flex justify-content-between mb-1">
                <div class="search-box">
                    <input type="text" name="text_search" id="text_search" placeholder="type to search...">
                    <span class="search-btn">
                        <i class="fas fa-search"></i>
                    </span>
                </div>
                <div style="margin-top:0.2rem">
                    <select name="multi_search_filter" id="multi_search_filter">
                        <option selected class="selected">Filter</option>
                        <?php while($row = mysqli_fetch_array($result)): ?>
                        <?php $tags=$row['tags']; 
                            $str_arr = explode (",", $tags);?>
                        <?php foreach($str_arr as $value):?>
                        <option value="<?php echo $value;?>"><?php echo $value;?></option>
                        <?php endforeach ?>
                        <?php endwhile ?>
                    </select>
                    <input type="hidden" name="hidden_country" id="hidden_country" />
                </div>
            </div>
            <div id="result"></div>
        </div>
    </div>
</div>


<?php
$sql = "SELECT * FROM `questions` WHERE `Category`='$catname'";
$result = mysqli_query($conn, $sql);
$numExistRows = mysqli_num_rows($result);
if ($numExistRows > 0) {
    $noResult=false;
} 

?>

<?php if ($noResult): ?>
<div class="container my-4 col-lg-10">
    <div class="bg-secondary bg-gradient p-5 rounded m-3">
        <h1 class="display-4 text-light">No Threads Found!</h1>
        <hr class="my-4 text-light" style="height: 2px; background-color:#ffffff ;">
        <p class="lead text-light">Be the first person to ask a question.</p>
    </div>
</div>
<?php endif ?>
<?php

unset($_SESSION['question_title']);
?>
<?php include 'utils/footer.php' ?>


<!-- Option 1: Bootstrap Bundle with Popper -->
<!--for alert-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
</script>


<!--tags js-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="js/main.js"></script>
<script src="discussion/tags/src/bootstrap-tagsinput.js"></script>