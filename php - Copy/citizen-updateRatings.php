<?php
include_once("connection.php");
$username=$_GET["username"];
$rating=$_GET["rating"];
$rid=$_GET["rid"];
$update="update workers set total=total+'$rating',count=count+1 where uid='$username'"; 
$delete="delete from ratings where rid='$rid'" ;
mysqli_query($dbCon,$update);
mysqli_query($dbCon,$delete);
?>