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
li{
	list-style-type: none;
	height: 33px;
	width: 97%;
	line-height: 33px;
}
li a{
	text-align: center;
	padding-left: 12px;
	color: #FFFFFF;
	font-size: 14px;
}
li a:hover{
	text-align: center;
	padding-left: 12px;
	color: #FFFFFF;
}
.f0 {
	background-color: #7695BA;
	margin-top: 7px;
	color: #FFFFFF;
	padding-left: 7px;
	font-weight: bold;
	font-size: 18px;
}
.f1 {
	background-color: #75869A;
	text-indent: 12px;
	color: #FFFFFF;
	padding-left: 7px;
	font-size: 16px;
}
.f2 {
	background-color: #9DAABB;
	text-indent: 24px;
	color: #FFFFFF;
	padding-left: 7px;
	font-size: 14px;
}
a.cate{padding-left:0px;color:#fff}
a.cate:hover{
	padding-left: 0px;
	color: #fff
}
#catecount{
	font-size: 12px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #EAEAEA;
}
#catecount b{
	font-size: 14px;
	font-family: Georgia, "Times New Roman", Times, serif;
	color: #E1EDA0;
}
-->
</style>
</head>
<body>
<table width="99%" height="393" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="17" valign="top" background="images/mail_leftbg.gif"><img src="images/left-top-right.gif" width="17" height="29" /></td>
    <td width="1079" valign="top" background="images/content-bg.gif"><table width="100%" height="31" border="0" cellpadding="0" cellspacing="0" class="left_topbg" id="table2">
      <tr>
        <td height="31"><div class="titlebt">管理栏目</div></td>
      </tr>
    </table></td>
    <td width="22" valign="top" background="images/mail_rightbg.gif"><img src="images/nav-right-bg.gif" width="16" height="29" /></td>
  </tr>
  <tr>
    <td width="17" height="345" valign="middle" background="images/mail_leftbg.gif">&nbsp;</td>
    <td valign="top" bgcolor="#F7F8F9">
      <table width="100%" height="373" border="0" align="center" cellpadding="0" cellspacing="0" class="line_table">
        
        <tr>
          <td height="302" valign="top" style="padding-left:12px">
          <ul>
