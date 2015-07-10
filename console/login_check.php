<?php 
session_start();
if($_POST['client_name']==""||$_POST['client_password']==""){
	exit("用户名或者密码不能为空！");
}

if(strtolower($_POST['client_code'])!=strtolower($_SESSION["codepicx"])){
	exit("验证码不正确！");
}

include_once("../inc/config.php");
include_once("../inc/conn.php");
$name=$_POST['client_name'];
$pass=md5($_POST['client_password']);//接收数据

$query="select id from hy_admin where name='".$name."'";//检查用户名
$rs=mysql_query($query,$conn);
	if(mysql_num_rows($rs)==0){
		mysql_free_result($rs);
		mysql_close($conn);
		exit("用户名不存在!");
	}
	
$query="select * from hy_admin where name='".$name."' and psw='".$pass."'";//检测密码

$rs=mysql_query($query,$conn);
if(mysql_num_rows($rs)==0){
	mysql_free_result($rs);
	mysql_close($conn);
	exit("密码不正确!");
}

$row=mysql_fetch_assoc($rs);
	
echo "登陆成功!";

$_SESSION["hy_user"]=$row["name"];//Set Session Value
$_SESSION["hy_uid"]=$row["id"];
$_SESSION["hy_utype"]=$row["type"];

$sql="update hy_admin set last_time=".$row["now_time"].",last_ip='".$row["now_ip"]."' where id=".$row["id"];
mysql_query($sql);//新旧交换

$sql="update hy_admin set now_time=".time().",now_ip='".$_SERVER['REMOTE_ADDR']."' where id=".$row["id"];
mysql_query($sql);//将当前信息写入

mysql_free_result($rs);
mysql_close($conn);
?>