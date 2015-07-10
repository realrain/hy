<?php
header("Content-type: text/html; charset=utf-8");

include_once("inc/function.php");

if(empty($_POST)&&empty($_GET)){
	msg('Error：Invalid Request!');
	if(!empty($_SERVER['HTTP_REFERER'])){
		jump($_SERVER['HTTP_REFERER']);
	}else{
		jump("index.php");
	}
	exit;
}

include_once("inc/config.php");
include_once("inc/conn.php");

$email=myfilter($_POST["email"],3);

$rule="/^([a-zA-Z0-9]+[_|\-|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\-|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,5}$/";
$test="106770950@qq.cn.com.jpppp";
$result=preg_match($rule,$test);
if(!$result){
	msg("请输入正确的电子邮件地址");
	if(!empty($_SERVER['HTTP_REFERER'])){
		jump($_SERVER['HTTP_REFERER']);
	}else{
		jump("index.php");
	}
}

$sql="select id from hy_email where email='".$email."'";
$rs=mysql_query($sql,$conn);
if(mysql_num_rows($rs)>0){	
	msg("此电子邮件已存在");
	if(!empty($_SERVER['HTTP_REFERER'])){
		jump($_SERVER['HTTP_REFERER']);
	}else{
		jump("index.php");
	}
}

$sql="insert into hy_email(email,create_time,ip)values('".$email."','".date('Y-m-d H:i:s')."','".$_SERVER['REMOTE_ADDR']."')";
if(mysql_query($sql,$conn)){
	msg("感谢您的订阅！");	
}else{
	msg("数据写入出错：".mysql_error());
}

mysql_close($conn);

if(!empty($_SERVER['HTTP_REFERER'])){
	jump($_SERVER['HTTP_REFERER']);
}else{
	jump("index.php");
}
?>