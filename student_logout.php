<?php
session_start();
session_destroy();
unset($_SESSION['student_id']);
$_SESSION['message']="You are now logged out";
header("location:student_login.php");
?>