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
<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
</head>
<body>
<script>
var eMails=new Array();
<?php
$sql="select * from hy_email order by id desc";
$rs=mysql_query($sql,$conn);
$c=0;
while($row=mysql_fetch_assoc($rs)){
	echo "eMails[".$c."]=\"".$row['email']."\";\n";
	$c++;
}
?>
</script>
<table width="99%" height="393" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top" background="images/mail_leftbg.gif"><img src="images/left-top-right.gif" width="17" height="29" /></td>
    <td valign="top" background="images/content-bg.gif"><table width="100%" height="31" border="0" cellpadding="0" cellspacing="0" class="left_topbg" id="table2">
      <tr>
        <td height="31"><div class="titlebt">导出EMail</div></td>
      </tr>
    </table></td>
    <td valign="top" background="images/mail_rightbg.gif"><img src="images/nav-right-bg.gif" width="16" height="29" /></td>
  </tr>
  <tr>
    <td height="345" valign="middle" background="images/mail_leftbg.gif">&nbsp;</td>
    <td valign="top" bgcolor="#F7F8F9"><p>&nbsp;</p>
      <table width="99%" height="450" border="0" align="center" cellpadding="0" cellspacing="0" class="line_table">
        <tr>
          <td height="59" align="center">&nbsp;</td>
          <td style="padding-left:7px">
          <div style="float:left;width:699px;height:29px;border:1px solid #ccc;padding:1px">
          	<div id="progress_bar" style="width:0px;height:29px;background-color:#3CF"></div>
          </div><span style="float:left;height:29px;line-height:29px;margin-left:7px" id="num"></span>
          </td>
        </tr>
        
        <tr>
          <td width="11%" height="372" align="center">EMails：</td>
          <td width="89%" style="padding-left:7px">
            <textarea id="eMails" cols="99" rows="27" style="width:699px" onclick="this.select()"></textarea>
           </td>
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
<?php
mysql_free_result($rs);
mysql_close($conn);
?>
<script>
//Progress Bar by  Protoss ZeraTul 106770950@qq.com 05/14/2015
var c=0,w=0,num=0,hz=999;
var total=eMails.length-200;
var str="";

if(total<100){
  hz=777;
}else{
  hz=77;
}
if(total>200){
  hz=7;
}

window.setInterval(toon,hz);
function toon(){
  if(c<total){
    str+=eMails[c]+";";//每个邮件地址以分号分隔
    $("#eMails").val(str);//输出到TextArea
    c++;//当前进度
    w=c*(700/total);//700是进度条的宽度
    $("#progress_bar").css("width",Math.round(w));
    num=(c/total)*100;//计算百分比
    $("#num").text(Math.round(num)+"%");
  }
}
</script>
</body>
</html>