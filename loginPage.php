<link rel="stylesheet" type="text/css" href="style.css">
<?php
require("style.php");
require("connect.php");
session_start();

$table = "SELECT * FROM `login`";
if ($query_run=mysqli_query($cnn,$table)){

$username = mysqli_real_escape_string($cnn,$_POST['username']);
$pw = mysqli_real_escape_string($cnn,$_POST['password']);
$submit = $_POST['submit'];
$login = FALSE;

$usertype = $_GET['user']; //from landing.php URL
//echo $usertype;


//NEW USER
if ($usertype=="newuser"){
//require("loginForm.php");
$newlogin = new Style;
$newlogin->login("Sign up for LibertyLibrary Portal!","Get access to our collection of books, movies and mags","liberty.png","
<form action='' method='post'>
Username: <input type='text' name='username'><br>
Password: <input type='password' name='password'><br>
<input type='submit' name='submit' value='login'>
</form>
","");
if ($submit){
$user_doops = mysqli_query($cnn,"SELECT * FROM login WHERE username='$username'"); 
$get_rows = mysqli_affected_rows($cnn);
if ($get_rows==0){
	$sql2 = "INSERT INTO login (username,password) VALUES ('{$username}','{$pw}')";
	if($cnn->query($sql2)===TRUE){$_SESSION['login_user']=$username;header("location:welcome.php");}
	else{echo "Error: ".$sql."<br>".$cnn->error;}
}
else {echo "Sorry but that username has been taken already";}
}

}

//RETURNING USER
if ($usertype=="returnuser"){

$returnlogin = new Style;
$returnlogin->login("Welcome Back to LibertyLibrary Portal!","","liberty.png","<form action='' method='post'>
Username: <input type='text' name='username'><br>
Password: <input type='password' name='password'><br>
<input type='submit' name='submit' value='login'>
</form>","");
$sql = "SELECT id FROM login WHERE username='$username' and password='$pw'";
if ($submit){
$result = mysqli_query($cnn,$sql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
$count = mysqli_num_rows($result);
if ($count == 1){$_SESSION['login_user']=$username;$_SESSION['id']=$row["id"];header("location:welcome.php");}
else {echo "you entered your username/password wrong";}
}
}

}
else{die("table connection failed");}
$cnn.close();

?>
