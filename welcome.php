<link rel="stylesheet" type="text/css" href="style.css"> 

<?php
require("connect.php");
require("style.php");
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

session_start();
unset($_SESSION['id']);
//echo "session id is ".$_SESSION['id'];

class Book 
{
public $title;
public $author;
public $id;

function __construct()
{
global $cnn;
$this->author=mysqli_real_escape_string($cnn,$_POST['author']);
$this->title = mysqli_real_escape_string($cnn,$_POST['title']);
$this->id=$_SESSION['id'];
$this->username = $_SESSION['login_user'];
if (!isset($_SESSION['id'])) ////$this->id==""   if false then is new user
{
$sql2="SELECT id FROM login WHERE username='$this->username'";
$getId = mysqli_query($cnn,$sql2);
$row = mysqli_fetch_array($getId,MYSQLI_ASSOC);
$id = $row['id'];
$this->id=$id;
}
}

public function SendToDatabase($cnn)
{
$sql = "SELECT * FROM `loan`";
if ($query_loan=mysqli_query($cnn,$sql))
{

$table = "SELECT * FROM `loan`";
if ($query_run=mysqli_query($cnn,$table))

$sql2 = "INSERT INTO loan (id,title,author) VALUES ('{$this->id}','{$this->title}','{$this->author}')"; 
if ($send_request=mysqli_query($cnn,$sql2)){echo "Thank you, your request has been sent.";}
else{echo "Error:".$sql2."<br>".$cnn->error;}
}
else {echo "sorry we couldn't send your request.";}

}

public function DisplayForm()
{
$newForm = new Style;
$newForm->Set("marginLeft","0%");
$newForm->Set("marginTop","0%");
$newForm->Set("width","40%");
$newForm->login("Order your book","Books are loaned out for one week","liberty.png","<form action='' method='post'>
Title: <input type='text' name='title'><br>
Author: <input type='text' name='author'><br>
<input type='submit' name='submitBook' value='submit'>
</form>","");

}

public function PrintReceipt($cnn)
{
$allLoans="SELECT * FROM loan WHERE id='$this->id'";
if($getLoans = mysqli_query($cnn,$allLoans))
{
if (mysqli_num_rows($getLoans)==0){echo "you have not loaned any books ";}
else 
{
echo "<table><tr><th>Title</th><th>Author</th></tr>";
while ($row = mysqli_fetch_array($getLoans))
{
echo "<td>".$row['title']."</td><td>".$row['author']."</td></tr>";
}
echo "</table>";
}
}

}//public function ends

};
?>
<?php
require("session.php");

$submit = $_POST['submitBook'];

$welcomePage = new Style;
/*goes inside Body() */
$welcomePage->Set("height","10%");
$welcomePage->Set("width","20%");
$welcomePage-> navBar();//removed form tags
$welcomePage->Set("width","50%");
$welcomePage-> Body("<h1>Welcome ".$_SESSION['login_user']."</h1> 
<img src='http://www.durham-hens-poultry-supplies.co.uk/ekmps/shops/mmanchester/images/hen-holiday-deposit-1418-p.jpg'><br><input type='submit' name='submit' value='Request Book'><input type='submit' name='receipt' value='View Receipt'>");

$request = mysqli_real_escape_string($cnn,$_POST['submit']);
$receipt = mysqli_real_escape_string($cnn,$_POST['receipt']);
$book = new Book();
if ($request)
{
$book->DisplayForm();
}

if ($submit){$book->SendToDatabase($cnn);}

if ($receipt){$book->PrintReceipt($cnn);}
?>


