<?php
    require_once '../controllers/authController.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style_userverify.css">
</head>
<body>
    <section>
        <div class="imgBx">
            <img src="images/bg.jpg"/>
        </div>
        <a href="../index.php"><div class="home-recover-btn"><span><img src="images/home.png"></span></div></a>
        <div class="contentBx">
            <div class="formBx">
            <!--
                <div class="alert alert-danger alert-dismissible fade show" role="alert" id="myAlert">
                    Email does not match!
                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
               </div>-->
                <h2>Recover Password</h2>
                
                <?php if(count($errors)>0): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="myAlert">
                        <?php foreach($errors as $error): ?>
                            <li><?php echo $error; ?></li>
                        <?php endforeach; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <form action="forgot_password.php" method="post">
                   <div class="inputBx">
                       <span>Email</span>
                       <input type="email" name="email">
                   </div>  
                   <!-- <div class="remember">
                       <label><input type="checkbox" name="" id=""> Remember me</label>
                   </div> -->
                   <div class="inputBx">
                       <input type="submit" value="Recover my password" name="forgot-password">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>