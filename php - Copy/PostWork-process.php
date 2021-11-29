<?php
include_once("connection.php");
$cus_uid=$_GET["cus_uid"];
$category=$_GET["category"];
$problem=$_GET["problem"];
$location=$_GET["location"];
$city=$_GET["city"];
$state=$_GET["state"];
$dop=date("y/m/d");
$query="insert into requirements values(default,'$cus_uid','$category','$problem','$location','$city','$state','$dop')";
mysqli_query($dbCon,$query);
$msg=mysqli_error($dbCon);
if($msg=="")
{
  echo "WORK POSTED SUCCESSFULLY";  
}
else
{
	echo $msg;
}
?>
