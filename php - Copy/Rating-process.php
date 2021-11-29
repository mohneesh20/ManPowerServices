<?php
include_once("connection.php");
$uid=$_GET["cus_uid"];
$query="select * from ratings where cus_uid='$uid'";
$table=mysqli_query($dbCon,$query);

$ary=array();

while($row=mysqli_fetch_array($table))
{
	
	$ary[]=$row;
}
echo json_encode($ary);
?>