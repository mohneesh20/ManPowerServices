<?php
	include_once("connection.php");
$cus_uid=$_GET["cus_uid"];
$query="select * from citizens where uid='$cus_uid'";
//echo $cus_uid;
$table=mysqli_query($dbCon,$query);

$ary=array();

while($row=mysqli_fetch_array($table))
{
	
	$ary[]=$row;
}
   echo json_encode($ary);
//  echo $cus_uid;
?>
