<?php

require_once('weixin.class.php');
$weixin = new class_weixin();


if (!isset($_GET["code"])){	
	$redirect_url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	$jumpurl = $weixin->oauth2_authorize($redirect_url, "snsapi_base","0");	
	Header("Location: $jumpurl");
}else{
	$access_token_oauth2 = $weixin->oauth2_access_token($_GET["code"]);
	$userId = $access_token_oauth2['UserId'];
	$openId = $access_token_oauth2['OpenId'];
	$deviceId = $access_token_oauth2['DeviceId'];
}
	
?>