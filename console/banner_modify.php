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
<title>网站横幅图修改</title>

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
html { overflow-x:hidden; }
.STYLE1 {color: #FF0000}
.gridViewItem {	BORDER-RIGHT: #bad6ec 1px solid; BORDER-TOP: #bad6ec 1px solid; BORDER-LEFT: #bad6ec 1px solid; LINE-HEIGHT: 32px; BORDER-BOTTOM: #bad6ec 1px solid; TEXT-ALIGN: center
}
.STYLE2 {color: #666666}
-->
</style>
</head>
<body>
<?php
if(!empty($_GET["id"])&&is_numeric($_GET["id"])){
	$sql="select * from hy_banner where id=".$_GET["id"];
	$rs=mysql_query($sql,$conn);
	$row=mysql_fetch_assoc($rs);
}
?>
<table width="100%" height="393" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="17" valign="top" background="images/mail_leftbg.gif"><img src="images/left-top-right.gif" width="17" height="29" /></td>
    <td valign="top" background="images/content-bg.gif"><table width="100%" height="31" border="0" cellpadding="0" cellspacing="0" class="left_topbg" id="table2">
      <tr>
        <td height="31"><div class="titlebt">修改轮播图</div></td>
      </tr>
    </table></td>
    <td width="16" valign="top" background="images/mail_rightbg.gif"><img src="images/nav-right-bg.gif" width="16" height="29" /></td>
  </tr>
  <tr>
    <td height="345" valign="middle" background="images/mail_leftbg.gif">&nbsp;</td>
    <td valign="top" bgcolor="#F7F8F9"><p>&nbsp;</p>
     <form action="modify_do.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
      <table width="731" height="362" border="0" align="center" cellpadding="0" cellspacing="0" class="line_table">
        
        <tr>
          <td width="99" height="137" align="center">当前图片：</td>
          <td width="529" height="137"><a href="../uploads/<?php echo getPath($row['pic'],'banner'); ?>" target="_blank"><img src="../uploads/<?php echo getPath($row['pic'],'banner'); ?>" width="420" height="225" /></a></td>
        </tr>
        <tr>
          <td height="46" align="center">新图片：            </td>
          <td height="46"><input name="pic" type="file" id="pic" size="60" />
             <input name="type" type="hidden" id="type" value="banner" />
              <input name="id" type="hidden" id="id" value="<?php echo $row["id"] ?>" />
            <input name="old_pic" type="hidden" value="<?php echo $row["pic"] ?>" /></td>
        </tr>
        
        <tr>
          <td height="58" align="center">链接地址：</td>
          <td valign="middle"><input name="link" type="text" id="link" value="<?php echo $row["link"] ?>" size="77" /></td>
        </tr>
        
        
        <tr>
          <td height="5" colspan="2" align="center"><table width="245" height="38" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td align="center"><input type="submit" name="button" id="button" value="提交" /></td>
              <td align="center"><input type="reset" name="button2" id="button2" value="重置" /></td>
            </tr>
          </table></td>
        </tr>
      </table>
      </form>
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