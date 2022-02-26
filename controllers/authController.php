<?php

session_start();

require 'C:\xampp\htdocs\iwp\config\db.php';//require database connection file
require_once 'C:\xampp\htdocs\iwp\controllers\emailController.php';
//require_once 'C:\xampp\htdocs\iwp\profanities.php';
error_reporting(E_ALL ^ E_WARNING); 

$edit=false;
$errors = array();//initialize global error variable
$username = "";//initialize global username variable
$email = "";//initialize global email variable
$alert_disp = array();
$show_Alert=false;//initialize alert variable
$show_Alert_ans=false;
$show_Alert_que=false;
$show_Alert_wrong_edit_que=false;
$title_question='';

// if user clicks on the sign up button

if(isset($_POST['signup-btn']))
{
    //Assign the values of the form
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordConf=$_POST['passwordConf'];
    //store values in db ends

    //validation against input condition starts
    //empty username starts
    if (empty($username)) {
        $errors['username'] = "Username required";
    }
    //empty username ends
    //validate email format starts
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors['email'] = "Email address is invalid";
    }
    //validate email format ends
    //empty email starts
    if (empty($email)) {
        $errors['email'] = "Email required";
    }
    //empty email ends


     //check whether username already exists or not
     $existSql = "SELECT * FROM `users` WHERE username = '$username'";
     $result = mysqli_query($conn, $existSql);
     $numExistRows = mysqli_num_rows($result);
     if ($numExistRows > 0) {
        $errors['username'] = "Username already exists";
     } 
     //username check ends

    //empty password starts
    if (empty($password)) {
        $errors['password'] = "Password required";
    }
    //empty password ends
    //password match starts
    if($password !== $passwordConf){
        $errors['password'] = "The Passwords do not match";
    }
    //password match ends
    //validation against input condition ends

    //check unique email starts
    $emailQuery = "SELECT * FROM users where email=? LIMIT 1";//prepared statements
    $stmt = $conn->prepare($emailQuery);//prepare the query
    $stmt->bind_param('s',$email);//binds the parameters, allows for querying the database
    $stmt->execute();//execution
    $result=$stmt->get_result();//result
    $userCount=$result->num_rows;//users returned from database having same email another user provided
    $stmt->close();//close statement
    
    //if rows>0 email duplication 
    if($userCount>0){
        $errors['email']="Email already exists";
    }
    
    //check unique email ends

    //error count zero starts
    if(count($errors) === 0){
        //password hash
        $password = password_hash($password,PASSWORD_DEFAULT);//password default-bcrypt algorithm
        //token generation for email verification
        $token = bin2hex(random_bytes(50));
        //unverified user
        $verified = false; 
    //error count zero ends

        //query for entering user details in db
        $sql = "INSERT INTO users (username, email, verified, token, password) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssbss', $username, $email, $verified, $token, $password);
        
        //if successfully executed
        if($stmt->execute()){

            //login user

            $user_id = $conn->insert_id;//connection object gives the id of the last inserted entry
            $_SESSION['id'] = $user_id;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['verified'] = $verified;

            sendVerificationEmail($email, $token);


            //set flash message
 
            $_SESSION['message'] = "You are now logged in";
            $_SESSION['alert-class'] = "alert-info alert-dismissible fade show";//gives success in green box
            header('location: index.php');
            exit();

        } 
        //db connection failed
        else{
            $errors['db_error']="Database error: failed to register";
        }
    }
}


//if user clicks on the login button


