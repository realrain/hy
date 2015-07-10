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
<title>管理员</title>

<link href="images/skin.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #EEF2FB;
}
.STYLE1 {color: #FF00FF}
td {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 14px;
	letter-spacing: 3px;
}
.STYLE3 {color: #FF0000}
-->
</style>
<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
<script language="javascript">
function chk(){
		var reg = /^[a-zA-Z0-9~!@#$%^&*()-_+|?.]*$/;

		if($('#name').val()==""){
			alert("请填写用户名!");
			$('#name').focus();
			return false;
		}
		
		if($('#psw').val()!=""){
			if($('#psw').val()==""){
				alert("请填写密码!");
				$('#psw').focus();
				return false;
			}
			if(document.getElementById("psw").value.length<6){
				alert("密码至少6位！");
				document.getElementById("psw").focus();
				return false;
			}
			if(!reg.test(document.getElementById("psw").value)){
				alert("密码不符合要求！");
				document.getElementById("psw").focus();
				return false;
			}			
			if(document.getElementById("psw2").value!=document.getElementById("psw").value){
				alert("两次输入的密码不一致！");
				document.getElementById("psw2").focus();
				return false;
			}
		}
		
		var val=$('input:radio[name="atype"]:checked').val();
		if(val==null){
			alert("请选择权限类型!");
			return false;
		}
		
		if(!reg.test(document.getElementById("name").value)){
			alert("用户名不符合要求！");
			document.getElementById("name").focus();
			return false;
		}
		if(document.getElementById("name").value.length<3){
			alert("用户名至少3位！");
			document.getElementById("name").focus();
			return false;
		}
}
</script>
</head>
<body>
<?php
if($_SESSION["hy_utype"]!=1){
	msg("你无权查看本页面！");
	jump("main.php");
}
if(!empty($_GET["id"])&&is_numeric($_GET["id"])){
	$query="select * from hy_admin where id=".$_GET["id"];
	$rs=mysql_query($query,$conn);
	$row=mysql_fetch_assoc($rs);
}else{
	echo "<script>alert('参数不正确！')</script>";
	jump("admin_list.php");
}
?>
<table width="100%" height="393" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="17" valign="top" background="images/mail_leftbg.gif"><img src="images/left-top-right.gif" width="17" height="29" /></td>
    <td valign="top" background="images/content-bg.gif"><table width="100%" height="31" border="0" cellpadding="0" cellspacing="0" class="left_topbg" id="table2">
      <tr>
        <td height="31"><div class="titlebt">修改管理员</div></td>
      </tr>
    </table></td>
    <td width="16" valign="top" background="images/mail_rightbg.gif"><img src="images/nav-right-bg.gif" width="16" height="29" /></td>
  </tr>
  <tr>
    <td height="345" valign="middle" background="images/mail_leftbg.gif">&nbsp;</td>
    <td valign="top" bgcolor="#F7F8F9"><p>&nbsp;</p>
      <table width="89%" height="144" border="0" align="center" cellpadding="0" cellspacing="0" class="line_table">
        <tr>
          <td width="2%" height="27" background="images/news-title-bg.gif"><img src="images/news-title-bg.gif" width="2" height="27"></td>
          <td width="98%" background="images/news-title-bg.gif" class="left_bt2">修改管理员</td>
        </tr>
        <tr>
          <td height="102" valign="top">&nbsp;</td>
          <td height="102" valign="top"><p>&nbsp;</p>
          <form id="form1" name="form1" method="post" action="modify_do.php" onsubmit="return chk();">
            <table width="1128" height="185" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width="136" height="30" align="center"><span class="STYLE3">用户名</span>：</td>
                <td width="16">&nbsp;</td>
                <td width="976" height="37"><input name="name" type="text" id="name" style="width:130px" value="<?php echo $row["name"] ?>" />
                  <input name="type" type="hidden" id="type" value="admin" /> <input id="editor" name="editor" type="hidden" value="<?php echo $_SESSION["hy_uid"] ?>" />
                  至少3位字符，允许字符范围：数字、英文字母(不区分大小写)、特殊符号（<span class="STYLE1">~!@#$%^&*()-_+|?.</span>）</td>
              </tr>
              <tr>
                <td height="35" align="center">新密码：</td>
                <td>&nbsp;</td>
                <td height="37"><input name="psw" type="password" id="psw" style="width:130px" />
                  <input name="id" type="hidden" id="id" value="<?php echo $row["id"] ?>" /> 至少6位字符，允许字符范围：数字、英文字母(区分大小写)、特殊符号（<span class="STYLE1">~!@#$%^&*()-_+|?.</span>）</td>
              </tr>
              <tr>
                <td height="35" align="center">再次输入新密码：</td>
                <td>&nbsp;</td>
                <td height="37"><input name="psw2" type="password" id="psw2" style="width:130px"/><span id="pswtip"></span>
                </td>
              </tr>
              <tr>
                <td height="35" align="center">备注：</td>
                <td>&nbsp;</td>
                <td height="37"><input name="remark" type="text" id="remark" style="width:377px" value="<?php echo $row["remark"] ?>" /></td>
              </tr>
              <tr>
                <td height="35" align="center"><span class="STYLE3">权限类型</span>：</td>
                <td>&nbsp;</td>
                <td height="37"><input name="atype" type="radio" id="radio" value="2"<?php echo $row["type"]==2?" checked=\"checked\"":"" ?> />
                  普通管理员 
                  <input name="atype" type="radio" id="radio2" value="1"<?php echo $row["type"]==1?" checked=\"checked\"":"" ?> />
                  超级管理员<span id="status"></span></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td height="37"><table width="245" height="24" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td align="center"><input type="submit" name="button3" id="button3" value="提交" class="form_btn" /></td>
                    <td align="center"><input type="reset" name="button3" id="button4" value="重置" class="form_btn" /></td>
                  </tr>
                </table>
                  </td>
              </tr>
            </table>            
          </form>
          <p>&nbsp;</p></td>
        </tr>
        <tr>
          <td height="5" colspan="2">&nbsp;</td>
        </tr>
      </table>
      </td>
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