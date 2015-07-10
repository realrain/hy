<?php
include_once("../inc/session_check.php");
include_once("../inc/function.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加成功</title>

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
.STYLE2 {
	font-size: 24px;
	font-family: Georgia, Verdana, Arial, "Arial Narrow";
	padding-right: 3px;
	padding-left: 3px;
	color: #0E6FBE;
}
.STYLE4 {
	font-size: 18px;
	color: #FF0000;
}
-->
</style>
<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
<script language="javascript">
function go(x){
	window.location=x;
}
var t=3;
setInterval("testTime()",1000);
function testTime() 
{ 
	if(t == 0){
		location.href="scheme_add.php?fid=<?php echo $_GET["fid"] ?>";
	}
	$("#view").html("<span class=\"STYLE2\">"+t+"</span>秒后 跳转到 在当前产品下继续添加方框图"); // 显示倒计时 
	t--;
}
</script>
</head>
<body>
<table width="100%" height="393" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="17" valign="top" background="images/mail_leftbg.gif"><img src="images/left-top-right.gif" width="17" height="29" /></td>
    <td valign="top" background="images/content-bg.gif"><table width="100%" height="31" border="0" cellpadding="0" cellspacing="0" class="left_topbg" id="table2">
      <tr>
        <td height="31"><div class="titlebt">添加方框图</div></td>
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
          <td width="98%" background="images/news-title-bg.gif" class="left_bt2">方框图<span class="STYLE4">添加成功</span>！</td>
        </tr>
        <tr>
          <td height="102" valign="top">&nbsp;</td>
          <td height="102" valign="top"><p>&nbsp;</p>
            <table width="517" height="118" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td height="37" colspan="3" align="center"><span id="view"><span class="STYLE2">3</span>秒后 跳转到 在当前产品下继续添加</span></td>
              </tr>
              <tr>
                <td width="151" height="37" align="center"><input type="button" name="button3" id="button3" value="返回到当前产品" style="height:37px" onclick="location.href='product_category.php'" /></td>
                <td width="180" align="center"><input type="button" name="button2" id="button2" value="返回到当前方框图列表" style="height:37px" onclick="location.href='product_list.php'" /></td>
                <td width="186" align="center"><input type="button" name="button" id="button" value="继续在本产品下添加方框图" style="height:37px" onclick="location.href='product_add.php?fid=<?php echo $_GET["fid"] ?>&depth=<?php echo $_GET["depth"] ?>'" /></td>
              </tr>
            </table>
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