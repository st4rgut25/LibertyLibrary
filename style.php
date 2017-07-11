
<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Style{

public $bgcol;
public $face;
public $align;
public $size;
public $text;
public $width;
public $height;
public $bottom;
public $right;
public $imgwidth;
public $imgheight;
public $padding;
public $display;
public $marginLeft;
public $marginTop;

function __construct ($bgcol="#c4ff41",$align="right",$face="Arial",$text="#000000",$size="17px",$width="50%",$height="50%",$bottom="0", $right="0",$imgwidth="100px",$imgheight="140px",$padding="20px",$display="inline-block",$marginLeft="25%",$marginTop="15%")
{
$this->bgcol=$bgcol;
$this->face=$face;
$this->size=$size;
$this->align=$align;
$this->text=$text;
$this->width=$width;
$this->height=$height;
$this->bottom=$bottom;
$this->right=$right;
$this->imgwidth=$imgwidth;
$this->imgheight=$imgheight;
$this->padding=$padding;
$this->display=$display;
$this->marginLeft=$marginLeft;
$this->marginTop=$marginTop;

}
function Set($varname,$value)
{
$this->$varname=$value;
}
function TextOut($message="&nbsp")
{
        PRINT "<h1 style='font-family:$this->face'>$message</h1>\n"; 
}
function login($bigMsg="&nbsp",$smallMsg="&nbsp",$url="&nbsp",$btn1="&nbsp",$btn2="&nbsp")
{
//font-family:$this->face; position: relative; right:$this->right;bottom:$this->bottom'
PRINT "<div style='background-color:$this->bgcol; height:$this->height; width:$this->width;font-family:$this->face; position: relative;padding:$this->padding;margin-top:$this->marginTop;margin-left:$this->marginLeft;display:$this->display'><h1>$bigMsg</h1><h2>$smallMsg</h2><img src='".$url."' style='width:$this->imgwidth;height:$this->imgheight; bottom:$this->bottom; right:$this->right; position:absolute'>".$btn1.$btn2."</div>\n";
}

function Body($content)
{//changed body to form, added action method attributes
PRINT "<form action='' method='post' style='background-color:#81d6ff; padding:$this->padding;font-family:$this->face;display:$this->display;width:$this->width'>".$content."</form>\n";
}
function navBar()
{
$navItems = array("Home"=>"#home","Review Receipt"=>"#receipt","Account Status"=>"#status","Logout"=>"logout.php");
foreach($navItems as $key=>$value)
{
PRINT "<div style='width:$this->width;height:$this->height;background-color:$this->bgcol;font-size:$this->size;display:$this->display;margin-left:5px'><a href=".$value.">".$key."</a></div>\n";
}
}

}
?>
