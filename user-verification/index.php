<?php 
    require_once '../controllers/authController.php';

// verify the user using token
if (isset($_GET['token']))
{
    $token = $_GET['token'];
    verifyUser($token);
}

// verify the user using token
if (isset($_GET['password-token']))
{
    $passwordToken = $_GET['password-token'];
    resetPassword($passwordToken);
}

//if user is not logged in
if(!isset($_SESSION['id'])){
    //direct to login
    header('location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email_Verify</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style_userverify.css">
</head>
<body>
    <section>
        <div class="imgBx">
            <img src="images/bg.jpg"/>
        </div>
        <a href="logout.php"><div class="logoutbtn" name="logout"><span><img src="images/logout.png" height="15" width="20"></span>Logout</div></a>
        <div class="contentBx">
            <div class="formBx">
                <h2>Welcome <?php echo $_SESSION['username'];?></h2>
                <form>
                    <!--You are successfully logged in flash message/ Your email was successfully verified-->
                    <?php if(isset($_SESSION['message'])): ?>
                        <div class="alert alert-info alert-dismissible fade show" role="alert" id="myAlert">
                            <?php echo $_SESSION['message'];?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php unset($_SESSION['message']); ?>
                        <?php unset($_SESSION['alert-class']); ?>
                    <?php endif; ?>
                        
                    <!--
                    <div class="alert alert-info alert-dismissible fade show" role="alert" id="myAlert">
                        <strong>Success! </strong> Your email address has been verified successfully.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>-->

                    <?php if(!$_SESSION['verified']): ?>
                        <div class="emailBx">
                            You need to verify your account.
                            Sign in to your mail account and click 
                            on the verification link we have mailed
                            you at
                            <!--user email from session-->
                            <strong><?php echo $_SESSION['email']; ?></strong>
                        </div>
                    <!--not verified their account? ends-->
                    <?php endif; ?>

                    <?php if($_SESSION['verified']): ?>
                    <div class="inputBx">
                        <input type="submit" value="I'm Verified" formaction="http://localhost/iwp/index.php">
                    </div>
                    <?php endif; ?>
                
                </form>
            </div>
        </div>
    </section>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>