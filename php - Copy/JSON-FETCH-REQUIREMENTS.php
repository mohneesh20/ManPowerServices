<?php
	include_once("connection.php");
$cus_uid=$_GET["cus_uid"];
$query="select * from requirements where cus_uid='$cus_uid'" ;
$table=mysqli_query($dbCon,$query);

$ary=array();

while($row=mysqli_fetch_array($table))
{
	
	$ary[]=$row;
}
echo json_encode($ary);
?>