if (isset($_POST['login-btn'])) {

    

    $username = $_POST['username'];
    $password = $_POST['password'];

    //validation
    if (empty($username)) {
        $errors['username'] = "Username required";
    }

    if (empty($password)) {
        $errors['password'] = "Password required";
    }

    $username = trim($_POST['username']);
    
    //check whether username already exists or not
    if(!empty($username))
    {
        $existSql = "SELECT * FROM `users` WHERE username = '$username' OR email = '$username' ";
        $result = mysqli_query($conn, $existSql);
        $numExistRows = mysqli_num_rows($result);
        if (!$numExistRows > 0) {
        $errors['username'] = "Username/Email does not exist";
        } 
    }
    //username check ends
 
    
    if (count($errors) === 0) {

        $sql = "SELECT * FROM users WHERE email=? OR username=? LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $username, $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();//fetch user results as an associative array
        



        //password validation
        if (password_verify($password, $user['password'])) {
                //login success

                //putting the session variables from user array
                $_SESSION['id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['verified'] = $user['verified'];

                //set flash message

                $_SESSION['message'] = "You are logged in!";
                $_SESSION['alert-class'] = "alert-success";
                if (isset($_SESSION['username']) && $_SESSION['username'] == 'admin'){
                    header('location: http://localhost/iwp/admin/home.php');
                    exit();
                }
                else{
                    header('location: index.php');
                    exit();
                }



        } else {
            $errors['login_fail'] = "Incorrect Password";
        }
    }
}



//logout user
//click on logout link
if (isset($_GET['logout'])) {
    session_destroy();
    //remove session values
    unset($_SESSION['id']);
    unset($_SESSION['username']);
    unset($_SESSION['email']);
    unset($_SESSION['verified']);

    header('location: ../user-verification/login.php');
    exit();
}

//verify user by token

function verifyUser($token)
{
    global $conn;
    $sql = "SELECT * FROM users WHERE token='$token' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    //if there exists atleast one user with this token
    if (mysqli_num_rows($result) > 0){

        //get user as an associative array from query result
        $user = mysqli_fetch_assoc($result);

        //change verify status from 0 to 1
        $update_query = "UPDATE users SET verified=1 WHERE token='$token'";

        //if query executes successfully
        if (mysqli_query($conn, $update_query)){
            //log user in

            //login success
            $_SESSION['id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['verified'] = 1;

            //set flash message

            $_SESSION['message'] = "Your email address was successfully verified";
            $_SESSION['alert-class'] = "alert-success";
            header('location: index.php');
            exit();

        }
    } else {
        echo 'User Not Found';
    }

}

// if user clicks on the forgot password button

if (isset($_POST['forgot-password'])){
    $email = $_POST['email'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors['email'] = "Email address is invalid";
    }

    if (empty($email)) {
        $errors['email'] = "Email required";
    }

    //check whether email already exists or not
    $existSql = "SELECT * FROM `users` WHERE email = '$email'";
    $result = mysqli_query($conn, $existSql);
    $numExistRows = mysqli_num_rows($result);
    if (!$numExistRows > 0) {
        $errors['email'] = "Email does not match";
    } 
    //email check ends

    if(count($errors) == 0){
        $sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";
        $result = mysqli_query($conn, $sql);
        $user = mysqli_fetch_assoc($result);
        $token = $user['token'];
        sendPasswordResetLink($email, $token);
        header('location: password_message.php');
        exit(0);
    }


}

// if user clicked on the reset password button

if(isset($_POST['reset-password-btn'])){
$password = $_POST['password'];
$passwordConf = $_POST['passwordConf'];

if (empty($password || empty($passwordConf))) {
    $errors['password'] = "Password required";
}

if($password !== $passwordConf){
    $errors['password'] = "The Passwords do not match";
}

$password = password_hash($password, PASSWORD_DEFAULT);
//take the email address
$email = $_SESSION['email'];
//check the email address for errors
if (count($errors) == 0){
    $sql = "UPDATE users SET password='$password' WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if ($result){
        header('location: login.php');
        exit(0);
    }
}

}


function resetPassword($token)
{
    global $conn;
    $sql = "SELECT * FROM users WHERE token='$token' LIMIT 1"; 
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
    $_SESSION['email'] = $user['email'];
    header('location: reset_password.php');
    exit(0);
}

function word_check($string)
{
    global $conn;
    $string_to_array= explode(" ", $string);
    // echo '<pre>' . print_r($string_to_array, TRUE) . '</pre>';
    
    foreach ($string_to_array as $word)
    {
        $sql="SELECT * FROM `badwords` WHERE `words` LIKE '$word'";
        $result=mysqli_query($conn,$sql);
        // $query = mysqli_query("SELECT * FROM `badwords` WHERE `words` LIKE '$word'");
        while($row = mysqli_fetch_array($result))
        {
            $word_found = $row['words'];
            $new_word = preg_replace('/(?!^.?).(?!.{0}$)/', '*', $word_found);
            
            $key = array_search($word_found,$string_to_array);
            $length = strlen($word_found)-1;
    
            $replace = array($key => $new_word);
            $string_to_array = array_replace($string_to_array,$replace);
        }
    }
    
    $new_string = implode(" ", $string_to_array);
    return $new_string;
}


function tags_check($string)
{
    global $conn;
    $string_to_array= explode(",", $string);
    // echo '<pre>' . print_r($string_to_array, TRUE) . '</pre>';
    
    foreach ($string_to_array as $word)
    {
        $sql="SELECT * FROM `badwords` WHERE `words` LIKE '$word'";
        $result=mysqli_query($conn,$sql);
        // $query = mysqli_query("SELECT * FROM `badwords` WHERE `words` LIKE '$word'");
        while($row = mysqli_fetch_array($result))
        {
            $word_found = $row['words'];
            $new_word = preg_replace('/(?!^.?).(?!.{0}$)/', '*', $word_found);
            
            $key = array_search($word_found,$string_to_array);
            $length = strlen($word_found)-1;
    
            $replace = array($key => $new_word);
            $string_to_array = array_replace($string_to_array,$replace);
        }
    }
    
    $new_string = implode(",", $string_to_array);
    return $new_string;
}

//if the user clicks on update profile button

if (isset($_POST['update-btn']))
{
    //Assign the values of the form
    $username = $_POST['username'];
    $old_password = $_POST['old_password'];
    $password = $_POST['password'];
    $passwordConf=$_POST['passwordConf'];
    //store values in db ends


    if(empty($username))
    {
        $alert_disp_error['update_empty_username'] = "Please enter a username";//error message
    }

    if (!empty($username))
    {
        
        $existSql = "SELECT * FROM `users` WHERE id <> '".$_SESSION['id']."' AND username = '$username'";
        $result = mysqli_query($conn, $existSql);
        $numExistRows = mysqli_num_rows($result);
        if ($numExistRows > 0) {
            $errors['username'] = "Username already exists";
        } 
    }

    if (empty($password) && empty($passwordConf) && !empty($old_password))
    {
        $sql = "SELECT * FROM `users` WHERE `id` = ".$_SESSION['id']."";      
        $result = mysqli_query($conn, $sql); 
        $num = mysqli_num_rows($result);
        // echo '<pre>' . print_r($result, TRUE) . '</pre>';
        if($num == 1)
        {
            while ($row = mysqli_fetch_assoc($result))
            {
                // echo '<pre>' . print_r($row, TRUE) . '</pre>';
                // echo '<pre>' . print_r($password, TRUE) . '</pre>';
                if (password_verify($old_password, $row['password'])) {
                    $alert_disp_success['update_not_empty_old_password1'] = "Your Password is the same";//success message
                }
                else{
                    $alert_disp_error['update_not_empty_old_password2'] = "Old password does not match";//error message
                }
            }
        }
    }


    if (!empty($password) && empty($passwordConf) && empty($old_password))
    {
        $alert_disp_error['update_not_empty_new_password1'] = "Please enter your old password";//error message
        $alert_disp_error['update_not_empty_new_password2'] = "Please confirm your new password";//error message
    }

    if (empty($password) && !empty($passwordConf) && empty($old_password))
    {
        $alert_disp_error['update_not_empty_new_confpassword1'] = "Please enter your old password";//error message
        $alert_disp_error['update_not_empty_new_confpassword2'] = "Please enter your new password";//error message
    }

    if (!empty($password) && empty($passwordConf) && !empty($old_password))
    {
        $sql = "SELECT * FROM `users` WHERE `id` = ".$_SESSION['id']."";      
        $result = mysqli_query($conn, $sql); 
        $num = mysqli_num_rows($result);
        // echo '<pre>' . print_r($result, TRUE) . '</pre>';
        if($num == 1)
        {
            while ($row = mysqli_fetch_assoc($result))
            {
                // echo '<pre>' . print_r($row, TRUE) . '</pre>';
                // echo '<pre>' . print_r($password, TRUE) . '</pre>';
                if (password_verify($old_password, $row['password'])) {

                    if($password !== $passwordConf){
                        $alert_disp_error['update_empty_conf_password1'] = "Please confirm your new password";//error message
                    }

                    
                }
                else{
                    $alert_disp_error['update_empty_conf_password2'] = "Old password does not match";//error message
                }
            }
        }
    }


    if (empty($password) && !empty($passwordConf) && !empty($old_password))
    {
        $sql = "SELECT * FROM `users` WHERE `id` = ".$_SESSION['id']."";      
        $result = mysqli_query($conn, $sql); 
        $num = mysqli_num_rows($result);
        // echo '<pre>' . print_r($result, TRUE) . '</pre>';
        if($num == 1)
        {
            while ($row = mysqli_fetch_assoc($result))
            {
                // echo '<pre>' . print_r($row, TRUE) . '</pre>';
                // echo '<pre>' . print_r($password, TRUE) . '</pre>';
                if (password_verify($old_password, $row['password'])) {

                    if($passwordConf !== $password){
                        $alert_disp_error['update_empty_new_password1'] = "Please enter your new password";//error message
                    }

                    
                }
                else{
                    $alert_disp_error['update_empty_new_password2'] = "Old password does not match";//error message
                }
            }
        }
    }

    if (!empty($password) && !empty($passwordConf) && empty($old_password))
    {
        $alert_disp_error['update_empty_old_password1'] = "Please enter your old password";//error message
    }


    if (empty($password) && empty($passwordConf) && empty($old_password) && !empty($username))
    {
        //check whether username already exists or not                         username = '$username' // id 13 admin

        // echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';

        $existSql = "SELECT * FROM `users` WHERE id <> '".$_SESSION['id']."' AND username = '$username'";
        $result = mysqli_query($conn, $existSql);
        $numExistRows = mysqli_num_rows($result);
        if ($numExistRows > 0) {
            $errors['username'] = "Username already exists";
        } 
        //username check ends
        else
        {
            $sql = "UPDATE `users` SET `username` = '$username' WHERE `users`.`id` = '".$_SESSION['id']."'";
            $_SESSION['username'] = $username;
            $result = mysqli_query($conn, $sql);
            // $_SESSION['message'] = "Your username has been updated successfully";
            $alert_disp_success['update_username_only'] = "Your username has been updated successfully";//success message
            // $_SESSION['alert-class'] = "alert-success";
        }

        


    }

    elseif(!empty($password) && !empty($passwordConf) && !empty($old_password))
    {


        //update username starts
        $existSql = "SELECT * FROM `users` WHERE `id` <> ".$_SESSION['id']." AND username = '$username'";
        $result = mysqli_query($conn, $existSql);
        $numExistRows = mysqli_num_rows($result);
        if ($numExistRows > 0) {
            $errors['username'] = "Username already exists";
        } 
        //username check ends
        else
        {
            $sql = "UPDATE `users` SET `username` = '$username' WHERE `users`.`id` = ".$_SESSION['id']."";
            $_SESSION['username'] = $username;
            $result = mysqli_query($conn, $sql);
            $alert_disp_success['update_username_2'] = "Your username has been updated successfully";//success message
        }
        //update username ends

        $sql = "SELECT * FROM `users` WHERE `id` = ".$_SESSION['id']."";      
        $result = mysqli_query($conn, $sql); 
        $num = mysqli_num_rows($result);
        // echo '<pre>' . print_r($result, TRUE) . '</pre>';
        if($num == 1)
        {
            while ($row = mysqli_fetch_assoc($result))
            {
                // echo '<pre>' . print_r($row, TRUE) . '</pre>';
                // echo '<pre>' . print_r($password, TRUE) . '</pre>';
                if (password_verify($old_password, $row['password'])) {
                    if($password !== $passwordConf){
                        $errors['password'] = "The Passwords do not match";
                        
                    }
                    else
                    {
                        
                        $password = password_hash($password,PASSWORD_DEFAULT);
                        $sql = "UPDATE `users` SET `password` = '$password' WHERE `id` = ".$_SESSION['id']."";
                        $result = mysqli_query($conn, $sql);
                        $alert_disp_success['update_password_2'] = "Your password has been updated successfully";//success message

                    }
                }

                else
                {
                    $alert_disp_error['update_password_3'] = "Your old password does not match";//error message
                }
            }
        }
        

    }




        // //password match starts
        // if($password !== $passwordConf){
        //     $errors['password'] = "The Passwords do not match";
        // }
        // //password match ends
}




//user record deletion

if (isset($_POST['delete-btn']))
{

    // sql to delete a record
    

    $sql = "DELETE FROM users WHERE id=".$_SESSION['id']."";
    $execute = mysqli_query($conn,$sql);
    if ($conn->query($sql) === TRUE || $execute) {
    $alert_disp['del_record'] = "Account deleted successfully";

    session_unset();
    session_destroy();
    $conn->close();
    header('location: ../index.php?alert_disp='.$alert_disp['del_record']);
    exit();
    } else {
    echo "Error deleting record: " . $conn->error;
    }
}




if (isset($_POST['q-btn']))
{
    
    $tags=$_POST['que_tags'];
    $title=$_POST['enter_question'];
    $description = $_POST['que_desc'];
    $category = $_POST['category'];
    $username =  $_SESSION['username'];

    $title=word_check($title);
    $description=word_check($description);
    $tags=tags_check($tags);
    $sql = "INSERT INTO `questions` (`Question title`, `Question Description`, `Category`, `DATETIME`, `Tags`, `Upvotes`, `Answers`, `Asked By`) VALUES ('$title', '$description', '$category', current_timestamp(), '$tags', NULL, NULL,'$username')";

    $result = mysqli_query($conn, $sql);
   // echo '<pre>' . print_r($result, TRUE) . '</pre>';
    if($result==1){
        $show_Alert=TRUE;
        }
    


}


?>

<?php 


// lets assume a user is logged in with id $user_id


// if user clicks like or dislike button
if (isset($_POST['action'])) {
    
if (isset($_SESSION['username']))
{
  $username=$_SESSION['username'];
  $sql= "SELECT `id` FROM `users` WHERE `username` = '$username'";
  $result = mysqli_query($conn, $sql);
  
  $row=mysqli_fetch_assoc($result);
  $user_id = $row['id'];
 
}

    $post_id = $_POST['post_id'];
    $action = $_POST['action'];
  switch ($action) {
  	case 'like':
         $sql="INSERT INTO rating_info (user_id, post_id, rating_action) 
         	   VALUES ($user_id, $post_id, 'like') 
         	   ON DUPLICATE KEY UPDATE rating_action='like'";
         break;
  	case 'dislike':
          $sql="INSERT INTO rating_info (user_id, post_id, rating_action) 
               VALUES ($user_id, $post_id, 'dislike') 
         	   ON DUPLICATE KEY UPDATE rating_action='dislike'";
         break;
  	case 'unlike':
	      $sql="DELETE FROM rating_info WHERE user_id=$user_id AND post_id=$post_id";
	      break;
  	case 'undislike':
      	  $sql="DELETE FROM rating_info WHERE user_id=$user_id AND post_id=$post_id";
      break;
  	default:
  		break;
  }

  // execute query to effect changes in the database ...
  mysqli_query($conn, $sql);
  echo getRating($post_id);
  exit(0);
}


// Get total number of likes for a particular post
function getLikes($id)
{
  global $conn;
  $sql = "SELECT COUNT(*) FROM rating_info 
  		  WHERE post_id = $id AND rating_action='like'";
  $rs = mysqli_query($conn, $sql);
  $result = mysqli_fetch_array($rs);
  return $result[0];
}

// Get total number of dislikes for a particular post
function getDislikes($id)
{
  global $conn;
  $sql = "SELECT COUNT(*) FROM rating_info 
  		  WHERE post_id = $id AND rating_action='dislike'";
  $rs = mysqli_query($conn, $sql);
  $result = mysqli_fetch_array($rs);
  return $result[0];
}

// Get total number of likes and dislikes for a particular post
function getRating($id)
{
  global $conn;
  $rating = array();
  $likes_query = "SELECT COUNT(*) FROM rating_info WHERE post_id = $id AND rating_action='like'";
  $dislikes_query = "SELECT COUNT(*) FROM rating_info 
		  			WHERE post_id = $id AND rating_action='dislike'";
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

// Check if user already likes post or not
function userLiked($post_id)
{
  global $conn;
  global $user_id;
  $sql = "SELECT * FROM rating_info WHERE user_id=$user_id 
  		  AND post_id=$post_id AND rating_action='like'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
  	return true;
  }else{
  	return false;
  }
}

// Check if user already dislikes post or not
function userDisliked($post_id)
{
  global $conn;
  global $user_id;
  $sql = "SELECT * FROM rating_info WHERE user_id=$user_id 
  		  AND post_id=$post_id AND rating_action='dislike'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
  	return true;
  }else{
  	return false;
  }
}

