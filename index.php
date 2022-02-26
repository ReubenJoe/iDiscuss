<?php include 'utils/nav.php' ?>
<?php
  // require_once 'C:\xampp\htdocs\iwp\controllers\authController.php';
  $alert_cat=false;
  $alert_contact_mail=false;
?>

<?php


//contact us

if (isset($_POST['Send_admin']))
{
  $fname=$_POST['fname_query'];
  $lname=$_POST['lname_query'];
  $query_mail=$_POST['query_email'];
  $person_query=$_POST['person_query'];
  user_contact($fname, $lname, $query_mail, $person_query);
  $alert_contact_mail=true;
}

//if users clicks on ask question button

if (isset($_SESSION['username']) && isset($_POST['ask-btn']))
{
    $_SESSION['question_title'] = $_POST['question'];
    $ses_temp = $_POST['categories'];
    $sql = "SELECT * FROM `categories` WHERE category_name = '$ses_temp'";
    $result = mysqli_query($conn, $sql); 
    // echo '<pre>' . print_r($ses_temp, TRUE) . '</pre>';
    $cat_default="categories";
    $ses_temp=trim($ses_temp, " ");
    if ($ses_temp != $cat_default)
    {
        while($rows = mysqli_fetch_assoc($result))
        {
            $cat_id = $rows['category_id'];
            header("location: http://localhost/iwp/category.php?cat_id=$cat_id");
        }
    }

    else{
        $alert_cat=true;
    }

    
}

elseif (!isset($_SESSION['username']) && isset($_POST['ask-btn']))
{
    header('location: http://localhost/iwp/user-verification/login.php');
    exit();
}

?>





<?php if (isset($_GET['alert_disp'])): ?>
<?php echo '<script>alert("Your profile has been successfully deleted");</script>';?>
<?php
     echo '<meta http-equiv="Refresh" content="0;url=http://localhost/iwp/index.php">'; ?>
<?php endif; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>iDiscuss</title>
    <link rel="stylesheet" href="css/search.css">
<link rel="stylesheet" href="css/home_style.css">
    <!-- Toastr -->
    <!-- <link rel="stylesheet" href="utils/plugins/toastr/toastr.min.css"> -->

    	<!-- Toastr -->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

  <style>
.toast {
    opacity: 1 !important;
}
  </style>

</head>


<body>

  <!-- Home Section Starts -->
  <section class="home" id="home">
    <h1 class="banner">
    Student Discussion Hub
    </h1>
    <h3 class="slogan">Productive Discussion is an exchange of knowledge and ideas</h3>
    <!-- <a href="#"><button>Explore</button></a> -->
    <form method="post">
    <?php
                    $sql = "SELECT category_name, category_id FROM `categories`";
                    $result = mysqli_query($conn, $sql); 
                  ?>
    <div class="form-group">
        <div class="search-dropdown">
            <div class="default-option text-truncate" disabled>Category</div>
            <input type="hidden" name="categories" value="categories" id="name_cat" />
            <div class="search-dropdown-list">
                <ul>
                    <?php
                      while($rows = $result->fetch_assoc())
                      {
                        $cat_name = $rows['category_name'];
                        echo "<li value='$cat_name' name='$cat_name'>$cat_name</li>";
                      }
                    ?>
                </ul>
            </div>
        </div>
        <div class="search">
            <input type="text" id="searchText" name="question" class="search-input" placeholder="Ask Anything....">
        </div>
        <button type="submit" name="ask-btn" class="search-button"><i class="fas fa-search"></i></button>
    </div>

</form>

    <div class="wave wave1"></div>
    <div class="wave wave2"></div>
    <div class="wave wave3"></div>

    <div class="fas fa-cog nut1"></div>
    <div class="fas fa-cog nut2"></div>
  </section>
<!-- Home Section Ends -->


<?php $sql="SELECT * FROM `categories`";
$result=mysqli_query($conn, $sql); 
?>
<!-- Categories Section starts -->

<section class="category" id="category">
<h1 class="section_heading">Category</h1>
<div class="card_container">
<?php
$num = mysqli_num_rows($result);
$no=1;
if (isset($_SESSION['username']))
{
  while(($rows = $result->fetch_assoc()) && ($no<=$num))
  {
    $cat_id=$rows['category_id'];
    echo '
      <div class="card_box">
          <div class="card_icon">'.$no.'</div>
          <div class="card_content">
              <h3>'.$rows['category_name'].'</h3>
              <p>'.$rows['category_desc'].'</p>
              <a href="category.php?cat_id='.$cat_id.'">explore</a>
          </div>
      </div>
  ';
  $no++;
  }
}
else
{
  while(($rows = $result->fetch_assoc()) && ($no<=$num))
  {
    $cat_id=$rows['category_id'];
    echo '
      <div class="card_box">
          <div class="card_icon">'.$no.'</div>
          <div class="card_content">
              <h3>'.$rows['category_name'].'</h3>
              <p>'.$rows['category_desc'].'</p>
              <a href="user-verification/login.php">explore</a>
          </div>
      </div>
  ';
  $no++;
  }
}

