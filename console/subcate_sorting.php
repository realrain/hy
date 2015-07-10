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
<title>Sort</title>

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
.STYLE1 {color: #FF0000}
-->
</style>
</head>
<body>
<?php
$sql="select * from hy_category where id=".$_GET["fid"];
$rs=mysql_query($sql,$conn);
$row=mysql_fetch_assoc($rs);
?>
<table width="92%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="1%" valign="top" background="images/mail_leftbg.gif"><img src="images/left-top-right.gif" width="17" height="29" /></td>
    <td width="98%" valign="top" background="images/content-bg.gif"><table width="100%" height="31" border="0" cellpadding="0" cellspacing="0" class="left_topbg" id="table2">
      <tr>
        <td height="31"><div class="titlebt" style="text-indent:5px">栏目排序</div></td>
      </tr>
    </table></td>
    <td width="1%" valign="top" background="images/mail_rightbg.gif"><img src="images/nav-right-bg.gif" width="16" height="29" /></td>
  </tr>
  <tr>
    <td valign="middle" background="images/mail_leftbg.gif">&nbsp;</td>
    <td valign="top" bgcolor="#F7F8F9"><p>&nbsp;</p>
     <form action="modify_do.php" method="post" name="form1" id="form1">
      <table width="106%" height="360" border="0" align="center" cellpadding="0" cellspacing="0" class="line_table">
        
        <tr>
          <td width="11%" height="128" align="center">上级栏目名称：</td>
          <td width="30%" height="128"><?php echo $row["name_cn"] ?>/<?php echo $row["name_en"] ?>/<?php echo $row["name_de"] ?>
            <input name="type" type="hidden" id="type" value="categorysorting" /><input name="fid" type="hidden" id="fid" value="<?php echo $row["id"] ?>" /></td>
          <td width="59%">&nbsp;</td>
        </tr>
        
        <tr>
          <td height="128" align="center">&nbsp;</td>
          <td height="128" colspan="2" valign="top">
          
          <table width="429" border="1" cellpadding="0" cellspacing="0">
<?php
$sql="select * from hy_category where fid=".$_GET["fid"]." order by sortnum asc";
$rs=mysql_query($sql,$conn);
while($row=mysql_fetch_assoc($rs)){
?>
            <tr>
              <td width="234" style="padding:7px"><?php echo $row["name_cn"] ?>：</td>
              <td width="189" style="padding:7px">序号：
                <input name="subcate<?php echo $row["id"] ?>" type="text" id="textfield" style="width:37px;height:20px"<?php echo $row['sortnum']!=777?' value="'.$row['sortnum'].'"':"" ?> /></td>
              </tr>
<?php
} 
?>           
          </table>          </td>
          </tr>
        
        
        <tr>
          <td height="5" colspan="3"><table width="504" height="64" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="157" align="center">&nbsp;</td>
              <td width="174" align="center"><input type="submit" name="button" class="form_btn" value="排序" /></td>
              <td width="173" align="center"><input type="reset" name="button2" class="form_btn" value="重置" /></td>
            </tr>
          </table></td>
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
</body>
</html>