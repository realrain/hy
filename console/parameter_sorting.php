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
<title>Parameter List</title>
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
.gridViewItem {
	BORDER-RIGHT: #bad6ec 1px solid; BORDER-TOP: #bad6ec 1px solid; BORDER-LEFT: #bad6ec 1px solid; LINE-HEIGHT: 32px; BORDER-BOTTOM: #bad6ec 1px solid; TEXT-ALIGN: center
}
.STYLE1 {color: #FF0000}
#preview{

	display:none;

	position:absolute;

}
#ctip {
	height: 100px;
	width: 800px;
	text-align:center;
	margin-left: -400px;
	position: absolute;
	left: 50%;
	top: 50%;
	margin-top: -50px;
	background-color: #FFFFFF;
	border: 3px solid #999999;
	display: none;
}
-->
</style>
<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="../js/jquery.blockUI.js"></script>
<script type="text/javascript" src="../js/jquery.boxy.js"></script>

<script language="javascript">
function go(){
	window.location="parameter_list.php?fid=<?php echo $_GET["fid"] ?>&depth=<?php echo $_GET["depth"] ?>";
}
</script>
</head>
<body>
  <?php
if(!empty($_GET["fid"])&&is_numeric($_GET["fid"])){
  $sql="select * from hy_product_category where id=".$_GET["fid"];
  $rs=mysql_query($sql,$conn);
  $row=mysql_fetch_assoc($rs);
}else{
  msg('参数不正确！');
  jump($_SERVER['HTTP_REFERER']);
}
?>
<table width="97%" height="393" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="17" valign="top" background="images/mail_leftbg.gif"><img src="images/left-top-right.gif" width="17" height="29" /></td>
    <td valign="top" background="images/content-bg.gif"><table width="100%" height="31" border="0" cellpadding="0" cellspacing="0" class="left_topbg" id="table2">
      <tr>
        <td height="31"><div class="titlebt">参数排序</div></td>
      </tr>
    </table></td>
    <td width="16" valign="top" background="images/mail_rightbg.gif"><img src="images/nav-right-bg.gif" width="16" height="29" /></td>
  </tr>
  <tr>
    <td height="345" valign="middle" background="images/mail_leftbg.gif">&nbsp;</td>
    <td valign="top" bgcolor="#F7F8F9"><p>&nbsp;</p>      
      <table width="89%" height="57" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
        <tr>
          <td width="106" height="55" align="center" bgcolor="#FFFFFF">栏目名称：</td>
          <td width="270" align="center" bgcolor="#FFFFFF"><?php echo $row['name']; ?></td>
          <td width="724" bgcolor="#FFFFFF" style="padding-left:9px">&nbsp;</td>
        </tr>
        </table>
      <form action="modify_do.php" method="post" name="form1" id="form1">
      <table width="89%" height="60" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#999999" id="bsinfo">
        <tr>
          <th width="137" height="23" align="center" background="images/news-title-bg.gif" bgcolor="#FAFCFC"><span class="STYLE2">ID</span></th>
          <th width="1025" height="23" align="center" background="images/news-title-bg.gif" bgcolor="#FAFCFC"><span class="STYLE2">参数名称</span></th>
          <th width="245" height="23" align="center" background="images/news-title-bg.gif" bgcolor="#FAFCFC"><span class="STYLE2">序号</span></th>
        </tr>
<?php
$sql="select * from hy_product_category_parameter where fid= {$_GET["fid"]} order by sortnum asc";
$rs=mysql_query($sql,$conn);
while($row=mysql_fetch_assoc($rs)){
?>
        <tr>
          <td height="22" align="center"><?php echo $row['id'] ?><input name="id[]" type="hidden" value="<?php echo $row["id"] ?>" /></td>
          <td height="22" align="center"><?php echo $row['name'] ?><input name="fid" type="hidden" id="fid" value="<?php echo $_GET["fid"] ?>" />
               <input name="type" type="hidden" id="type" value="parameter_sorting" /></td>
          <td width="245" height="22" align="center"><input name="sortnum[]" type="text" value="<?php echo $row["sortnum"]!=777?$row["sortnum"]:'' ?>" style="width:27px" /></td>
        </tr>
<?php
}
?>
      </table>
      <table width="333" height="55" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td><input type="submit" name="button" class="form_btn" value="提交" style="width:77px;height:33px" /></td>
          <td>&nbsp;</td>
          <td><input type="reset" name="button2" class="form_btn" value="重置" style="width:77px;height:33px" /></td>
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
<script language="javascript" type="text/javascript">
var TbRow = document.getElementById("bsinfo");
if (TbRow != null)
{
	for (var i=0;i<TbRow.rows.length ;i++ ){
		if (TbRow.rows[i].rowIndex%2==1){
		TbRow.rows[i].style.backgroundColor="#fff";
		}else{
		TbRow.rows[i].style.backgroundColor="#ccc";
		}
	}
}
</script>
<?php
mysql_free_result($rs);
mysql_close($conn);
?>
</body>
</html>