<?php
  require_once 'C:\xampp\htdocs\iwp\controllers\authController.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style_nav.css">
    <link rel="stylesheet" href="css/style_footer.css">

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
</head>

<style>
#iwp{
    color: #ff2f75;
    text-shadow: 0 0 8px #000;
}


</style>
<nav>
    <div class="wrapper">
        <div class="logo"><img src="images/logo.png" height= "45px" width="45px" style="margin-top: -12px"/><a href="index.php">&nbsp;&nbsp;<span id="iwp">i</span>Discuss</a></div>
        <input type="radio" name="slider" id="menu-btn">
        <input type="radio" name="slider" id="close-btn">
        <ul class="nav-links">
            <label for="close-btn" class="btn close-btn"><i class="fas fa-times"></i></label>
            <li><a href="index.php">Home</a></li>
            <!-- <li><a href="#about">About</a></li> -->
            <li>
                <a href="#about" class="desktop-item">About us</a>
                <input type="checkbox" id="showDrop1">
                <label for="showDrop1" class="mobile-item">About Us</label>
                <ul class="drop-menu">
                    <!-- <li><a href="#about">About Us</a></li> -->
                    <li><a href="#service">Our Services</a></li>
                    <li><a href="#team">Our Team</a></li>
                    <li><a href="#contact">Contact Us</a></li>
                    <li><a href="#faq">FAQ</a></li>
                </ul>
            </li>

            <?php
              $sql = "SELECT category_name, category_id FROM `categories`";
              $result = mysqli_query($conn, $sql); 
            ?>


            <?php
        if (isset($_SESSION['username']) && $_SESSION['username'] == 'admin')
				{
          echo '
          <li>
          <a href="#category" class="desktop-item">Category</a>
          <input type="checkbox" id="showDrop1">
          <label for="showDrop1" class="mobile-item">Category</label>
          <ul class="drop-menu" id="cat">';

                while($rows = $result->fetch_assoc())
                {
                  $cat_name = $rows['category_name'];
                  $cat_id = $rows['category_id'];
                  echo '<li><a value='.$cat_name.' href="category.php?cat_id='.$cat_id.'" >'.$cat_name.'</a></li>';
                }
              echo '
          </ul>
      </li>
          <li>
          <a href="#" class="desktop-item welcome">Hello, '.$_SESSION['username'].'</a>
          <input type="checkbox" id="showDrop2">
          <label for="showDrop2" class="mobile-item welcome">Hello, '.$_SESSION['username'].'</label>
          <ul class="drop-menu">
            <li><a href="admin/home.php">View Profile</a></li>
            <li><a href="user-verification/logout.php" id="logout-btn">Logout</a></li>
          </ul>
        </li>';
				}

        elseif (isset($_SESSION['username'])){
          echo '
          <li>
          <a href="#category" class="desktop-item">Category</a>
          <input type="checkbox" id="showDrop1">
          <label for="showDrop1" class="mobile-item">Category</label>
          <ul class="drop-menu" id="cat">';

                while($rows = $result->fetch_assoc())
                {
                  $cat_name = $rows['category_name'];
                  $cat_id = $rows['category_id'];
                  echo '<li><a value='.$cat_name.' href="category.php?cat_id='.$cat_id.'" >'.$cat_name.'</a></li>';
                }
              echo '
          </ul>
      </li>
          <li>
          <a href="#" class="desktop-item welcome">Hello, '.$_SESSION['username'].'</a>
          <input type="checkbox" id="showDrop2">
          <label for="showDrop2" class="mobile-item welcome">Hello, '.$_SESSION['username'].'</label>
          <ul class="drop-menu">
            <li><a href="user_profile/home.php">View Profile</a></li>
            <li><a href="user/update_profile.php">Update Profile</a></li>
            <li><a href="user-verification/logout.php" id="logout-btn">Logout</a></li>
          </ul>
        </li>';
				}
        

        else{
          echo '            <li>
          <a href="#category" class="desktop-item">Category</a>
          <input type="checkbox" id="showDrop1">
          <label for="showDrop1" class="mobile-item">Category</label>
          <ul class="drop-menu" id="cat">';

                while($rows = $result->fetch_assoc())
                {
                  $cat_name = $rows['category_name'];
                  $cat_id = $rows['category_id'];
                  echo '<li><a value='.$cat_name.' href="user-verification/login.php" >'.$cat_name.'</a></li>';
                }
         echo '     
      </ul>
      </li>
      <li><a href="user-verification/signup.php">Signup</a></li>
      <li><a href="user-verification/login.php">Login</a></li>';
        }
        ?>
</ul>
            <label for="menu-btn" class="btn menu-btn"><i class="fas fa-bars"></i></label>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
</script>
<script src="js/search_category.js"></script>

<script>
window.addEventListener('scroll', function() {
    let nav = document.querySelector('nav');
    let windowPosition = window.scrollY > 10;
    nav.classList.toggle('scrolling-active', windowPosition);
})
</script>