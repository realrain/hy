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
		var val=$('input:radio[name="ctype"]:checked').val();
		if(val==null){
			alert("请选择栏目类型!");
			return false;
		}
		$.post("modify_do.php",{type:$('#type').val(),name:$('#name').val(),id:$('#id').val(),ctype:$('input[name="ctype"]:checked').val()},function(feedback)
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
	  
		  if(feedback=='栏目修改成功') 
		  {
		  	$("#status").html('<img src=\"images/ok.gif\" width=\"16\" height=\"16\" align=\"absmiddle\" /> 栏目修改成功！'); 
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
	window.location="category.php";
}
</script>
</head>
<body>
<?php
if(isset($_GET["id"])&&is_numeric($_GET["id"])){
	$sql="select * from hy_category where id=".$_GET["id"];
	$rs=mysql_query($sql,$conn);
	$row=mysql_fetch_assoc($rs);
}
?>
<table width="91%" height="393" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="1%" valign="top" background="images/mail_leftbg.gif"><img src="images/left-top-right.gif" width="17" height="29" /></td>
    <td width="98%" valign="top" background="images/content-bg.gif"><table width="100%" height="31" border="0" cellpadding="0" cellspacing="0" class="left_topbg" id="table2">
      <tr>
        <td height="31"><div class="titlebt" style="text-indent:5px">修改栏目</div></td>
      </tr>
    </table></td>
    <td width="1%" valign="top" background="images/mail_rightbg.gif"><img src="images/nav-right-bg.gif" width="16" height="29" /></td>
  </tr>
  <tr>
    <td height="345" valign="middle" background="images/mail_leftbg.gif">&nbsp;</td>
    <td valign="top" bgcolor="#F7F8F9"><p>&nbsp;</p>
     <form action="" method="post" name="form1" id="form1">
      <table width="100%" height="310" border="0" align="center" cellpadding="0" cellspacing="0" class="line_table">
        
        <tr>
          <td width="12%" height="56" align="center">栏目名称：</td>
          <td width="25%" height="56"><input name="name" type="text" id="name" value="<?php echo $row["name"] ?>" size="30" />
            <input name="type" type="hidden" id="type" value="category" />
            <input name="id" type="hidden" id="id" value="<?php echo $_GET["id"] ?>" /></td>
          <td width="49%"><table width="668" height="128" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="85" height="67" align="center">类型：</td>
              <td width="130" bgcolor="#CCCCCC"><input type="radio" name="ctype" id="radio1" value="normal"<?php echo $row["type"]=="normal"?" checked=\"checked\"":"" ?> />
                普通栏目 </td>
              <td width="126" bgcolor="#DDEEFF"><input type="radio" name="ctype" id="radio2" value="singlepic"<?php echo $row["type"]=="singlepic"?" checked=\"checked\"":"" ?> />
                单图列表</td>
              <td width="143" bgcolor="#FFE6FF"><input type="radio" name="ctype" id="radio3" value="doublepic"<?php echo $row["type"]=="doublepic"?" checked=\"checked\"":"" ?> />
                双图列表</td>
              <td width="123" bgcolor="#E3FABA"><input type="radio" name="ctype" id="radio4" value="hr"<?php echo $row["type"]=="hr"?" checked=\"checked\"":"" ?> />
                招聘 </td>
            </tr>
            <tr>
              <td align="center">&nbsp;</td>
              <td bgcolor="#CCCCCC">普通栏目<br />
                例如：<strong>新闻中心</strong></td>
              <td bgcolor="#DDEEFF">文字+单张图片<br />
                例如：<strong>企业荣誉</strong></td>
              <td bgcolor="#FFE6FF">文字+小图+大图<br />
                例如：<strong>员工天地</strong></td>
              <td bgcolor="#E3FABA">标题+招聘人数+详细内容<br />
                例如：<strong>社会招聘</strong><br /></td>
            </tr>
          </table></td>
          <td width="14%"><span id="status"></span>&nbsp;</td>
        </tr>
        
        
        <tr>
          <td height="5" colspan="4"><table width="504" height="30" border="0" cellpadding="0" cellspacing="0">
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