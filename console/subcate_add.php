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
.STYLE3 {color: #FF0000; font-size: 14px; }
.STYLE4 {	color: #2372DC;
	font-size: 14px;
}
.STYLE5 {	color: #639223;
	font-size: 14px;
}
.STYLE6 {font-size: 14px}
-->
</style>
<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="../js/jquery.blockUI.js"></script>
<script language="javascript">
$(document).ready(function()
{
	$("#form1").submit(function()
	{
		if($('#name').val()==""){
			alert("请填写栏目名称!");
			$('#name').focus();
			return false;
		}
		$.post("add_do.php",{type:$('#type').val(),name:$('#name').val(),fid:$('#fid').val(),id:$('#id').val()},function(feedback)
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
	  
		  if(feedback=='子栏目添加成功') 
		  {
		  	$("#status").html('<img src=\"images/ok.gif\" width=\"16\" height=\"16\" align=\"absmiddle\" /> 子栏目添加成功！'); 
			setTimeout("go('category.php')",1000);
			window.setTimeout(function(){go('category.php')},1000);
		  }			
		if(feedback=='子分类添加成功') 
		  {
		  	$("#status").html('<img src=\"images/ok.gif\" width=\"16\" height=\"16\" align=\"absmiddle\" /> 子分类添加成功！'); 
			setTimeout("go('special.php')",1000);
			window.setTimeout(function(){go('special.php')},1000);
		  }
		  if(feedback!='子栏目添加成功'&&feedback!='子分类添加成功') 
		  {
		  	$("#status").html('<img src=\"images/pic12.gif\" width=\"16\" height=\"16\" align=\"absmiddle\" /> '+feedback);
		  }
        });
 		return false;
	});
});
function go(x){
	window.location=x;
}
</script>
</head>
<body>
<?php
if(isset($_GET["fid"])&&is_numeric($_GET["fid"])){
	$sql="select * from hy_category where id=".$_GET["fid"];
	$rs=mysql_query($sql,$conn);
	$row=mysql_fetch_assoc($rs);
}
if($_GET["depth"]==3){
	$sqlx="select * from hy_category where id=".$row["fid"];
	$rsx=mysql_query($sqlx,$conn);
	$rowx=mysql_fetch_assoc($rsx);
}
?>
<table width="99%" height="393" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="1%" valign="top" background="images/mail_leftbg.gif"><img src="images/left-top-right.gif" width="17" height="29" /></td>
    <td width="99%" valign="top" background="images/content-bg.gif"><table width="100%" height="31" border="0" cellpadding="0" cellspacing="0" class="left_topbg" id="table2">
      <tr>
        <td height="31"><div class="titlebt" style="text-indent:5px">添加子栏目</div></td>
      </tr>
    </table></td>
    <td width="0%" valign="top" background="images/mail_rightbg.gif"><img src="images/nav-right-bg.gif" width="16" height="29" /></td>
  </tr>
  <tr>
    <td height="345" valign="middle" background="images/mail_leftbg.gif">&nbsp;</td>
    <td valign="top" bgcolor="#F7F8F9"><p>&nbsp;</p>
     <form action="" method="post" name="form1" id="form1">
      <table width="99%" height="328" border="0" align="center" cellpadding="0" cellspacing="0" class="line_table">
        
        <tr>
          <td height="53" align="center">上级栏目：</td>
          <td height="53">
            <span class="STYLE6">
            <?php
		  if($_GET["depth"]==2){
		  	echo $row["name"];
		  }		  
		  if($_GET["depth"]==3){
		  	echo "<b>".$rowx["name"]."</b> &gt;&gt; <b>".$row["name"]."</b>";
		  }
		  ?>          
            <input name="type" type="hidden" id="type" value="subcate" />
            <input name="fid" type="hidden" id="fid" value="<?php echo $_GET["fid"] ?>" />
            </span></td>
        </tr>
        
        <tr>
          <td width="20%" height="56" align="center">子栏目名称：</td>
          <td width="80%" height="56"><input name="name" type="text" id="name" size="30" /><span id="status"></span></td>
          </tr>
        
        
        
        
        
        
        <tr>
          <td height="5" colspan="2"><table width="379" height="30" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="51" align="center">&nbsp;</td>
              <td width="114" align="center"><input type="submit" name="button" class="form_btn" value="提交" /></td>
              <td width="104" align="center"><input type="reset" name="button2" class="form_btn" value="重置" /></td>
              <td width="110" align="center"><input type="button" name="button3" class="form_btn" value="返回" onclick="go('category.php')" /></td>
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