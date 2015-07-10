<?php
session_start();
include_once("../inc/function.php");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>网站管理系统</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #1D3647;
}
-->
</style>
<link href="images/skin.css" rel="stylesheet" type="text/css">
<script language="javascript">
if (self!=top){
	top.location=self.location;
}
</script>
<SCRIPT LANGUAGE="JavaScript">
<!--
function changepic(){
	var img = document.getElementById("codepic");
	img.src = "../inc/code.php?"+Math.random();
}
//-->
</SCRIPT>
<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
<script language="javascript">
$(document).ready(function()
{
	$("#form1").submit(function()//当表单提交后
	{
		//发送数据，以client_name和client_password为变量
		$.post("login_check.php",{ client_name:$('#username').val(),client_password:$('#password').val(),client_code:$('#code').val() } ,function(feedback)
        {
		  
		  if(feedback=='登陆成功!') 
		  {
			$("#client_feedback").text('验证通过！').fadeIn(1000);
			window.setTimeout(function(){go()},1000);
		  }
		  else 
		  
			$("#client_feedback").text(feedback).fadeIn(1000);
        });
 		return false;
	});
});
function go(){
	window.location="main.php";
}
</script>
<style type="text/css">
<!--
.STYLE1 {color: #FF0000}
.STYLE2 {font-size: 14px}
-->
</style>
</head>
<body>
<?php
if(isset($_SESSION["hy_user"])){
	jump("main.php");
}
?>
<table width="100%" height="166" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="42" valign="top"><table width="100%" height="42" border="0" cellpadding="0" cellspacing="0" class="login_top_bg">
      <tr>
        <td width="1%" height="21">&nbsp;</td>
        <td height="42">&nbsp;</td>
        <td width="17%">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top"><table width="100%" height="532" border="0" cellpadding="0" cellspacing="0" class="login_bg">
      <tr>
        <td width="49%" align="right"><table width="91%" height="532" border="0" cellpadding="0" cellspacing="0" class="login_bg2">
            <tr>
              <td height="138" valign="top"><table width="89%" height="415" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td height="149">&nbsp;</td>
                </tr>
                <tr>
                  <td height="68" align="right" valign="top">&nbsp;</td>
                </tr>
                <tr>
                  <td height="198" align="right" valign="top"><!--<img src="images/logo.png" width="300" height="80">--></td>
                </tr>
              </table></td>
            </tr>
            
        </table></td>
        <td width="1%" >&nbsp;</td>
        <td width="50%" valign="bottom"><table width="100%" height="59" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td width="4%">&nbsp;</td>
              <td width="96%" height="38"><span class="login_txt_bt">登陆网站后台管理</span></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td height="21"><table cellSpacing="0" cellPadding="0" width="100%" border="0" id="table211" height="328">
                  <tr>
                    <td height="164" colspan="2" align="middle"><form action="" method="post" name="form1" id="form1">
                        <table cellSpacing="0" cellPadding="0" width="100%" border="0" height="178" id="table212">
                          <tr>
                            <td width="16%" height="38" class="top_hui_text"><span class="login_txt">用户名：&nbsp;&nbsp; </span></td>
                            <td height="38" colspan="2" class="top_hui_text"><input id="username" class="editbox4" value="" size="20">                            </td>
                          </tr>
                          <tr>
                            <td width="16%" height="35" class="top_hui_text"><span class="login_txt"> 密 码： &nbsp;&nbsp; </span></td>
                            <td height="35" colspan="2" class="top_hui_text"><input class="editbox4" type="password" size="20" id="password">
                              <img src="images/luck.gif" width="19" height="18"> </td>
                          </tr>
                          <tr>
                            <td width="16%" height="35" ><span class="login_txt">验证码：</span></td>
                            <td height="35" colspan="2" class="top_hui_text"><input class=wenbenkuang name=code type=text value="" maxLength=4 size=10 id="code">
                              <span class="input"><img src="../inc/code.php" name="codepic" width="80" height="20" align="absmiddle" id="codepic" onClick="changepic();" style="margin-left:7px" /></span>                             <a href="#" onClick="changepic()"  style="margin-left:7px" >换张图片</a></td>
                          </tr>
                          <tr>
                            <td height="35" >&nbsp;</td>
                            <td height="35" colspan="2" class="STYLE1" id="client_feedback" >&nbsp;</td>
                            </tr>
                          <tr>
                            <td height="35" >&nbsp;</td>
                            <td width="17%" height="35" ><input name="Submit" type="submit" class="button" id="Submit" value="登 陆"> </td>
                            <td width="67%" class="top_hui_text"><input name="cs" type="button" class="button" id="cs" value="取 消" onClick="showConfirmMsg1()"></td>
                          </tr>
                        </table>
                        <br>
                    </form></td>
                  </tr>
                  <tr>
                    <td width="433" height="164" align="right" valign="bottom"><img src="images/login-wel.gif" width="242" height="138"></td>
                    <td width="57" align="right" valign="bottom">&nbsp;</td>
                  </tr>
              </table></td>
            </tr>
          </table>
          </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="20"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="login-buttom-bg">
      <tr>
        <td align="center"><span class="login-buttom-txt STYLE2">Copyright &copy; 2013 FOX</span></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>