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
<title>管理员</title>

<link href="images/skin.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #EEF2FB;
}
.STYLE1 {color: #FF00FF}
td {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 14px;
	letter-spacing: 3px;
}
.STYLE3 {color: #FF0000}
-->
</style>
<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
</head>
<body>
<?php
$query="select * from hy_admin where id=".$_SESSION["hy_uid"];
$rs=mysql_query($query,$conn);
$row=mysql_fetch_assoc($rs);
?>
<table width="100%" height="343" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="17" valign="top" background="images/mail_leftbg.gif"><img src="images/left-top-right.gif" width="17" height="29" /></td>
    <td valign="top" background="images/content-bg.gif"><table width="100%" height="31" border="0" cellpadding="0" cellspacing="0" class="left_topbg" id="table2">
      <tr>
        <td height="31"><div class="titlebt">我的信息</div></td>
      </tr>
    </table></td>
    <td width="16" valign="top" background="images/mail_rightbg.gif"><img src="images/nav-right-bg.gif" width="16" height="29" /></td>
  </tr>
  <tr>
    <td height="295" valign="middle" background="images/mail_leftbg.gif">&nbsp;</td>
    <td valign="top" bgcolor="#F7F8F9"><p>&nbsp;</p>
      <table width="89%" height="259" border="0" align="center" cellpadding="0" cellspacing="0" class="line_table">
        <tr>
          <td width="2%" height="27" background="images/news-title-bg.gif"><img src="images/news-title-bg.gif" width="2" height="27"></td>
          <td width="98%" background="images/news-title-bg.gif" class="left_bt2">修改备注</td>
        </tr>
        <tr>
          <td height="213" valign="top">&nbsp;</td>
          <td height="213" valign="top"><p>&nbsp;</p>
          <form id="form1" name="form1" method="post" action="modify_do.php">
          <input name="type" type="hidden" id="type" value="myRemark" />
          <input id="editor" name="editor" type="hidden" value="<?php echo $_SESSION["hy_uid"] ?>" />
            <table width="1128" height="139" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td height="35" align="center">用户名：</td>
              <td>&nbsp;</td>
              <td height="37"><?php echo $row["name"] ?></td>
            </tr>
            <tr>
                <td width="136" height="35" align="center">备注：</td>
                <td width="16">&nbsp;</td>
                <td width="976" height="37"><input name="remark" type="text" id="remark" style="width:377px" value="<?php echo $row["remark"] ?>" /></td>
              </tr>
              
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td height="65"><table width="245" height="24" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td align="center"><input type="submit" name="button3" id="button3" value="提交" class="form_btn" /></td>
                    <td align="center"><input type="reset" name="button3" id="button4" value="重置" class="form_btn" /></td>
                  </tr>
                </table></td>
              </tr>
            </table>            
          </form>
          <p>&nbsp;</p></td>
        </tr>
        <tr>
          <td height="5" colspan="2">&nbsp;</td>
        </tr>
      </table>
    </td>
    <td background="images/mail_rightbg.gif">&nbsp;</td>
  </tr>
  <tr>
    <td valign="bottom" background="images/mail_leftbg.gif"><img src="images/buttom_left2.gif" width="17" height="17" /></td>
    <td background="images/buttom_bgs.gif"><img src="images/buttom_bgs.gif" width="17" height="17"></td>
    <td valign="bottom" background="images/mail_rightbg.gif"><img src="images/buttom_right2.gif" width="16" height="17" /></td>
  </tr>
</table>
</body>
</html>