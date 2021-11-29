<?php
include_once("SMS_OK_sms.php");

$mobile=$_GET["mobile"];
$msg=$mobile/10000;

$msg=SendSMS($mobile,$msg);
echo $msg;
?>