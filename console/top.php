<?php
include_once("../inc/session_check.php");
include_once("../inc/function.php");
include_once("../inc/config.php");
include_once("../inc/conn.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>TOP</title>
<style type="text/css">
<!--
.STYLE1 {
	color: #FFFF00;	
}
.STYLE2 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 16px;
}
-->
</style>
</head>
<script language=JavaScript>
function logout(){
	if (confirm("您确定要退出吗？")){
		top.location="logout.php";
		return false;
	}
}
</script>
<base target="main">
<link href="images/skin.css" rel="stylesheet" type="text/css">
</head>
<body leftmargin="0" topmargin="0">
<?php $rs=mysql_query("select * from hy_admin where id=".$_SESSION["hy_uid"]);$row=mysql_fetch_assoc($rs) ?>
<table width="100%" height="64" border="0" cellpadding="0" cellspacing="0" class="admin_topbg">
  <tr>
    <td width="30%" height="64" valign="top"><!--<img src="images/logo.gif" width="262" height="64" />--></td>
    <td width="70%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="88%" height="38" class="admin_txt STYLE2">欢迎！
管理员：<b><span class="STYLE1"><?php echo $_SESSION["hy_user"] ?></span></b> 上次登录时间：<span class="STYLE1"><?php echo $row['last_time']!=""?date("Y-m-d H:i:s",$row['last_time']):"" ?></span> 上次登录IP：<span class="STYLE1"><a href="http://ip.chinaz.com/?IP=<?php echo $row["last_ip"] ?>" target="_blank" style="color: #FFFF00;text-decoration: underline"><?php echo $row["last_ip"] ?></a></span> 类型：<span class="STYLE1"><?php echo $row["type"]==1?"超级管理员":"" ?><?php echo $row["type"]==2?"普通管理员":"" ?></span></td>
        <td width="5%"><a onClick="logout();"><img src="images/out.gif" alt="安全退出" width="46" height="20" border="0"></a></td>
        <td width="7%">&nbsp;</td>
      </tr>
      <tr>
        <td height="19" colspan="3">&nbsp;</td>
        </tr>
    </table></td>
  </tr>
</table>
</body>
</html>