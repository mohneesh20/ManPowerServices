<?php
include_once("connection.php");
$btn=$_POST["btn3"];
if($btn=="save")
    doSave($dbCon);
else
    doUpdate($dbCon);
function doSave($dbCon)
{

$uid=$_POST["inputUsrname"];
$CitName=$_POST["CitName"];
$contactNumber=$_POST["inputContactNumber4"];
$email=$_POST["inputEmail4"];
$address=$_POST["inputAddress"];
$city=$_POST["inputCity"];
$state=$_POST["State"];
	
$orgName=$_FILES["inputProfilePic"]["name"];
$tmpName=$_FILES["inputProfilePic"]["tmp_name"];
$query="insert into citizens values('$uid','$CitName','$contactNumber','$email','$address','$city','$state','$orgName')";
mysqli_query($dbCon,$query);
$msg=mysqli_error($dbCon);
if($msg=="")
{
	move_uploaded_file($tmpName,"uploads/".$orgName);
	echo "<h2>You are signed up successfully...</h2>";
}
else
	echo $msg;
}
function doUpdate($dbCon)
{
$uid=$_POST["userid"];
$CitName=$_POST["CitName"];
$contactNumber=$_POST["inputContactNumber4"];
$email=$_POST["inputEmail4"];
$address=$_POST["inputAddress"];
$city=$_POST["inputCity"];
$state=$_POST["State"];
$hdn=$_POST["hdn"];	
$orgName=$_FILES["inputProfilePic"]["name"];
$tmpName=$_FILES["inputProfilePic"]["tmp_name"];

	
	if($orgName=="")//means user do not want to change the pic
	{
		$fileName=$hdn;//hdn contains the name of old pic
	}
	else //user want to change the pic
	{
		$fileName=$orgName;//new name assigned
		move_uploaded_file($tmpName,"uploads/".$orgName);
	}
	//record updated
$query="update citizens set name='$CitName',email='$email',contact='$contactNumber',address='$address',city='$city',state='$state',picname='$fileName' where uid='$uid'";
mysqli_query($dbCon,$query);
$msg=mysqli_error($dbCon);
if($msg=="")
{
	
	echo "<h2>Record Updated successfully...</h2>";
}
else
	echo $msg;
}
?>
