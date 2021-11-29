<?php
include_once("connection.php");
$cus_uid=$_GET["cus_uid"];
$wor_uid=$_GET["wor_uid"];
$query="insert into ratings(cus_uid,wor_uid) values('$cus_uid','$wor_uid')";
mysqli_query($dbCon,$query);
$msg=mysqli_error($dbCon);
if($msg=="")
{
    
	echo "REQUESTED";
    
}
else
	echo $msg;

?>
