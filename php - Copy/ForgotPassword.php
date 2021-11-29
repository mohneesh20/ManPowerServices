<?php
$FrgtNme=$_GET["ForgotPasswordName"];
include_once("connection.php");
include_once("SMS_OK_sms.php");
$query="select * from users where uid='$FrgtNme'";
$table=mysqli_query($dbCon,$query);//0-1
if(mysqli_num_rows($table)==1)
{ $row=mysqli_fetch_array($table);
  $mobile=9417645315;
  $msg="Hi";
  SendSMS($mobile,$msg);
  echo $msg;

}
else
	echo "NOT VALID USERNAME";



?>
