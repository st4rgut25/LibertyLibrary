<?php

$username="root";
$servername="localhost";
$password="dumbotron";
$cnn = mysqli_connect($servername,$username,$password);
if($cnn){
//echo "connection to server successful";

if (mysqli_select_db($cnn,"login")){
//echo "connection to database successful";
}
else {die("connection to database failed");}

}

else{die("connection to database failed");}
?>
