<link rel="stylesheet" type="text/css" href="style.css"> 
<?php
//error_reporting(E_ALL);
session_destroy();
require "style.php";

$Tbody = new Style;


echo "
<div>".$Tbody->login("Liberty Library Login","Welcome to Liberty Library, where freedom lives between the sheets","liberty.png","<div class='userType'><a href=\"loginPage.php?user=newuser\">New User</a></div>","<div class='userType'><a href=\"loginPage.php?user=returnuser\">Returning User</a></div>")."
</div>
</body>
";
?>


