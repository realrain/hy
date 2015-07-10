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
.STYLE1 {color: #FF0000}
.STYLE2 {	color: #333333
}
-->
</style>
<script charset="utf-8" src="kindeditor/kindeditor.js"></script>
<script charset="utf-8" src="kindeditor/lang/zh_CN.js"></script>
<script>
var editor;
KindEditor.ready(function(K) {
		editor = K.create('#contents');
});

</script>
<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="../js/jquery.blockUI.js"></script>
<script language="javascript">
$(document).ready(function()
{
	$("#form1").submit(function()
	{
		$.post("modify_do.php",{type:$('#type').val(),id:$('#id').val(),title:$('#title').val(),contents:$('#contents').val(),seotitle:$('#seotitle').val(),keywords:$('#keywords').val(),des:$('#des').val()},function(feedback)
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
	  
		  if(feedback=='单页信息更新成功') 
		  {
		  	$("#status").html('<img src=\"images/ok.gif\" width=\"16\" height=\"16\" align=\"absmiddle\" /> 单页信息更新成功！'); 
			setTimeout("go()",1000);
			window.setTimeout(function(){go()},1000);
		  }
		  else 
			$("#status").html('<img src=\"images/pic12.gif\" width=\"16\" height=\"16\" align=\"absmiddle\" /> '+feedback);
        });
 		return false;
	});
});
function go(){
	window.location="single_list.php";
}
</script>
</head>
<body>
<?php
if(isset($_GET["id"])&&is_numeric($_GET["id"])){
	$sql="select * from wode_single where id=".$_GET["id"];
	$rs=mysql_query($sql,$conn);
	$row=mysql_fetch_assoc($rs);
}
?>
<table width="99%" height="393" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top" background="images/mail_leftbg.gif"><img src="images/left-top-right.gif" width="17" height="29" /></td>
    <td valign="top" background="images/content-bg.gif"><table width="100%" height="31" border="0" cellpadding="0" cellspacing="0" class="left_topbg" id="table2">
      <tr>
        <td height="31"><div class="titlebt">添加信息</div></td>
      </tr>
    </table></td>
    <td valign="top" background="images/mail_rightbg.gif"><img src="images/nav-right-bg.gif" width="16" height="29" /></td>
  </tr>
  <tr>
    <td height="345" valign="middle" background="images/mail_leftbg.gif">&nbsp;</td>
    <td valign="top" bgcolor="#F7F8F9"><p>&nbsp;</p>
     <form action="" method="post" name="form1" id="form1">
      <table width="99%" height="598" border="0" align="center" cellpadding="0" cellspacing="0" class="line_table">
        
        <tr>
          <td width="11%" height="37" align="center"><span class="STYLE1">标题</span>：</td>
          <td width="89%" height="37"><input name="title" type="text" id="title" value="<?php echo $row["title"] ?>" size="70" />
            <input name="type" type="hidden" id="type" value="single" />
            <span id="status">
            <input name="id" type="hidden" id="id" value="<?php echo $row["id"] ?>" />
            </span></td>
        </tr>
        <tr>
          <td height="37" align="center"><span class="STYLE2">SEO长标题：</span></td>
          <td height="37"><input name="seotitle" type="text" id="seotitle" value="<?php echo $row["seotitle"] ?>" size="70" /></td>
        </tr>
        <tr>
          <td height="37" align="center"><span class="STYLE2">keywords：</span></td>
          <td height="37"><input name="keywords" type="text" id="keywords" value="<?php echo $row["keywords"] ?>" size="117" /></td>
        </tr>
        <tr>
          <td height="37" align="center"><span class="STYLE2">description：</span></td>
          <td height="37"><input name="des" type="text" id="des" value="<?php echo $row["des"] ?>" size="117" /></td>
        </tr>
        
        <tr>
          <td height="408" align="center"><span class="STYLE1">详细内容</span>：</td>
          <td><p>
            <textarea name="contents" id="contents" cols="130" rows="27"><?php echo $row["contents"] ?></textarea>
          </p>          </td>
        </tr>
        <tr>
          <td height="5" colspan="2"><table width="652" height="30" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="263" align="center">&nbsp;</td>
              <td width="119" align="center"><input type="submit" name="button" class="form_btn" value="提交" /></td>
              <td width="133" align="center"><input type="reset" name="button2" class="form_btn" value="重置" /></td>
              <td width="137" align="center"><input type="button" name="button3" class="form_btn" value="返回" onclick="go()" /></td>
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
<?php
mysql_free_result($rs);
mysql_close($conn);
?>
</body>
</html>