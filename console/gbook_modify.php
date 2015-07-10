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
.STYLE1 {color: #FF0000}
#preview{
	display:none;
	position:absolute;
}
-->
</style>
</head>
<body>
<?php
if(isset($_GET["id"])&&is_numeric($_GET["id"])){
	$sql="select * from hy_guestbook where id=".$_GET["id"];
	$rs=mysql_query($sql,$conn);
	$row=mysql_fetch_assoc($rs);
}
?>
<table width="99%" height="393" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="17" valign="top" background="images/mail_leftbg.gif"><img src="images/left-top-right.gif" width="17" height="29" /></td>
    <td valign="top" background="images/content-bg.gif"><table width="100%" height="31" border="0" cellpadding="0" cellspacing="0" class="left_topbg" id="table2">
      <tr>
        <td height="31"><div class="titlebt">回复留言</div></td>
      </tr>
    </table></td>
    <td width="16" valign="top" background="images/mail_rightbg.gif"><img src="images/nav-right-bg.gif" width="16" height="29" /></td>
  </tr>
  <tr>
    <td height="345" valign="middle" background="images/mail_leftbg.gif">&nbsp;</td>
    <td valign="top" bgcolor="#F7F8F9"><p>&nbsp;</p>
    <form id="form1" name="form1" method="post" action="modify_do.php">
      <table width="97%" height="413" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC" class="line_table">
        
        <tr>
          <td width="92" height="32" align="center" bgcolor="#FFFFFF">标题：</td>
          <td width="272" height="32" bgcolor="#FFFFFF"><?php echo $row['title'] ?></td>
          <td width="78" align="center" bgcolor="#FFFFFF">姓名：</td>
          <td width="537" bgcolor="#FFFFFF"><?php echo $row['name'] ?></td>
        </tr>
        
        <tr>
          <td height="32" align="center" bgcolor="#FFFFFF">邮箱：</td>
          <td height="32" bgcolor="#FFFFFF"><?php echo $row['email'] ?></td>
          <td align="center" bgcolor="#FFFFFF">显示/隐藏：</td>
          <td bgcolor="#FFFFFF">
          <input name="is_show" type="radio" value="1"<?php echo $row["is_show"]==1?" checked=\"checked\"":"" ?> />
                  显示 
                  <input name="is_show" type="radio" value="0"<?php echo $row["is_show"]==0?" checked=\"checked\"":"" ?> />
                  隐藏          </td>
        </tr>
        
        <tr>
          <td height="32" align="center" bgcolor="#FFFFFF">提交时间：</td>
          <td height="32" bgcolor="#FFFFFF"><?php echo $row['create_time'] ?></td>
          <td align="center" bgcolor="#FFFFFF">IP：</td>
          <td bgcolor="#FFFFFF"><?php echo $row['ip'] ?></td>
        </tr>
        <tr>
          <td height="32" align="center" bgcolor="#FFFFFF">留言内容：</td>
          <td height="32" colspan="3" bgcolor="#FFFFFF"><?php echo $row['contents'] ?></td>
          </tr>
        <tr>
          <td height="201" align="center" bgcolor="#FFFFFF">回复：</td>
          <td height="201" colspan="3" bgcolor="#FFFFFF"><textarea name="reply_content" id="reply_content" cols="99" rows="13"></textarea>
          <input name="id" type="hidden" id="id" value="<?php echo $row["id"] ?>" />
          <input name="type" type="hidden" id="type" value="gbook" /></td>
        </tr>
        <tr>
          <td height="75" align="center" bgcolor="#FFFFFF">&nbsp;</td>
          <td height="75" colspan="3" bgcolor="#FFFFFF"><input type="submit" name="button" id="button" value="提交" /></td>
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