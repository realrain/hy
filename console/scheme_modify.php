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
<title>Product</title>
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
#preview{
	display:none;
	position:absolute;
}
-->
</style>
<script charset="utf-8" src="kindeditor/kindeditor.js"></script>
<script charset="utf-8" src="kindeditor/lang/zh_CN.js"></script>
<script src="js/zealot.js"></script>
<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
<script>
var editor;
KindEditor.ready(function(K) {
		editor1 = K.create('#description');
		editor2 = K.create('#feature');	
});
function chk(){
	if(check_select("fid","请选择栏目")){
		return false;
	}
	if(checkit("name","请填写产品名称")){
		return false;
	}
	if(editor1.html()==""){
		alert("请填写描述！");
		editor1.focus();
		return false;
	}
	if(editor1.html()==""){
		alert("请填写描述！");
		editor1.focus();
		return false;
	}
	if(editor2.html()==""){
		alert("请填写特性！");
		editor2.focus();
		return false;
	}
	return true;
}
</script>
</head>
<body>
<?php
if(!empty($_GET["id"])&&is_numeric($_GET["id"])&&!empty($_GET["fid"])&&is_numeric($_GET["fid"])){
	$sql="select * from hy_product_scheme where id=".$_GET["id"];
	$rs=mysql_query($sql,$conn);
	$row=mysql_fetch_assoc($rs);
	
	$sql="select * from hy_product where id=".$_GET["fid"];
	$rs=mysql_query($sql,$conn);
	$prow=mysql_fetch_assoc($rs);
	
}else{
	msg('参数不正确！');
	jump($_SERVER['HTTP_REFERER']);
}
?>
<table width="99%" height="393" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="17" valign="top" background="images/mail_leftbg.gif"><img src="images/left-top-right.gif" width="17" height="29" /></td>
    <td valign="top" background="images/content-bg.gif"><table width="100%" height="31" border="0" cellpadding="0" cellspacing="0" class="left_topbg" id="table2">
      <tr>
        <td height="31"><div class="titlebt">修改方框图</div></td>
      </tr>
    </table></td>
    <td width="16" valign="top" background="images/mail_rightbg.gif"><img src="images/nav-right-bg.gif" width="16" height="29" /></td>
  </tr>
  <tr>
    <td height="345" valign="middle" background="images/mail_leftbg.gif">&nbsp;</td>
    <td valign="top" bgcolor="#F7F8F9"><p>&nbsp;</p>
     <form action="modify_do.php" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return chk();">
       <table width="99%" border="0" align="center" cellpadding="0" cellspacing="0" class="line_table">
         <tr>
           <td width="104" height="32" align="center">所属产品：</td>
           <td width="1011" height="32"><?php echo $prow['name']; ?></td>
         </tr>
         
         <tr>
           <td height="32" align="center">名称：</td>
           <td height="32"><input name="name" type="text" id="name" size="70" value="<?php echo $row["name"] ?>" />
            <input name="type" type="hidden" id="type" value="scheme" />
            <input name="id" type="hidden" id="id" value="<?php echo $row["id"] ?>" />
            <input name="fid" type="hidden" id="fid" value="<?php echo $_GET["fid"] ?>" /></td>
         </tr>
         <tr>
           <td height="32" align="center">图片：</td>
           <td height="32"><input name="pic" type="file" id="pic" size="60" />
          <input name="old_pic" type="hidden" id="old_pic" value="<?php echo $row['pic']?>" />
          <a href="../uploads/<?php echo getPath($row['pic'],'scheme'); ?>" target="_blank" class="preview" pic="../uploads/<?php echo getPath($row['pic'],'scheme'); ?>"><img src="images/pic.png" width="63" height="50" align="absmiddle" />查看当前图片</a></td>
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
<script language="javascript" type="text/javascript">
this.imagePreview = function(){   

   xOffset = 10;

   yOffset = 20;

$("a.preview").hover(function(e){

   $("#preview").html("<img src='"+$(this).attr('pic')+"' />");

   $("#preview")

    .css("top",(e.pageY - xOffset) + "px")

    .css("left",(e.pageX + yOffset) + "px")

	.show();

    },

function(){

	$("#preview").hide();

    }); 

	$("a.preview").mousemove(function(e){

   		$("#preview")

    	.css("top",(e.pageY - xOffset) + "px")

    	.css("left",(e.pageX + yOffset) + "px");

	});   

};

$(document).ready(function(){

imagePreview();

});

</script>
<div id='preview'></div>
<?php
mysql_free_result($rs);
mysql_close($conn);
?>
</body>
</html>