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
<title>Scheme List</title>

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
-->
</style>
<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
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
<table width="97%" height="393" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="17" valign="top" background="images/mail_leftbg.gif"><img src="images/left-top-right.gif" width="17" height="29" /></td>
    <td valign="top" background="images/content-bg.gif"><table width="100%" height="31" border="0" cellpadding="0" cellspacing="0" class="left_topbg" id="table2">
      <tr>
        <td height="31"><div class="titlebt">方框图</div></td>
      </tr>
    </table></td>
    <td width="16" valign="top" background="images/mail_rightbg.gif"><img src="images/nav-right-bg.gif" width="16" height="29" /></td>
  </tr>
  <tr>
    <td height="345" valign="middle" background="images/mail_leftbg.gif">&nbsp;</td>
    <td valign="top" bgcolor="#F7F8F9"><p>&nbsp;</p>
      
      <table width="89%" height="61" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
        <tr>
          <td width="106" align="center" bgcolor="#FFFFFF">产品名称：</td>
          <td width="270" align="center" bgcolor="#FFFFFF"><?php echo $row['name']; ?></td>
          <td width="724" bgcolor="#FFFFFF">
          <input type="button" name="button" id="button" value="添加方框图" style="height:37px" onclick="location.href='scheme_add.php?fid=<?php echo $_GET["fid"] ?>'" />          </td>
        </tr>
      </table>
      <br />
      <table width="89%" height="72" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#999999" id="bsinfo">
        <tr>
          <th width="104" height="23" align="center" background="images/news-title-bg.gif" bgcolor="#FAFCFC"><span class="STYLE2">ID</span></th>
          <th width="630" height="23" align="center" background="images/news-title-bg.gif" bgcolor="#FAFCFC"><span class="STYLE2">名称</span></th>
          <th width="179" align="center" background="images/news-title-bg.gif" bgcolor="#FAFCFC">图片</th>          
          <th width="89" height="23" align="center" background="images/news-title-bg.gif" bgcolor="#FAFCFC"><span class="STYLE2">操作</span></th>
          <th width="102" height="23" align="center" background="images/news-title-bg.gif" bgcolor="#FAFCFC"><span class="STYLE2">操作</span></th>
        </tr>
<?php
$sql="select * from hy_product_scheme where fid= {$_GET["fid"]} order by id desc";
$rs=mysql_query($sql,$conn);
while($row=mysql_fetch_assoc($rs)){
?>
        <tr>
          <td height="22" align="center"><?php echo $row['id'] ?></td>
          <td height="22" align="center"><?php echo $row['name'] ?></td>
          <td align="center"><a href="../uploads/<?php echo getPath($row['pic'],'scheme'); ?>" target="_blank" onclick="javascript:void(0)" class="preview" pic="../uploads/<?php echo getPath($row['pic'],'scheme'); ?>">查看图片</a></td>          
          <td width="89" height="22" align="center"><a href="scheme_modify.php?id=<?php echo $row['id'] ?>&fid=<?php echo $row['fid'] ?>"><img src="images/write.png" width="29" height="29" /></a></td>
          <td width="102" height="22" align="center"><a href="del.php?id=<?php echo $row['id'] ?>&fid=<?php echo $row['fid'] ?>&file=<?php echo $row['pic'] ?>&type=10" onclick='return really()'><img src="images/del.png" width="23" height="26" /></a></td>
        </tr>
<?php
}
?>
      </table></td>
    <td background="images/mail_rightbg.gif">&nbsp;</td>
  </tr>
  <tr>
    <td valign="bottom" background="images/mail_leftbg.gif"><img src="images/buttom_left2.gif" width="17" height="17" /></td>
    <td background="images/buttom_bgs.gif"><img src="images/buttom_bgs.gif" width="17" height="17"></td>
    <td valign="bottom" background="images/mail_rightbg.gif"><img src="images/buttom_right2.gif" width="16" height="17" /></td>
  </tr>
</table>
<script language="javascript" type="text/javascript">

function really(){

var r=confirm("确定要删除吗？")

	if (r!=true)

	{

	return false;

	}

}
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

this.imagePreview = function(){   

   xOffset = 10;

   yOffset = 20;

$("a.preview").hover(function(e){

   $("#preview").html("<img src='"+$(this).attr('pic')+"' />");

   $("#preview")

    .css("top",(e.pageY - xOffset) + "px")

    .css("left",(e.pageX + yOffset) + "px")

	.show();

    },

function(){

	$("#preview").hide();

    }); 

	$("a.preview").mousemove(function(e){

   		$("#preview")

    	.css("top",(e.pageY - xOffset) + "px")

    	.css("left",(e.pageX + yOffset) + "px");

	});   

};

$(document).ready(function(){

imagePreview();

});

</script>
<div id='preview'></div>
<?php
mysql_free_result($rs);
mysql_close($conn);
?>
</body>
</html>