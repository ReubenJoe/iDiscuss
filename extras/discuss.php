

//if user is not logged in
if(!isset($_SESSION['question'])){
    //direct to login
    header('location: ../user-verification/login.php');
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Post</title>
</head>
<body>
    <input type = "text" name = "enter_question" value="<?php echo $_SESSION['question']?>">
    <textarea name = "que_desc"></textarea>
    <input type = "text" name = "tags">
</body>
</html>