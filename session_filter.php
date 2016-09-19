<?php
/*
 * 检查是否用户是否存在session中，如果不存在，就通过企业号获取用户的userId
 */
	$projectName = "PublicWelfare";
	$errorUrl = 'http://'.$_SERVER['HTTP_HOST'].'/'.$projectName."/error.php";
 	$url = $_GET['url'];
 	session_start();
 	$user = $_SESSION['user'];
 	if($url && $url != ""){//如果get到了url，说明是用户从微信按钮点进来的
 		if($user){
	 		header("Location:".$url);
	 	}else{
	 		header("Location:user_filter.php?url=".$url);
	 	}
 	}
 	else{//大概是被用户require进来了
 		if(!$user){
 			//header("Location:".$errorUrl."?error_code=101");         
	 	}
 	}
?>