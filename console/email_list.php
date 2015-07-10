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
					if(msg=='EMail Deleted'){
						$("#ctip").html("<img src='images/del_ok.jpg' width='300' height='92' />").fadeIn(1000);
						setTimeout("go()",777);
						window.setTimeout(function(){go()},777);
					}else{			
						$("#ctip").text(msg).fadeIn(777);
					}
				}
			});
		 }, {title: "提示信息"});
		return false;
	});
});
function go(){
	location.href="email_list.php";
}
</script>
</head>
<body>
<?php
$sql="select * from hy_email order by id desc";
$lister=new lister($mysqlhost,$mysqlname,$mysqlpsw,$mydata,"hy_email",$sql,"19");
?>
<table width="99%" height="393" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="17" valign="top" background="images/mail_leftbg.gif"><img src="images/left-top-right.gif" width="17" height="29" /></td>
    <td valign="top" background="images/content-bg.gif"><table width="100%" height="31" border="0" cellpadding="0" cellspacing="0" class="left_topbg" id="table2">
      <tr>
        <td height="31"><div class="titlebt">管理邮件地址</div></td>
      </tr>
    </table></td>
    <td width="16" valign="top" background="images/mail_rightbg.gif"><img src="images/nav-right-bg.gif" width="16" height="29" /></td>
  </tr>
  <tr>
    <td height="345" valign="middle" background="images/mail_leftbg.gif">&nbsp;</td>
    <td valign="top" bgcolor="#F7F8F9">
      
      <table width="97%" height="71" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC" id="bsinfo">
        <tr>
          <th width="5%" height="23" align="center" background="images/news-title-bg.gif" bgcolor="#FAFCFC"><span class="STYLE2">ID</span></th>
          <th width="12%" align="center" background="images/news-title-bg.gif" bgcolor="#FAFCFC">邮箱</th>
          <th width="10%" height="23" align="center" background="images/news-title-bg.gif" bgcolor="#FAFCFC"><span class="STYLE2">提交时间</span></th>
          <th width="9%" align="center" background="images/news-title-bg.gif" bgcolor="#FAFCFC">IP</th>
          <th width="13%" align="center" background="images/news-title-bg.gif" bgcolor="#FAFCFC">删除</th>
        </tr>        
<?php
while($row=mysql_fetch_assoc($lister->rs)){
?>
        
        <tr onMouseOver="this.style.backgroundColor='#E4EEF8'" onMouseOut="this.style.backgroundColor='#F7F8F9'">
          <td height="22" align="center"><?php echo $row['id'] ?></td>
          <td align="center"><?php echo $row['email'] ?></td>
          <td height="22" align="center"><?php echo $row['create_time'] ?></td>
          <td align="center"><?php echo $row['ip'] ?></td>
          <td align="center"><a href="del.php?type=13&id=<?php echo $row['id'] ?>" title="<?php echo $row['email'] ?>" class="del">删除</a></td>
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
$lister->show("email_list.php","");
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
<script language="javascript" type="text/javascript">
function really(x){
var r=confirm(x)
	if (r!=true)
	{
	return false;
	}
}
</script>
</body>
</html>