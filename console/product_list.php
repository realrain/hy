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
<title>List</title>
<link href="images/skin.css" rel="stylesheet" type="text/css" />
<link href="images/boxy.css" rel="stylesheet" type="text/css" />
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
.page {
	letter-spacing: 1px;
	color: #000;
}
.page b{
	color: #000;
}
.page a{
	padding: 3px;
	text-decoration: underline;
}
.page a:link{
	color: #000;
}
.page a:visited{
	color: #000;
}
.page a:hover{
	color: #000;
	background-color: #66CCFF;
	text-decoration: none;
}
.page a:active{
	color: #000;
}
#preview{

	display:none;

	position:absolute;

}
-->
</style>
<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="../js/jquery.boxy.js"></script>
<script type='text/javascript'>
$(function() {
	$("a.del").click(function() {
		var get_url=$(this).attr('href');	
		var get_title=$(this).attr('title');
		Boxy.confirm("确定要删除 <b>"+get_title+"</b> 吗？", function() { 
			$.ajax({
				type: "GET",
				url: get_url,
				success: function(msg){
					if(msg=='产品删除成功'){
						$("#ctip").html("<img src='images/del_ok.jpg' width='300' height='92' />").fadeIn(1000);
						setTimeout("go()",777);
						window.setTimeout(function(){go()},777);
					}else{			
						$("#ctip").text(msg).fadeIn(1000);
					}
				}
			});
		 }, {title: "提示信息"});
		return false;
	});
});
function go(){
	location.href="product_list.php";
}
</script>
</head>
<body>
<?php
$sql="select * from hy_product_category";
$rs=mysql_query($sql,$conn);
while($row=mysql_fetch_assoc($rs)){
	$cate_array[$row['id']]=$row['name'];
}
if(isset($_GET["fid"])&&is_numeric($_GET["fid"])){
	$lister=new lister($mysqlhost,$mysqlname,$mysqlpsw,$mydata,"hy_product where fid=".$_GET["fid"],"select * from hy_product where fid=".$_GET["fid"]." order by id desc","17");
}else{
	$lister=new lister($mysqlhost,$mysqlname,$mysqlpsw,$mydata,"hy_product","select * from hy_product order by id desc","17");
}
?>
<table width="99%" height="393" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="17" valign="top" background="images/mail_leftbg.gif"><img src="images/left-top-right.gif" width="17" height="29" /></td>
    <td valign="top" background="images/content-bg.gif"><table width="100%" height="31" border="0" cellpadding="0" cellspacing="0" class="left_topbg" id="table2">
      <tr>
        <td height="31"><div class="titlebt">管理产品</div></td>
      </tr>
    </table></td>
    <td width="16" valign="top" background="images/mail_rightbg.gif"><img src="images/nav-right-bg.gif" width="16" height="29" /></td>
  </tr>
  <tr>
    <td height="345" valign="middle" background="images/mail_leftbg.gif">&nbsp;</td>
    <td valign="top" bgcolor="#F7F8F9">
      
      <table width="97%" height="72" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC" id="bsinfo">
      <?php
	  if(isset($_GET["fid"])&&is_numeric($_GET["fid"])){
	  ?>
        <tr>
          <th height="23" align="center" bgcolor="#FFFFFF"><img src="images/down.gif" width="32" height="32" /></th>
          <th height="23" colspan="8" bgcolor="#FFCC99"><div align="left">当前显示的是 <font color="#FF0000"><?php echo $cate_array[$_GET["fid"]] ?></font> 下的全部产品，<a href="product_category.php">返回栏目总列表</a> <a href="product_list.php">返回产品总列表</a></div></th>
        </tr>
      <?php
	  }
	  ?>  
        <tr>
          <th width="3%" height="23" align="center" background="images/news-title-bg.gif" bgcolor="#FAFCFC"><span class="STYLE2">ID</span></th>
          <th width="26%" height="23" align="center" background="images/news-title-bg.gif" bgcolor="#FAFCFC"><span class="STYLE2">名称</span></th>
          <th width="10%" height="23" align="center" background="images/news-title-bg.gif" bgcolor="#FAFCFC">所属栏目</th>
          <th width="11%" align="center" background="images/news-title-bg.gif" bgcolor="#FAFCFC">参数</th>
          <th width="11%" align="center" background="images/news-title-bg.gif" bgcolor="#FAFCFC">方框图</th>
          <th width="11%" align="center" background="images/news-title-bg.gif" bgcolor="#FAFCFC">附件</th>
          <th width="8%" align="center" background="images/news-title-bg.gif" bgcolor="#FAFCFC">查看</th>
          <th width="8%" height="23" align="center" background="images/news-title-bg.gif" bgcolor="#FAFCFC"><span class="STYLE2">编辑</span></th>
          <th width="12%" height="23" align="center" background="images/news-title-bg.gif" bgcolor="#FAFCFC"><span class="STYLE2">删除</span></th>
        </tr>
<?php
while($row=mysql_fetch_assoc($lister->rs)){
?>
        <tr onMouseOver="this.style.backgroundColor='#E4EEF8'" onMouseOut="this.style.backgroundColor='#F7F8F9'">
          <td height="22" align="center"><?php echo $row['id'] ?></td>
          <td height="22" style="padding-left:7px"><?php echo $row['name'] ?></td>
          <td height="22" align="center"><a href="product_list.php?fid=<?php echo $row['fid'] ?>"><?php echo $cate_array[$row['fid']] ?></a></td>
          <td align="center"><a href="my_parameter_list.php?fid=<?php echo $row['id'] ?>">参数管理</a></td>
          <td align="center"><a href="scheme_list.php?fid=<?php echo $row['id'] ?>">方框图管理</a></td>
          <td align="center"><a href="file_list.php?fid=<?php echo $row['id'] ?>">附件管理</a></td>
          <td align="center"><a href="product_detail.php?id=<?php echo $row["id"] ?>" target="_blank">查看详细信息</a></td>
          <td height="22" align="center"><a href="product_modify.php?id=<?php echo $row['id'] ?>"><img src="images/write.png" width="29" height="29" /></a></td>
          <td height="22" align="center"><a href="del.php?id=<?php echo $row['id'] ?>&type=9&file=<?php echo $row['thumb'] ?>" title="<?php echo $row['name'] ?>" class="del"><img src="images/del.png" width="23" height="26" /></a></td>
        </tr>
<?php
}
$lister->bye();
?>
      </table>
      <table width="97%" height="26" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td align="center">
<?php
if(isset($_GET["fid"])&&is_numeric($_GET["fid"])){ 
	$lister->show("product_list.php","&fid=".$_GET["fid"]);
}else{
	$lister->show("product_list.php","");
}
?></td>
        </tr>
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
var TbRow = document.getElementById("bsinfo");
if (TbRow != null)
{
	for (var i=0;i<TbRow.rows.length ;i++ ){
		TbRow.rows[i].style.backgroundColor="#F7F8F9";
	}
}
</script>
<div id="ctip"></div>
<div id='preview'></div>
<?php
mysql_free_result($rs);
mysql_close($conn);
?>
</body>
</html>