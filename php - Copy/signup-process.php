<?php
include_once("connection.php");
$uid=$_GET["txtName"];
$password=$_GET["txtPwd"];
$mobile=$_GET["txtMob"];
$category=$_GET["txtCat"];
$dos=date("y/m/d");
$query="insert into users values('$uid','$password','$mobile','$dos','$category',1)";
mysqli_query($dbCon,$query);
$msg=mysqli_error($dbCon);
if($msg=="")
{
    
	echo "<h2>You are signed up successfully...</h2>";
    
}
else
	echo $msg;

?>
