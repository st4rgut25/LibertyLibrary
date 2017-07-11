<?php
require("connect.php");
session_start();
$user_check = $_SESSION['login_user'];
$ses_sql = mysqli_query($cnn,"select username FROM login WHERE username='$user_check'");
$row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
$login_session = $row['username'];
if (!isset($user_check)){header("location:loginPage.php");}
?>
