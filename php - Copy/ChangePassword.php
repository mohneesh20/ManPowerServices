<?php
include_once("connection.php");
$name=$_GET["Name"];
$newpassword=$_GET["Newpassword"];
$query="update users set password='$newpassword' where uid='$name'";
mysqli_query($dbCon,$query);
$msg=mysqli_error($dbCon);
if($msg=="")
{
    
	echo "PASSWORD CHANGED";
    
}
else
	echo $msg;




?>