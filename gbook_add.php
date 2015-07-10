<?php
include_once("inc/function.php");
include_once("inc/config.php");
include_once("inc/conn.php");

$name=myfilter($_POST["name"],3);
$email=myfilter($_POST["email"],3);
$title=myfilter($_POST["title"],3);
$contents=myfilter($_POST["contents"],3);

$sql="insert into hy_guestbook(name,email,title,contents,ip,create_time)values('".$name."','".$email."','".$title."','".$contents."','".$_SERVER['REMOTE_ADDR']."','".date('Y-m-d H:i:s')."')";
if(mysql_query($sql,$conn)){
	echo 'goal';
}else{
	exit(mysql_error());
}
mysql_close($conn);
?>