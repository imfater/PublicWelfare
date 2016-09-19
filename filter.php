<?php
require('database_advanced.php');
date_default_timezone_set('PRC');

	$userId = $_GET['userId'];
	$memberDB = new memberDB();
	$result = $userDB->select_user_by_userId($userId);
	$user = mysql_fetch_array($result);
	if($user!= null){
		session_start();
		$_SESSION['user'] = $user;
		header("Location: view/main2.php"); 
		exit;
	}
	else{
		$result = $userDB->insert_userId($userId);
		header("Location: view/main2.php"); 
	}
?>
