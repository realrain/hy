<?php
@session_start();
	if(!isset($_SESSION["hy_user"])||!isset($_SESSION["hy_uid"])||!isset($_SESSION["hy_utype"])){
	echo "<script>alert('您未登陆！')</script>";
	echo "<script language='javascript'>window.location.href='index.php'</script>";
	exit();
}
?>