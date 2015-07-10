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
<title>Add</title>

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
.STYLE1 {
	color: #2372DC;
	font-size: 14px;
}
.STYLE3 {color: #FF0000; font-size: 14px; }
.STYLE5 {
	color: #639223;
	font-size: 14px;
}
-->
</style>
</head>
<body>
<?php
if(!empty($_GET["fid"])&&is_numeric($_GET["fid"])){
	
	$sql="select * from hy_product where id=".$_GET["fid"];
	$rs=mysql_query($sql,$conn);
	$row=mysql_fetch_assoc($rs);
	
	$sql="select * from hy_product_category_parameter where fid=".$row["fid"]." order by sortnum asc";
	$rs=mysql_query($sql,$conn);
	$pcrow=mysql_fetch_assoc($rs);
	
	$sql="select pp.id,pcp.name,pp.myvalue from hy_product_parameter as pp left join hy_product_category_parameter as pcp on pp.parameter_id=pcp.id left join hy_product as p on pp.product_id=p.id where pp.product_id=".$_GET["fid"]." order by pcp.sortnum asc";
	$rs=mysql_query($sql,$conn);	
	
}else{
	msg('参数不正确！');
	jump($_SERVER['HTTP_REFERER']);
}
?>
<table width="99%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="1%" valign="top" background="images/mail_leftbg.gif"><img src="images/left-top-right.gif" width="17" height="29" /></td>
    <td width="98%" valign="top" background="images/content-bg.gif"><table width="100%" height="31" border="0" cellpadding="0" cellspacing="0" class="left_topbg" id="table2">
      <tr>
        <td height="31"><div class="titlebt" style="text-indent:5px">修改参数</div></td>
      </tr>
    </table></td>
    <td width="1%" valign="top" background="images/mail_rightbg.gif"><img src="images/nav-right-bg.gif" width="16" height="29" /></td>
  </tr>
  <tr>
    <td valign="middle" background="images/mail_leftbg.gif">&nbsp;</td>
    <td valign="top" bgcolor="#F7F8F9"><p>&nbsp;</p>
     <form action="modify_do.php" method="post" name="form1" id="form1">
      <table width="99%" height="259" border="0" align="center" cellpadding="0" cellspacing="0" class="line_table">
         <tr>
           <td height="37" align="center">产品栏目：</td>
               <td><?php echo $pcrow['name']; ?></td>
          </tr>
             <tr>
               <td height="37" align="center">产品名称：</td>
               <td><?php echo $row['name']; ?></td>
             </tr>
          <tr>
            <td height="49" align="center">参数名称</td>
               <td height="49">参数值
               <input name="fid" type="hidden" id="fid" value="<?php echo $_GET["fid"] ?>" />
               <input name="type" type="hidden" id="type" value="myvalue_batch_modify" /></td>
          </tr>
          <?php
		  while($pprow=mysql_fetch_assoc($rs)){
		  ?>
          <tr>
            <td width="7%" height="49" align="center"><?php echo $pprow["name"] ?><input name="id[]" type="hidden" value="<?php echo $pprow["id"] ?>" /></td>
          <td width="90%" height="49"><input name="myvalue[]" type="text" value="<?php echo $pprow["myvalue"] ?>" size="30" /><input name="originalValue[]" type="hidden" value="<?php echo $pprow["myvalue"] ?>" /></td>
        </tr>
        <?php
		}
		?>
        <tr>
          <td height="5" colspan="2"><table width="504" height="30" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="157" align="center">&nbsp;</td>
              <td width="174" align="center"><input type="submit" name="button" class="form_btn" value="提交" /></td>
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