?>
</div>

</section>
<!-- Categories Section ends -->

<!-- About section starts -->
<section id="about" class="about">
  <h1 class="section_heading">About Us</h1>
<div class="section_row">
  <div class="section_content">
    <h3>We enable people to ask and answer to queries</h3>
    <p>Discussion Forum is a specialized platform that aims to provide a medium through which the users can post their queries or doubts and get them answered by their fellow peers along with the admin monitoring the user activity</p>
    <a href="#"><button class="section_button">Read More</button></a>
  </div>
  <div class="image">
    <img src="images/about-image.svg">
  </div>
</div>
</section>

<!-- About section ends -->
<!-- Service section starts -->
<section class="service" id="service">
  <h1 class="section_heading">Our Services</h1>
  <div class="section_row">
    <div class="image">
      <img src="images/service img1.svg">
    </div>
    <div class="section_content">
      <h3>Website Development</h3>
      <p>Our discussion forum is well built and complies to the standards of a modern-day discussion forum where users can ask, post, delete, like and dislike to the posts and comments. The website allows the admin to keep a close watch on the activity of the users.</p>
      <a href="#"><button class="section_button">Read More</button></a>
    </div>
  </div>
  <div class="section_row">
    <div class="section_content">
      <h3>Mobile Friendly</h3>
      <p>Our Forum website is completely accessible in mobiles. Even when the screen size shrinks down, the features of our website remain intact to provide the users with an enriching experience</p>
      <a href="#"><button class="section_button">Read More</button></a>
    </div>
    <div class="image">
      <img src="images/service img2.svg">
    </div>
  </div>
  <div class="section_row">
    <div class="image">
      <img src="images/service img3.svg">
    </div>
    <div class="section_content">
      <h3>Responsive Design</h3>
      <p>The web development approach emploed to build the discussion forum was to create dynamic pages that would change the appearance of a website depending on the screen size and orientation of the device being used to view it</p>
      <a href="#"><button class="section_button">Read More</button></a>
    </div>
  </div>
  <div class="section_row">
    <div class="section_content">
      <h3>Profanity Restriction</h3>
      <p>Our Discussion Forum is built by keeping the detection and hiding of obscene language. Users are not allowed to enter any language that violates the terms and conditions of our forum and hides the required phrases.</p>
      <a href="#"><button class="section_button">Read More</button></a>
    </div>
    <div class="image">
      <img src="images/service img4.svg">
    </div>
  </div>
  <!-- <div class="section_row">
    <div class="image">
      <img src="images/service img5.svg">
    </div>
    <div class="section_content">
      <h3>Profanity Restriction</h3>
      <p>Our Discussion Forum is built by keeping the detection and hiding of obscene language. Users are not allowed to enter any language that violates the terms and conditions of our forum and hides the required phrases.</p>
      <a href="#"><button class="section_button">Read More</button></a>
    </div>
  </div>
  <div class="section_row">
    <div class="section_content">
      <h3>Graphic Design</h3>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam voluptate animi sunt unde blanditiis, hic consectetur praesentium labore qui fuga incidunt ea aspernatur ipsam, suscipit, inventore molestiae deleniti alias. Sunt?</p>
      <a href="#"><button class="section_button">Read More</button></a>
    </div>
    <div class="image">
      <img src="images/service img6.svg">
    </div>
  </div> -->
</section>
<!-- Service section ends -->
<!-- Team section starts -->
<section class="team" id="team">
  <h1 class="section_heading">Our Team</h1>
  <div class="section_row">
    <div class="profile_card">
      <div class="image">
        <img src="images/user.jpg" alt="">
      </div>
      <div class="info">
        <h3>Anshuman Mohanty</h3>
        <span>Team Lead</span>
        <div class="icons">
          <a href="#" class="fab fa-facebook-f"></a>
          <a href="#" class="fab fa-twitter"></a>
          <a href="#" class="fab fa-instagram"></a>
        </div>
      </div>
    </div>
    <div class="profile_card">
      <div class="image">
        <img src="images/user.jpg" alt="">
      </div>
      <div class="info">
        <h3>Reuben Joseph</h3>
        <span>Creative Head</span>
        <div class="icons">
          <a href="#" class="fab fa-facebook-f"></a>
          <a href="#" class="fab fa-twitter"></a>
          <a href="#" class="fab fa-instagram"></a>
        </div>
      </div>
    </div>
    <div class="profile_card">
      <div class="image">
        <img src="images/user.jpg" alt="">
      </div>
      <div class="info">
        <h3>Soumyae Tyagi</h3>
        <span>Managing partner</span>
        <div class="icons">
          <a href="#" class="fab fa-facebook-f"></a>
          <a href="#" class="fab fa-twitter"></a>
          <a href="#" class="fab fa-instagram"></a>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Team section ends -->
