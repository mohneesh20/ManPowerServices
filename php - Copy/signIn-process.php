<?php
session_start();
$LoginName=$_GET["loginName"];
$LoginPassword=$_GET["loginPassword"];
include_once("connection.php");
$query="select * from users where uid='$LoginName'";
$table=mysqli_query($dbCon,$query);

		if(mysqli_num_rows($table)==1)
		{
			$row=mysqli_fetch_array($table);
			$spwd=$row["password"];
			$status=$row["status"];
			$category=$row["category"];
            if($status==0)
            {
                echo "BLOCKED USER";
            }
            else
            {
                if($spwd==$LoginPassword)
            {
                echo $category;
                $_SESSION["activeuser"]=$LoginName;
            }
            else{
                echo "INVALID PASSWORD";
            }
            }
            
		}
	else
	{
        
            echo "INVALID USERNAME";
		    return;
        
	}
    ?>