<?php
$sql1="select * from hy_product_category where fid=0 order by id asc";
$rs1=mysql_query($sql1,$conn);
while($row1=mysql_fetch_assoc($rs1)){
?>
<li class="f0" onMouseOver="this.style.backgroundColor='#51749F'" onMouseOut="this.style.backgroundColor='#7695BA'">
	<a href="product_list.php?fid=<?php echo $row1["id"] ?>" class="cate" style="font-size:18px"><?php echo $row1["name"] ?></a>
	<a href="product_subcate_add.php?fid=<?php echo $row1["id"] ?>&depth=2&tag=0"><img src="images/note_add.png" width="32" height="32" align="absmiddle" />添加子栏目</a>
    <a href="parameter_list.php?fid=<?php echo $row1["id"] ?>&depth=1"><img src="images/parameter.png" width="32" height="32" align="absmiddle" />参数管理</a>
	<a href="product_add.php?fid=<?php echo $row1["id"] ?>&depth=1"><img src="images/document_add.png" width="32" height="32" align="absmiddle" />添加产品</a>
	<a href="product_category_modify.php?id=<?php echo $row1["id"] ?>"><img src="images/book_edit.png" width="35" height="32" align="absmiddle" />修改</a>
	<a href="del.php?id=<?php echo $row1["id"] ?>&type=8" onclick='return really()'><img src="images/remove.png" width="32" height="32" align="absmiddle" />删除 </a>

	<img src="images/id.png" width="32" height="32" align="absmiddle" /><span id="catecount">id:<b><?php echo $row1["id"] ?></b>，子栏目：<b><?php echo mysql_num_rows(mysql_query("select id from hy_product_category where fid=".$row1["id"],$conn)) ?></b>个，文章：<b><?php echo mysql_num_rows(mysql_query("select id from hy_product where fid=".$row1["id"],$conn)) ?></b>篇，产品参数：<b><?php echo mysql_num_rows(mysql_query("select id from hy_product_category_parameter where fid=".$row1["id"],$conn)) ?></b>个</span></li>
<?php
    $sql2="select * from hy_product_category where fid=".$row1["id"]." order by id asc";
    $rs2=mysql_query($sql2,$conn);
    while($row2=mysql_fetch_assoc($rs2)){
    ?>
    <li class="f1" onMouseOver="this.style.backgroundColor='#505E6D'" onMouseOut="this.style.backgroundColor='#75869A'">
    	<a href="product_list.php?fid=<?php echo $row2["id"] ?>" class="cate" style="font-size:16px"><?php echo $row2["name"] ?></a>
    	<a href="product_subcate_add.php?fid=<?php echo $row2["id"] ?>&depth=2&tag=0"><img src="images/note_add.png" align="absmiddle" />添加子栏目</a> 
        <a href="parameter_list.php?fid=<?php echo $row2["id"] ?>&depth=2"><img src="images/parameter.png" width="32" height="32" align="absmiddle" />参数管理</a>
    	<a href="product_add.php?fid=<?php echo $row2["id"] ?>&depth=2"><img src="images/document_add.png" width="32" height="32" align="absmiddle" />添加产品</a> 
    	<a href="product_category_modify.php?id=<?php echo $row2["id"] ?>"><img src="images/book_edit.png" width="35" height="32" align="absmiddle" />修改</a>
    	<a href="del.php?id=<?php echo $row2["id"] ?>&type=8" onclick='return really()'><img src="images/remove.png" width="32" height="32" align="absmiddle" />删除 </a>
    	<img src="images/id.png" width="32" height="32" align="absmiddle" /><span id="catecount">id:<b><?php echo $row2["id"] ?></b>，子栏目：<b><?php echo mysql_num_rows(mysql_query("select id from hy_product_category where fid=".$row2["id"],$conn)) ?></b>个，文章：<b><?php echo mysql_num_rows(mysql_query("select id from hy_product where fid=".$row2["id"],$conn)) ?></b>篇，产品参数：<b><?php echo mysql_num_rows(mysql_query("select id from hy_product_category_parameter where fid=".$row2["id"],$conn)) ?></b>个</span></li>

    <?php
        $sql3="select * from hy_product_category where fid=".$row2["id"]." order by id asc";
        $rs3=mysql_query($sql3,$conn);
        while($row3=mysql_fetch_assoc($rs3)){
        ?>
        <li class="f2" onMouseOver="this.style.backgroundColor='#5E6F86'" onMouseOut="this.style.backgroundColor='#9DAABB'">
        	<a href="product_list.php?fid=<?php echo $row3["id"] ?>" class="cate" style="font-size:14px"><?php echo $row3["name"] ?></a>
            <a href="parameter_list.php?fid=<?php echo $row3["id"] ?>&depth=3"><img src="images/parameter.png" width="32" height="32" align="absmiddle" />参数管理</a>
        	<a href="product_add.php?fid=<?php echo $row3["id"] ?>&depth=3"><img src="images/document_add.png" width="32" height="32" align="absmiddle" />添加产品</a> 
        	<a href="product_category_modify.php?id=<?php echo $row3["id"] ?>"><img src="images/book_edit.png" width="35" height="32" align="absmiddle" />修改</a> 
        	<a href="del.php?id=<?php echo $row3["id"] ?>&type=8" onclick='return really()'><img src="images/remove.png" width="32" height="32" align="absmiddle" />删除 </a>
        	<img src="images/id.png" width="32" height="32" align="absmiddle" /><span id="catecount">id:<b><?php echo $row3["id"] ?></b>，文章：<b><?php echo mysql_num_rows(mysql_query("select id from hy_product where fid=".$row3["id"],$conn)) ?></b>篇，产品参数：<b><?php echo mysql_num_rows(mysql_query("select id from hy_product_category_parameter where fid=".$row3["id"],$conn)) ?></b>个</span></li>
        <?php 
			}
		}
	}
   ?>
          </ul>          </td>
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
mysql_free_result($rs1);
@mysql_free_result($rs2);
@mysql_free_result($rs3);
mysql_close($conn);
?>
<script language="javascript" type="text/javascript">

function really(){

var r=confirm("确定要删除此栏目吗？")

	if (r!=true)

	{

	return false;

	}

}
</script>
</body>
</html>