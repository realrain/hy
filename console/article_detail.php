<?php
include_once("../inc/session_check.php");
include_once("../inc/config.php");
include_once("../inc/conn.php");
include_once("../inc/function.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Article</title>
<link href="images/skin.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="css/le-frog/jquery-ui-1.8.20.custom.css" rel="stylesheet" />
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #EEF2FB;
}
.STYLE4 {
	color: #999999;
}
#preview{
	display:none;
	position:absolute;
}
-->
</style>
<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
</head>
<body>
<?php
if(isset($_GET["id"])&&is_numeric($_GET["id"])){
	$sql="select * from hy_article where id=".$_GET["id"];
	$rs=mysql_query($sql,$conn);
	$row=mysql_fetch_assoc($rs);
}
?>
<table width="99%" height="393" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="17" valign="top" background="images/mail_leftbg.gif"><img src="images/left-top-right.gif" width="17" height="29" /></td>
    <td valign="top" background="images/content-bg.gif"><table width="100%" height="31" border="0" cellpadding="0" cellspacing="0" class="left_topbg" id="table2">
      <tr>
        <td height="31"><div class="titlebt">详细信息</div></td>
      </tr>
    </table></td>
    <td width="16" valign="top" background="images/mail_rightbg.gif"><img src="images/nav-right-bg.gif" width="16" height="29" /></td>
  </tr>
  <tr>
    <td height="345" valign="middle" background="images/mail_leftbg.gif">&nbsp;</td>
    <td valign="top" bgcolor="#F7F8F9"><p>&nbsp;</p>
     <form action="add_do.php" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return chk();">
       <table width="99%" border="0" align="center" cellpadding="0" cellspacing="0" class="line_table">
         <tr>
           <td width="104" height="32" align="center">所属栏目：</td>
           <td width="1011" height="32">
<?php
$sql1="select * from hy_category where id=".$row["fid"];
$rs1=mysql_query($sql1,$conn);
$row1=mysql_fetch_assoc($rs1);
mysql_free_result($rs1);

if($row1["fid"]>0){	
	$sql2="select * from hy_category where id=".$row1["fid"];
	$rs2=mysql_query($sql2,$conn);
	$row2=mysql_fetch_assoc($rs2);
	mysql_free_result($rs2);
	if($row2["fid"]>0){
		$sql3="select * from hy_category where id=".$row2["fid"];
		$rs3=mysql_query($sql3,$conn);
		$row3=mysql_fetch_assoc($rs3);
		mysql_free_result($rs3);
		echo $row3["name"]." <font color='gray'>>></font> ".$row2["name"]." <font color='gray'>>></font> ".$row1["name"];
	}else{
		echo $row2["name"]." <font color='gray'>>></font> ".$row1["name"];
	}
}else{
	echo $row1["name"];
}
?>           </td>
         </tr>
         
         <tr>
           <td height="32" align="center">标题：</td>
           <td height="32"><?php echo $row["title"]?></td>
         </tr>
         <tr>
           <td height="32" align="center">发布者：</td>
           <td height="32"><?php echo $row["poster"]?></td>
         </tr>
         <tr>
           <td height="154" align="center">详细内容：</td>
           <td valign="middle"><?php echo $row["contents"]?></td>
         </tr>
       </table>
      </form>
    <p>&nbsp;</p></td>
    <td background="images/mail_rightbg.gif">&nbsp;</td>
  </tr>
  <tr>
    <td valign="bottom" background="images/mail_leftbg.gif"><img src="images/buttom_left2.gif" width="17" height="17" /></td>
    <td background="images/buttom_bgs.gif"><img src="images/buttom_bgs.gif" width="17" height="17"></td>
    <td valign="bottom" background="images/mail_rightbg.gif"><img src="images/buttom_right2.gif" width="16" height="17" /></td>
  </tr>
</table>
<?php
mysql_free_result($rs);
mysql_close($conn);
?>
</body>
</html>