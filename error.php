<html>
<?php
	$error_code = $_GET['error_code'];
	define("E100", "抱歉，您不是成员！");
	define("E101", "非法路径。");
	
	if($error_code == "100"){
		$show = E100;	
	}
	if($error_code == "101"){
		$show = E101;	
	}
?>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<div style = "font-family: 'Microsoft Yahei';
 	font-size: 20px;
    text-align: center;        /*文字水平居中对齐*/
    overflow:hidden;">
	<?php echo "~~~~(>_<)~~~~"; ?>
</div>
<div style = "font-family: 'Microsoft Yahei';
 	font-size: 20px;
    text-align: center;        /*文字水平居中对齐*/
    line-height: 200px;        /*设置文字行距等于div的高度*/
    overflow:hidden;">
	<?php echo $show;?>
</div>
</body>
</html>