<?php
/*
 * 当session中没有user信息时，说明用户在一段时间中第一次登陆了系统，则检查用户是否存在于数据库中。
 * 如果用户存在，将其存入session。
 * 如果用户不存在，转入error页面。
 */
$projectName = "PublicWelfare";
require_once('weixin.class.php');
require_once('database_advanced.php');
$url = $_GET['url'];

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
	if($userId){//用户绑定了企业号
	    $memberDB=new memberDB();
	    $checkline=$memberDB->select_member_by_userId($userId);
		if($checkline){//数据库中有该userId的记录
			session_start();
			$_SESSION['user']=mysql_fetch_array($checkline);
			header("Location:".$url);
		}else{//数据库中没有该userId的记录,添加user记录
		    $result=$memberDB->insert_new_member($userId);
		    session_start();
			$_SESSION['user'] = mysql_fetch_array($memberDB->select_member_by_userId($userId));
			echo '新用户你好，请到个人主页填写完整信息';
			header("Location:".$url);
			//header("Location:error.php?error_code=100");
		}
	}else{//用户没绑定企业号
		echo 'not bounded';
		header("Location:error.php?error_code= 100");
	}
