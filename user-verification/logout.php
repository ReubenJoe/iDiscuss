<?php
require '../controllers/authController.php';

session_unset();
session_destroy();
header('location: ../index.php');
?>