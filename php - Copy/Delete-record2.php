<?php
	include_once("connection.php");
$uid=$_GET["user-uid"];
$category=$_GET["category"];

    if($category=="ctzns")
    {
        $query="delete from citizens where uid='$uid'";
    }
    else
    {
        $query="delete from workers where uid='$uid'"; 
    }
}
mysqli_query($dbCon,$query);

?>
