<?php
	include_once("connection.php");
$uid=$_GET["user-uid"];
$action=$_GET["action"];
$category=$_GET["category"];
if($action=="block")
{
    $query="update users set status=0 where uid='$uid'";
    mysqli_query($dbCon,$query);
}
else
{
     if($action=="resume")
    {
        $query="update users set status=1 where uid='$uid'";
        mysqli_query($dbCon,$query);
    }
else
{
    $query="delete from users where uid='$uid'";
    mysqli_query($dbCon,$query);
    if($category=="citizens")
    {
        $query="delete from citizens where uid='$uid'";
        mysqli_query($dbCon,$query);
    }
    else{
        $query="delete from workers where uid='$uid'";
        mysqli_query($dbCon,$query);
    }
}

}
?>
