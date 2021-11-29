<?php
	include_once("connection.php");
$category=$_GET["category"];
if($category=="citizens")
{
    $query="select * from citizens order by name";
}
else
{
    $query="select * from workers order by name"; 
}
$table=mysqli_query($dbCon,$query);

$ary=array();//JSON-1

while($row=mysqli_fetch_array($table))
{
	
	$ary[]=$row;
}
echo json_encode($ary);
?>
