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
<link href="images/boxy.css" rel="stylesheet" type="text/css" />
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
$(document).ready(function()
{
  $('#name').focus();
	$("#form1").submit(function()
	{
		if($('#name').val()==""){
			alert("请填写参数名称!");
			$('#name').focus();
			return false;
		}
		
		$.post("add_do.php",{type:$('#type').val(),name:$('#name').val(),fid:$('#fid').val()},function(feedback)
        {

			$.blockUI({
			message:'<img src=images/bar777.gif />', 
			css: { 
				border: 'none', 
				padding: '15px',
				backgroundColor: 'none',
				'-webkit-border-radius': '10px',
				'-moz-border-radius': '10px',
				opacity: .5,
				color: '#fff'
			} });
			setTimeout($.unblockUI,777);
			
  
		  if(feedback.indexOf('参数添加成功')>-1)
		  {
		  	$("#status").html('<img src=\"images/ok.gif\" width=\"16\" height=\"16\" align=\"absmiddle\" /> 参数添加成功！'); 
			setTimeout("go()",1000);
			window.setTimeout(function(){go()},1000);
		  }
		  else 
			$("#status").html('<img src=\"images/pic12.gif\" width=\"16\" height=\"16\" align=\"absmiddle\" /> '+feedback);
        });
 		return false;
	});
	$("a.del").click(function() {
		var theurl=$(this).attr('href');	
		var title=$(this).attr('title');
		Boxy.confirm("确定要删除名为： <b>"+title+"</b> 的参数吗？", function()
		{
			$.ajax({
				type: "GET",
				url: theurl,
				success: function(msg){
					if(msg.indexOf('参数删除成功')>-1){
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
	window.location="parameter_list.php?fid=<?php echo $_GET["fid"] ?>&depth=<?php echo $_GET["depth"] ?>";
}
</script>
</head>
<body>
  <?php
if(!empty($_GET["fid"])&&is_numeric($_GET["fid"])&&!empty($_GET["depth"])){
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
        <td height="31"><div class="titlebt">参数列表</div></td>
      </tr>
    </table></td>
    <td width="16" valign="top" background="images/mail_rightbg.gif"><img src="images/nav-right-bg.gif" width="16" height="29" /></td>
  </tr>
  <tr>
    <td height="345" valign="middle" background="images/mail_leftbg.gif">&nbsp;</td>
    <td valign="top" bgcolor="#F7F8F9"><p>&nbsp;</p>
      <form action="add_do.php" method="post" name="form1" id="form1">
      <table width="89%" height="110" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
        <tr>
          <td width="106" height="55" align="center" bgcolor="#FFFFFF">栏目名称：</td>
          <td width="270" align="center" bgcolor="#FFFFFF"><?php echo $row['name']; ?></td>
          <td width="724" rowspan="2" bgcolor="#FFFFFF" style="padding-left:9px">
          <table width="903" height="49" border="0" align="center" cellpadding="0" cellspacing="0" style="border:1px #CCC dashed;background-color:#D8CAB6">
            <tr>
              <td width="433" align="center">参数名称：<input type="text" name="name" id="name" style="width:177px;height:23px;line-height:23px" />
                <font color="gray">【按下回车键即可提交】</font> </td>
              <td width="29">
              <input name="type" type="hidden" id="type" value="parameter" />
              <input name="fid" type="hidden" id="fid" value="<?php echo $_GET["fid"] ?>" />
              </td>
              <td width="167" align="center"><input type="submit" name="button" class="form_btn" value="添加" style="width:77px;height:33px" /></td>
              <td width="274"><span id="status"></span></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td height="52" align="center" bgcolor="#FFFFFF">参数排序：</td>
          <td align="center" bgcolor="#FFFFFF"><input type="button" name="button3" id="button3" value="进行参数排序" style="height:37px" onclick="location.href='parameter_sorting.php?fid=<?php echo $_GET["fid"]; ?>'" /></td>
          </tr>
      </table>
      </form>
      <br />
      <table width="89%" height="60" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#999999" id="bsinfo">
        <tr>
          <th width="104" height="23" align="center" background="images/news-title-bg.gif" bgcolor="#FAFCFC"><span class="STYLE2">ID</span></th>
          <th width="527" height="23" align="center" background="images/news-title-bg.gif" bgcolor="#FAFCFC"><span class="STYLE2">参数名称</span></th>
          <th width="89" align="center" background="images/news-title-bg.gif" bgcolor="#FAFCFC">序号</th>
          <th width="89" height="23" align="center" background="images/news-title-bg.gif" bgcolor="#FAFCFC"><span class="STYLE2">操作</span></th>
          <th width="102" height="23" align="center" background="images/news-title-bg.gif" bgcolor="#FAFCFC"><span class="STYLE2">操作</span></th>
        </tr>
<?php
$sql="select * from hy_product_category_parameter where fid= {$_GET["fid"]} order by sortnum asc";
$rs=mysql_query($sql,$conn);
while($row=mysql_fetch_assoc($rs)){
?>
        <tr>
          <td height="22" align="center"><?php echo $row['id'] ?></td>
          <td height="22" align="center"><?php echo $row['name'] ?></td>
          <td width="89" align="center"><?php echo $row['sortnum'] ?></td>
          <td width="89" height="22" align="center"><a href="parameter_modify.php?id=<?php echo $row['id'] ?>&fid=<?php echo $row['fid'] ?>&depth=<?php echo $_GET['depth'] ?>"><img src="images/write.png" width="29" height="29" /></a></td>
          <td width="102" height="22" align="center"><a href="del.php?id=<?php echo $row['id'] ?>&fid=<?php echo $row['fid'] ?>&type=11" title="<?php echo $row['name'] ?>" class="del"><img src="images/del.png" width="23" height="26" /></a></td>
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

var r=confirm("确定要删除此参数？")

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
</script>
<div id="ctip"></div>
<?php
mysql_free_result($rs);
mysql_close($conn);
?>
</body>
</html>