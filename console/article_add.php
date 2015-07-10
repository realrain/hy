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
<title>Article</title>
<link href="images/skin.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="css/le-frog/jquery-ui-1.8.20.custom.css" rel="stylesheet" />
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #EEF2FB;
}
.STYLE6 {color: #999999}
-->
</style>
<script charset="utf-8" src="kindeditor/kindeditor.js"></script>
<script charset="utf-8" src="kindeditor/lang/zh_CN.js"></script>
<script src="js/zealot.js"></script>
<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
<script>
var editor;
KindEditor.ready(function(K) {
		editor = K.create('#contents');
});
function chk(){
	if(check_select("fid","请选择栏目")){
		return false;
	}
	if(editor.html()==""){
		alert("请填写详细内容！");
		editor.focus();
		return false;
	}	
	return true;
}
</script>
</head>
<body>
<?php
if(isset($_GET["fid"])&&is_numeric($_GET["fid"])){
	$sql1="select * from hy_category where id=".$_GET["fid"];
	$rs1=mysql_query($sql1,$conn);
	$row1=mysql_fetch_assoc($rs1);
}
if(isset($_GET["fid"])&&is_numeric($_GET["fid"])&&$_GET["depth"]==2){
	$sql2="select * from hy_category where id=".$row1["fid"];
	$rs2=mysql_query($sql2,$conn);
	$row2=mysql_fetch_assoc($rs2);
}
if(isset($_GET["fid"])&&is_numeric($_GET["fid"])&&$_GET["depth"]==3){
	$sql2="select * from hy_category where id=".$row1["fid"];
	$rs2=mysql_query($sql2,$conn);
	$row2=mysql_fetch_assoc($rs2);

	$sql3="select * from hy_category where id=".$row2["fid"];
	$rs3=mysql_query($sql3,$conn);
	$row3=mysql_fetch_assoc($rs3);
}
?>
<table width="99%" height="393" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="17" valign="top" background="images/mail_leftbg.gif"><img src="images/left-top-right.gif" width="17" height="29" /></td>
    <td valign="top" background="images/content-bg.gif"><table width="100%" height="31" border="0" cellpadding="0" cellspacing="0" class="left_topbg" id="table2">
      <tr>
        <td height="31"><div class="titlebt">添加信息</div></td>
      </tr>
    </table></td>
    <td width="16" valign="top" background="images/mail_rightbg.gif"><img src="images/nav-right-bg.gif" width="16" height="29" /></td>
  </tr>
  <tr>
    <td height="345" valign="middle" background="images/mail_leftbg.gif">&nbsp;</td>
    <td valign="top" bgcolor="#F7F8F9"><p>&nbsp;</p>
     <form action="add_do.php" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return chk();">
       <table width="99%" border="0" align="center" cellpadding="0" cellspacing="0" class="line_table">
         <tr>
           <td width="104" height="32" align="center">所属栏目：</td>
           <td width="1011" height="32">
		   <?php
		  if($_GET["depth"]==1){
		  	echo $row1["name"];
		  }		  
		  if($_GET["depth"]==2){
		  	echo "<b>".$row2["name"]."</b> <span style='color:red'>&gt;&gt;</span> <b>".$row1["name"]."</b>";
		  }		  
		  if($_GET["depth"]==3){
		  	echo "<b>".$row3["name"]."</b> <span style='color:red'>&gt;&gt;</span> <b>".$row2["name"]."</b> <span style='color:red'>&gt;&gt;</span> <b>".$row1["name"];
		  }
		  ?></td>
         </tr>
         
         <tr>
           <td height="32" align="center">标题：</td>
           <td height="32"><input name="title" type="text" id="title" size="70" />
               <input name="type" type="hidden" id="type" value="article" />
               <input name="fid" type="hidden" id="fid" value="<?php echo $_GET["fid"] ?>" />
               <input name="depth" type="hidden" id="depth" value="<?php echo $_GET["depth"] ?>" /> </td>
         </tr>
         <tr>
           <td height="27" align="center">发布者：</td>
           <td><input name="poster" type="text" id="title2" size="33" /></td>
         </tr>
         <tr>
           <td height="357" align="center">详细内容：</td>
           <td><p>
               <textarea name="contents" id="contents" cols="137" rows="22"></textarea>
           </p></td>
         </tr>       
         
         <tr>
           <td height="5" colspan="2"><table width="601" height="47" border="0" cellpadding="0" cellspacing="0">
               <tr>
                 <td width="132" align="center">&nbsp;</td>
                 <td width="182" align="center"><input type="submit" name="button" id="button" value="提交" style="height:37px;width:100px" /></td>
                 <td width="287" align="center"><input type="reset" name="button2" id="button2" value="重置" style="height:37px;width:100px" /></td>
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