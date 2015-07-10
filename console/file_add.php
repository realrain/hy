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
<title>Product Block Scheme</title>

<link href="images/skin.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #EEF2FB;
}
.gridViewItem {
	BORDER-RIGHT: #bad6ec 1px solid; BORDER-TOP: #bad6ec 1px solid; BORDER-LEFT: #bad6ec 1px solid; LINE-HEIGHT: 32px; BORDER-BOTTOM: #bad6ec 1px solid; TEXT-ALIGN: center
}
.STYLE1 {color: #FF0000}
.STYLE2 {color: #666666}
-->
</style>
<script>
function chk(){
	if(document.getElementById("name").value==''){
		alert("请填写名称！");
		document.getElementById("name").focus();
		return false;
	}
	return true;
}
</script>
<body>
<?php
if(!empty($_GET["fid"])&&is_numeric($_GET["fid"])){
  $sql="select * from hy_product where id=".$_GET["fid"];
  $rs=mysql_query($sql,$conn);
  $row=mysql_fetch_assoc($rs);
}else{
  msg('参数不正确！');
  jump($_SERVER['HTTP_REFERER']);
}
?>
<table width="100%" height="393" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="17" valign="top" background="images/mail_leftbg.gif"><img src="images/left-top-right.gif" width="17" height="29" /></td>
    <td valign="top" background="images/content-bg.gif"><table width="100%" height="31" border="0" cellpadding="0" cellspacing="0" class="left_topbg" id="table2">
      <tr>
        <td height="31"><div class="titlebt">产品附件</div></td>
      </tr>
    </table></td>
    <td width="16" valign="top" background="images/mail_rightbg.gif"><img src="images/nav-right-bg.gif" width="16" height="29" /></td>
  </tr>
  <tr>
    <td height="345" valign="middle" background="images/mail_leftbg.gif">&nbsp;</td>
    <td valign="top" bgcolor="#F7F8F9"><p>&nbsp;</p>
      <table width="85%" height="144" border="0" align="center" cellpadding="0" cellspacing="0" class="line_table">
        <tr>
          <td width="2%" height="27" background="images/news-title-bg.gif"><img src="images/news-title-bg.gif" width="2" height="27"></td>
          <td width="98%" background="images/news-title-bg.gif" class="left_bt2">添加附件</td>
        </tr>
        <tr>
          <td height="102" valign="top">&nbsp;</td>
          <td height="102" valign="top"><p>&nbsp;</p>
          <form action="add_do.php" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return chk();">
            <table width="678" height="185" border="0" cellpadding="0" cellspacing="0">
             <tr>
               <td align="center">产品ID：</td>
               <td>&nbsp;</td>
               <td height="37"><?php echo $row['id']; ?></td>
             </tr>
             <tr>
               <td align="center">产品名称：</td>
               <td>&nbsp;</td>
               <td height="37"><?php echo $row['name']; ?></td>
             </tr>
             <tr>
                <td align="center">附件名称：</td>
                <td>&nbsp;</td>
                <td height="37">
                  <input name="name" type="text" id="name" size="37" /></td>
              </tr>
              <tr>
                <td width="122" height="30" align="center">文件：</td>
                <td width="10">&nbsp;</td>
                <td width="537" height="37">
                  <input name="file" type="file" id="file" size="37" />
                  <input name="type" type="hidden" id="type" value="file" />
                  <input name="fid" type="hidden" id="fid" value="<?php echo $_GET["fid"] ?>" />                  </td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td height="37"><table width="245" height="24" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td align="center"><input type="submit" name="button3" id="button3" value="提交" /></td>
                    <td align="center"><input type="reset" name="button3" id="button4" value="重置" /></td>
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