$sql = "SELECT * FROM questions";
$result = mysqli_query($conn, $sql);
// fetch all posts from database
// return them as an associative array called $posts
// $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
$numExistRows = mysqli_num_rows($result);
if ($numExistRows > 0) {
    $noResult=false;
} 



// if (isset($_POST['a-btn']))
// {
//     $answer=$_POST['ans_desc'];

//     $username=$_SESSION['username'];
//     $sql= "SELECT `id` FROM `users` WHERE `username` = '$username'";
//     $result = mysqli_query($conn, $sql);
    
//     $row=mysqli_fetch_assoc($result);
//     $user_id = $row['id'];
//     $post_id = $_POST['post_id'];



//     $sql = "INSERT INTO `answers` (`answer`, `post_id`, `user_id`, `comment_time`) VALUES ('$answer', '$post_id', '$user_id', current_timestamp())";
//     $result = mysqli_query($conn, $sql);

//     if($result==1){
//         $show_Alert=TRUE;
//         }
// }

?>

<?php

// $sql = "SELECT * FROM answers";
// $result = mysqli_query($conn, $sql);
// // fetch all posts from database
// // return them as an associative array called $posts
// $answers = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>
<?php
if (isset($_POST['edit_submit_question']))
{
    $sno = $_POST["snoEdit"];
    $username=$_SESSION['username'];
    $sql="SELECT `Asked By` FROM `questions` WHERE `S.NO`='$sno'";
    $result = mysqli_query($conn, $sql);
    // echo '<pre>' . print_r($sql, TRUE) . '</pre>';
    while($row = mysqli_fetch_array($result))
    {
        $asked=$row['Asked By'];
        if($asked==$username)
        {
             if (isset( $_POST['snoEdit'])){


                // Update the record
                  
                  $title = $_POST["titleEdit"];
                  $title = word_check($title);
                  $description = $_POST["descriptionEdit"];
                  $description = word_check($description);
                  $que_tags = $_POST["que_tags"];
                  $que_tags = tags_check($que_tags);
                // Sql query to be executed
                $sql = "UPDATE `questions` SET `Question title` = '$title' , `Question Description` = '$description', `tags`='$que_tags' WHERE `S.NO` = $sno";
                $result = mysqli_query($conn, $sql);
              
                if($result==1){
                    $show_Alert_que=true;
                    // echo '<pre>' . print_r($show_Alert_que, TRUE) . '</pre>';
              }
             
             }
        }
        elseif($asked!=$username){
            $show_Alert_wrong_edit_que=true;
            // echo '<pre>' . print_r($show_Alert_wrong_edit_que, TRUE) . '</pre>';
        
        }
    }


    
}?>

<?php

if (isset($_POST['edit_submit_answer']))
{
    $comment_id = $_POST["comment_id_edit"];
    $username=$_SESSION['username'];
    $sql="SELECT `comment_sender_name` FROM `tbl_comment` WHERE `comment_id`='$comment_id'";
    $result = mysqli_query($conn, $sql);
    // echo '<pre>' . print_r($sql, TRUE) . '</pre>';
    while($row = mysqli_fetch_array($result))
    {
        $asked=$row['comment_sender_name'];
        if($asked==$username)
        {
            if (isset( $_POST['comment_id_edit'])){
                // Update the record
                  
                  $comment = $_POST["commentEdit"];
                  $comment = word_check($comment);
              
                // Sql query to be executed
                $sql = "UPDATE `tbl_comment` SET `comment` = '$comment' WHERE `comment_id` = $comment_id";
                $result = mysqli_query($conn, $sql);
              
                if($result==1){
                    $show_Alert_ans=true;
              }
              }
        }
        elseif($asked!=$username){
            $show_Alert_wrong_edit_que=true;
        }
    }



    
}



?>