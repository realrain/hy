<?php
include_once("../inc/session_check.php");
include_once("../inc/function.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>lvc</title>
<link href="images/skin.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #EEF2FB;
}
.info{
	padding-left: 7px;
	color: #3C5C75;
}
-->
</style>
<body>
<table width="100%" height="393" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="17" valign="top" background="images/mail_leftbg.gif"><img src="images/left-top-right.gif" width="17" height="29" /></td>
    <td valign="top" background="images/content-bg.gif"><table width="100%" height="31" border="0" cellpadding="0" cellspacing="0" class="left_topbg" id="table2">
      <tr>
        <td height="31"><div class="titlebt">网站概况</div></td>
      </tr>
    </table></td>
    <td width="16" valign="top" background="images/mail_rightbg.gif"><img src="images/nav-right-bg.gif" width="16" height="29" /></td>
  </tr>
  <tr>
    <td height="345" valign="middle" background="images/mail_leftbg.gif">&nbsp;</td>
    <td valign="top" bgcolor="#F7F8F9"><p>&nbsp;</p>
      <table width="89%" height="144" border="0" align="center" cellpadding="0" cellspacing="0" class="line_table">
        <tr>
          <td width="2%" height="27" background="images/news-title-bg.gif"><img src="images/news-title-bg.gif" width="2" height="27"></td>
          <td width="98%" background="images/news-title-bg.gif" class="left_bt2">主机信息</td>
        </tr>
        <tr>
          <td height="102" valign="top">&nbsp;</td>
          <td height="102" valign="top"><p>&nbsp;</p>
            <table width="572" height="225" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC" id="bsinfo">
            <tr>
              <td width="140" bgcolor="#FFFFFF" class="info">网站IP：</td>
              <td width="429" height="27" align="center" bgcolor="#FFFFFF"><?php echo $_SERVER['SERVER_ADDR'] ?></td>
            </tr>
            <tr>
              <td bgcolor="#FFFFFF" class="info">网站端口：</td>
              <td height="27" align="center" bgcolor="#FFFFFF"><?php echo $_SERVER['SERVER_PORT'] ?></td>
            </tr>
            <tr>
              <td bgcolor="#FFFFFF" class="info">网站主机名：</td>
              <td height="27" align="center" bgcolor="#FFFFFF"><?php echo $_SERVER['SERVER_NAME'] ?></td>
            </tr>           
            <tr>
              <td bgcolor="#FFFFFF" class="info">物理地址：</td>
              <td height="27" align="center" bgcolor="#FFFFFF"><?php echo $_SERVER['DOCUMENT_ROOT'] ?></td>
            </tr>
            
            <tr>
              <td bgcolor="#FFFFFF" class="info">你的IP：</td>
              <td height="27" align="center" bgcolor="#FFFFFF"><?php echo $_SERVER['REMOTE_ADDR'] ?></td>
            </tr>
            <tr>
              <td bgcolor="#FFFFFF" class="info">你的端口：</td>
              <td height="27" align="center" bgcolor="#FFFFFF"><?php echo $_SERVER['REMOTE_PORT'] ?></td>
            </tr>
            <tr>
              <td bgcolor="#FFFFFF" class="info">你的浏览器：</td>
              <td height="27" align="center" bgcolor="#FFFFFF">
			  <script language="javascript" type="text/javascript">
        document.write(navigator.appName);
          </script></td>
            </tr>
            <tr>
              <td bgcolor="#FFFFFF" class="info">屏幕分辨率：</td>
              <td height="27" align="center" bgcolor="#FFFFFF">
              <script language="javascript" type="text/javascript">
        document.write(window.screen.width+" x "+window.screen.height);
          </script>
              </td>
            </tr>
             <tr>
              <td bgcolor="#FFFFFF" class="info">表单提交最大数值：</td>
              <td height="27" align="center" bgcolor="#FFFFFF"><?php echo ini_get('post_max_size'); ?></td>
            </tr>
            <tr>
              <td bgcolor="#FFFFFF" class="info">上传文件最大值：</td>
              <td height="27" align="center" bgcolor="#FFFFFF"><?php echo ini_get('upload_max_filesize'); ?></td>
            </tr>          
          </table>
          <p>&nbsp;</p></td>
        </tr>
        <tr>
          <td height="5" colspan="2">&nbsp;</td>
        </tr>
      </table>      <p>&nbsp;</p></td>
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