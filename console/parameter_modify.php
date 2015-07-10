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
<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="../js/jquery.blockUI.js"></script>
<script language="javascript">
$(document).ready(function()
{
	$("#form1").submit(function()
	{
		if($('#name').val()==""){
			alert("请填写参数名称!");
			$('#name').focus();
			return false;
		}
		if($('#fid').val()==""){
			alert("FID错误!");
			$('#fid').focus();
			return false;
		}
		
		$.post("modify_do.php",{type:$('#type').val(),name:$('#name').val(),fid:$('#fid').val(),id:$('#id').val()},function(feedback)
        {

			$.blockUI({
			message:'<img src=images/bar777.gif />', 
			css: { 
				border: 'none', 
				padding: '15px',
				backgroundColor: 'none',
				'-webkit-border-radius': '10px',
				'-moz-border-radius': '10px',
				opacity: 0.5,
				color: '#fff'
			} });
			setTimeout($.unblockUI,777); 
	  
		  if(feedback=='参数修改成功') 
		  {
		  	$("#status").html('<img src=\"images/ok.gif\" width=\"16\" height=\"16\" align=\"absmiddle\" /> 参数修改成功！'); 
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
	window.location="parameter_list.php?fid=<?php echo $_GET["fid"] ?>&depth=<?php echo $_GET["depth"] ?>";
}
</script>
</head>
<body>
<?php
if(!empty($_GET["id"])&&is_numeric($_GET["id"])&&!empty($_GET["fid"])&&is_numeric($_GET["fid"])){
	$sql="select id,name from hy_product_category_parameter where id=".$_GET["id"];
	$rs=mysql_query($sql,$conn);
	$row=mysql_fetch_assoc($rs);
	
	$sql="select * from hy_product_category where id=".$_GET["fid"];
	$rs=mysql_query($sql,$conn);
	$prow=mysql_fetch_assoc($rs);
	
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
     <form action="" method="post" name="form1" id="form1">
      <table width="99%" height="259" border="0" align="center" cellpadding="0" cellspacing="0" class="line_table">
         <tr>
               <td height="37" align="center">产品栏目ID：</td>
               <td><?php echo $prow['id']; ?></td>
          </tr>
             <tr>
               <td height="37" align="center">产品栏目名称：</td>
               <td><?php echo $prow['name']; ?></td>
             </tr>
        <tr>
          <td width="13%" height="49" align="center">参数名称：</td>
          <td width="83%" height="49"><input name="name" type="text" id="name" value="<?php echo $row["name"] ?>" size="30" />
            <span id="status">
              <input name="type" type="hidden" id="type" value="parameter" />
              <input name="id" type="hidden" id="id" value="<?php echo $_GET["id"] ?>" />
              <input name="fid" type="hidden" id="fid" value="<?php echo $_GET["fid"] ?>" />
            </span></td>
        </tr>
        
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