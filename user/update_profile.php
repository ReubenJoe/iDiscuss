<?php
require '../controllers/authController.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">    
    <link rel="stylesheet" href="../css/style_userverify.css">
</head>
<body>
    <section>
        <div class="imgBx">
            <img src="../user-verification/images/bg.jpg"/>
        </div>
        <a href="../index.php"><div class="home-signup-btn"><span><img src="../user-verification/images/home.png"></span></div></a>
        <div class="contentBx">
            <div class="formBx">

                <?php if(count($errors)>0): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php foreach($errors as $error): ?>
                            <li><?php echo $error; ?></li>
                        <?php endforeach; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                <?php endif;?>



                <?php if(isset($alert_disp_error['update_empty_username']) || isset($alert_disp_error['update_not_empty_old_password2']) || isset($alert_disp_error['update_not_empty_new_password1']) || isset($alert_disp_error['update_not_empty_new_password2']) || isset($alert_disp_error['update_not_empty_new_confpassword1']) || isset($alert_disp_error['update_not_empty_new_confpassword2']) || isset($alert_disp_error['update_empty_conf_password1']) || isset($alert_disp_error['update_empty_conf_password2']) || isset($alert_disp_error['update_empty_new_password1']) || isset($alert_disp_error['update_empty_new_password2']) || isset($alert_disp_error['update_empty_old_password1']) || isset($alert_disp_error['update_password_3'])): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php foreach($alert_disp_error as $i): ?>
                            <li><?php echo $i; ?></li>
                        <?php endforeach; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                <?php endif;?>

                <?php if(isset($alert_disp_success['update_not_empty_old_password1']) || isset($alert_disp_success['update_username_only']) || isset($alert_disp_success['update_username_2']) || isset($alert_disp_success['update_password_2'])): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php foreach($alert_disp_success as $i): ?>
                            <li><?php echo $i; ?></li>
                        <?php endforeach; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                <?php endif;?>
                
                <h2>Update Profile</h2>
                <form action="update_profile.php" method="post">
                   <div class="inputBx">
                       <span>Username</span>
                       <input type="text" name="username" value="<?php echo $_SESSION['username']?>">

                   </div> 
                   <div class="inputBx">
                        <span>Old password</span>
                        <input type="password" name="old_password">
                   </div> 
                   <div class="inputBx">
                       <span>New Password</span>
                       <input type="password" name="password">
                   </div> 
                   <div class="inputBx">
                       <span>Confirm New Password</span>
                       <input type="password" name="passwordConf">
                   </div> 
                   <div class="inputBx">
                       <input type="submit" value="Update Profile" name="update-btn">
                   </div>


                    <!-- <div class="inputBx">
                            <p>Already have an account? <a href="index.html">Log in</a></p>
                    </div> -->
                </form>
                <form action="update_profile.php" method="post">
                    <div class="inputBx">
                        <p>Do you want to delete your account? <button name="delete-btn" id="delete-btn"  data-toggle="modal" data-target="#exampleModal">Delete</button></p>
                        
                   </div>
                </form>
                <!-- <h3>Login with social media</h3>
                <ul class="sci">
                    <li><img src="facebook.png"></li>
                    <li><img src="twitter.png"></li>
                    <li><img src="instagram.png"></li>
                </ul> -->
            </div>
        </div>
    </section>

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>