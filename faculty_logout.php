<?php
session_start();
session_destroy();
unset($_SESSION['employee_id']);
$_SESSION['message']="You are now logged out";
header("location:faculty_login.php");
?>