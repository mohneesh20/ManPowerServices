<?php
include_once("connection.php");
$btn=$_POST["btn3"];
if($btn=="save")
    doSave($dbCon);
else
    if($btn=="update")
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
$shopname=$_POST["inputShopName"];
$category=$_POST["inputCategory"];
$spl=$_POST["inputSpl"];
$experience=$_POST["inputExp"];
	
$orgName=$_FILES["inputProfilePic"]["name"];
$tmpName=$_FILES["inputProfilePic"]["tmp_name"];
$orgName2=$_FILES["inputAadharPic"]["name"];    
$tmpName2=$_FILES["inputAadharPic"]["tmp_name"];
$query="insert into workers values('$uid','$CitName','$contactNumber','$email','$address','$city','$state','$shopname','$spl','$experience',0,0,'$category','$orgName','$orgName2')";
mysqli_query($dbCon,$query);
$msg=mysqli_error($dbCon);
if($msg=="")
{
	move_uploaded_file($tmpName,"uploads/".$orgName);
    move_uploaded_file($tmpName2,"uploads/".$orgName2);
	echo "<h2>You are signed up successfully...</h2>";
}
else
	echo $msg;
}
function doUpdate($dbCon)
{
$uid=$_POST["inputUsrname"];
$CitName=$_POST["CitName"];
$contactNumber=$_POST["inputContactNumber4"];
$email=$_POST["inputEmail4"];
$address=$_POST["inputAddress"];
$city=$_POST["inputCity"];
$state=$_POST["State"];
$shopname=$_POST["inputShopName"];
$category=$_POST["inputCategory"];
$spl=$_POST["inputSpl"];
$experience=$_POST["inputExp"];
$hdn=$_POST["hdn"];		
$hdn2=$_POST["hdn2"];		
$orgName=$_FILES["inputProfilePic"]["name"];
$tmpName=$_FILES["inputProfilePic"]["tmp_name"];
$orgName2=$_FILES["inputAadharPic"]["name"];    
$tmpName2=$_FILES["inputAadharPic"]["tmp_name"];

	
	if($orgName=="")
	{
		$fileName=$hdn;
	}
	else
	{
		$fileName=$orgName;
		move_uploaded_file($tmpName,"uploads/".$orgName);
	}
    if($orgName2=="")
	{
		$fileName2=$hdn2;
	}
	else 
	{
		$fileName2=$orgName2;
		move_uploaded_file($tmpName2,"uploads/".$orgName2);
	}

$query="update workers set name='$CitName',email='$email',contact='$contactNumber',address='$address',city='$city',state='$state',shopname='$shopname',spl='$spl',exp='$experience',category='$category',picname='$fileName',aadharpic='$fileName2' where uid='$uid'";
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
