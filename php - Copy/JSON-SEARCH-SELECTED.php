 <?php
	include_once("connection.php");
$category=$_GET["category"];
$city=$_GET["city"];
$query="select * from requirements where category='$category' and city='$city' and DATE_SUB(curdate(),INTERVAL 10 DAY)<=dop";
$table=mysqli_query($dbCon,$query);

$ary=array();

while($row=mysqli_fetch_array($table))
{
	
	$ary[]=$row;
}
echo json_encode($ary);
?>