<!-- Contact section starts -->
<section class="contact" id="contact">
  <h1 class="section_heading">Contact Us</h1>
  <div class="section_row">
    <div class="image">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3890.040785878598!2d80.15123961464377!3d12.8406409909419!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a5259af8e491f67%3A0x944b42131b757d2d!2sVellore%20Institute%20of%20Technology%20-%20VIT%20Chennai!5e0!3m2!1sen!2ssg!4v1620716324905!5m2!1sen!2ssg" width="auto" height="auto" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
    <div class="form-container">
      <form action="#" method="POST">
        <div class="inputBox">
          <input type="text" name="fname_query" id="fname_query" placeholder="First name">
          <input type="text" name="lname_query" id="lname_query" placeholder="Last name">
        </div>
        <input type="email" name="query_email" id="query_email" placeholder="email">
        <textarea name="person_query" id="person_query" cols="30" rows="10" placeholder="message"></textarea>
        <input type="submit" value="Send" name="Send_admin">
      </form>
    </div>
  </div>
</section>
<!-- contact section ends -->
<!-- faq section starts -->
<section class="faq" id="faq">
  <h1 class="section_heading">FAQ</h1>
  <div class="section_row"> 
  <div class="image">
    <img src="images/faq-image.svg" alt="">
  </div> 
    <div class="accordion-container">
      <div class="accordion">
        <div class="accordion-header">
          <span>+</span>
          <h3>How do i access the discussion threads?</h3>
        </div>
        <div class="accordion-body">
          <p>The users need to signup and enter their domain mail IDs followed by email verification and create an account. After that, the users can access the category threads provided by the admin</p>
        </div>
      </div>
      <div class="accordion">
        <div class="accordion-header">
          <span>+</span>
          <h3>How do i update my username or password?</h3>
        </div>
        <div class="accordion-body">
          <p>The users can click on the update profile option from the dropdown in the navigation bar or they could select the settings option from the sidebar of view profile section where they can find the option of updating their username and password</p>
        </div>
      </div>
      <div class="accordion">
        <div class="accordion-header">
          <span>+</span>
          <h3>How do i verify my email ID?</h3>
        </div>
        <div class="accordion-body">
          <p>On signing up with you domain email ID, an email verification link will be sent to the user's mail ID. On clicking the link in mail, the user is redirected to confirmation link from where he/she can proceed to the website</p>
        </div>
      </div>
      <div class="accordion">
        <div class="accordion-header">
          <span>+</span>
          <h3>How to retrieve my password after forgetting?</h3>
        </div>
        <div class="accordion-body">
          <p>On the login page, the users can view an option of forgot password where they could follow the same procedure of email verification and on clicking the verification link, the users can enter and confirm their new password</p>
        </div>
      </div>
      <div class="accordion">
        <div class="accordion-header">
          <span>+</span>
          <h3>How do i post a question or comment?</h3>
        </div>
        <div class="accordion-body">
          <p>The users can post their question title in the search bar or they could access the respective categories and post the same. For posting comments, the users can select on the question title where they could post their comments or reply to some other comment thread</p>
        </div>
      </div>
    </div>
</div>
</section>
<!-- faq section ends -->

<?php include 'utils/footer.php' ?>

<!--toastr js-->
<!-- <script src="utils/plugins/toastr/toastr.min.js"></script> -->
<script>
    $(document).ready(function(){
      $('.accordion-header').click(function(){
        $('.accordion .accordion-body').slideUp();
        $(this).next('.accordion-body').slideDown();
        $('.accordion .accordion-header span').text('+');
        $(this).children('span').text('-');
      });
    });
  </script>
  
<script>
<?php if ($alert_cat): ?>
  toastr.warning('Please select a category');
<?php endif ?>
</script> 
<script>
<?php if ($alert_contact_mail): ?>
  toastr.success('Your message has been sent successfully');
<?php endif ?>
</script>

<script type="text/javascript">
	// Default Configuration
		$(document).ready(function() {
			toastr.options = {
				'closeButton': true,
				'debug': false,
				'newestOnTop': false,
				'progressBar': false,
				'positionClass': 'toast-top-right',
				'preventDuplicates': false,
				'showDuration': '1000',
				'hideDuration': '1000',
				'timeOut': '5000',
				'extendedTimeOut': '1000',
				'showEasing': 'swing',
				'hideEasing': 'linear',
				'showMethod': 'fadeIn',
				'hideMethod': 'fadeOut',
			}
		});

</script>

</body>

</html>