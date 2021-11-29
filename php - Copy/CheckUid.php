<?php
$FrgtNme=$_GET["ForgotPasswordName"];
include_once("connection.php");
$query="select * from users where uid='$FrgtNme'";
$table=mysqli_query($dbCon,$query);//0-1
if(mysqli_num_rows($table)==1)
{ 
  echo "NOT VALID USERNAME";

}
else
	echo "VALID USERNAME";



?>
