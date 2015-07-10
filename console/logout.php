<?php session_start();?>
<?php
include_once("../inc/session_check.php");
include_once("../inc/function.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Logout</title>



</head>



<body>

<?php



if(isset($_SESSION["hy_user"])){
	unset($_SESSION["hy_user"]);
	jump("index.php");
}else{
	echo "<script>alert('你未登录====！')</script>";
	jump("index.php");
}
?>
</body>
</html>