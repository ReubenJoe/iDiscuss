<?php

require 'constants.php';
/*defines*/


$conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);//db connection

//if connection fails, display error
if($conn->connect_error)
{
    die('Database error:' . $conn->connect_error);
}

?>