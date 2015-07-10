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
.STYLE4 {
	color: #999999;
}
#preview{
	display:none;
	position:absolute;
}
#pp td{padding:0px}
-->
</style>
<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
</head>
<body>
<?php
if(isset($_GET["id"])&&is_numeric($_GET["id"])){
	$sql="select * from hy_product where id=".$_GET["id"];
	$rs=mysql_query($sql,$conn);
	$row=mysql_fetch_assoc($rs);
}
?>
<table width="99%" height="1085" border="0" cellpadding="0" cellspacing="0" id="pp">
  <tr>
    <td width="17" valign="top" background="images/mail_leftbg.gif"><img src="images/left-top-right.gif" width="17" height="29" /></td>
    <td valign="top" background="images/content-bg.gif"><table width="100%" height="31" border="0" cellpadding="0" cellspacing="0" class="left_topbg" id="table2">
      <tr>
        <td height="31"><div class="titlebt">产品信息</div></td>
      </tr>
    </table></td>
    <td width="16" valign="top" background="images/mail_rightbg.gif"><img src="images/nav-right-bg.gif" width="16" height="29" /></td>
  </tr>
  <tr>
    <td height="995" valign="middle" background="images/mail_leftbg.gif">&nbsp;</td>
    <td valign="top" bgcolor="#F7F8F9"><p>&nbsp;</p>
     <form action="add_do.php" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return chk();">
       <table width="99%" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC" class="line_table">
         <tr>
           <td width="104" height="32" align="center" bgcolor="#FFFFFF">所属栏目：</td>
           <td width="1011" height="32" bgcolor="#FFFFFF">
<?php
$sql1="select * from hy_product_category where id=".$row["fid"];
$rs1=mysql_query($sql1,$conn);
$row1=mysql_fetch_assoc($rs1);
mysql_free_result($rs1);

if($row1["fid"]>0){	
	$sql2="select * from hy_product_category where id=".$row1["fid"];
	$rs2=mysql_query($sql2,$conn);
	$row2=mysql_fetch_assoc($rs2);
	mysql_free_result($rs2);
	if($row2["fid"]>0){
		$sql3="select * from hy_product_category where id=".$row2["fid"];
		$rs3=mysql_query($sql3,$conn);
		$row3=mysql_fetch_assoc($rs3);
		mysql_free_result($rs3);
		echo $row3["name"]." <font color='gray'>>></font> ".$row2["name"]." <font color='gray'>>></font> ".$row1["name"];
	}else{
		echo $row2["name"]." <font color='gray'>>></font> ".$row1["name"];
	}
}else{
	echo $row1["name"];
}
?>           </td>
         </tr>
         
         <tr>
           <td height="70" align="center" bgcolor="#FFFFFF">缩略图：</td>
           <td height="70" bgcolor="#FFFFFF"><img src="../uploads/<?php echo getPath($row['thumb'],'thumb'); ?>" /></td>
         </tr>
         <tr>
           <td height="32" align="center" bgcolor="#FFFFFF">名称：</td>
           <td height="32" bgcolor="#FFFFFF"><?php echo $row["name"]?></td>
         </tr>
         <tr>
           <td height="154" align="center" bgcolor="#FFFFFF">描述：</td>
           <td valign="middle" bgcolor="#FFFFFF"><?php echo $row["description"]?></td>
         </tr>
         <tr>
           <td height="154" align="center" bgcolor="#FFFFFF">特性：</td>
           <td valign="middle" bgcolor="#FFFFFF"><?php echo $row["feature"]?></td>
         </tr>
         <tr>
           <td height="154" align="center" bgcolor="#FFFFFF">参数：</td>
           <td bgcolor="#FFFFFF">
           <table width="59%" height="60" border="0" cellpadding="0" cellspacing="1" bgcolor="#999999" id="bsinfo">
        <tr>         
          <th width="216" height="23" align="center" background="images/news-title-bg.gif" bgcolor="#FAFCFC"><span class="STYLE2">参数名称</span></th>
          <th width="241" align="center" background="images/news-title-bg.gif" bgcolor="#FAFCFC">参数值</th>
           <th width="193" align="center" background="images/news-title-bg.gif" bgcolor="#FAFCFC"><font color="#999">产品名称</font></th>  
           <th width="200" align="center" background="images/news-title-bg.gif" bgcolor="#FAFCFC"><font color="#999">栏目名称</font></th>      
          </tr>
<?php
$sql="SELECT pc.id as category_id,pc.name as category_name,p.id as product_id,p.name as product_name,p.fid as product_fid,pcp.id as parameter_id,pcp.name as parameter_name,pcp.fid as parameter_fid,pp.myvalue FROM hy_product_parameter as pp left join `hy_product_category_parameter` as pcp on pp.parameter_id=pcp.id left join hy_product as p on pp.product_id=p.id left join hy_product_category as pc on pcp.fid=pc.id where p.id=".$_GET["id"];
$rs=mysql_query($sql,$conn);
while($row=mysql_fetch_assoc($rs)){
?>
        <tr>          
          <td height="22" align="center"><?php echo $row['parameter_name'] ?></td>
          <td align="center"><?php echo $row['myvalue'] ?></td>
          <td align="center"><font color="#CCCCCC"><?php echo $row['product_name'] ?></font></td>
          <td align="center"><font color="#CCCCCC"><?php echo $row['category_name'] ?></font></td>       
          </tr>
<?php
}
?>
      </table>
           </td>
         </tr>
         <tr>
           <td height="154" align="center" bgcolor="#FFFFFF">方框图：</td>
           <td valign="middle" bgcolor="#FFFFFF"><table width="59%" height="72" border="0" cellpadding="0" cellspacing="1" bgcolor="#999999" id="bsinfo2">
             <tr>
               <th width="308" height="23" align="center" background="images/news-title-bg.gif" bgcolor="#FAFCFC"><span class="STYLE2">名称</span></th>
               <th width="361" align="center" background="images/news-title-bg.gif" bgcolor="#FAFCFC">图片</th>
               </tr>
             <?php
$sql="select * from hy_product_scheme where fid= {$_GET["id"]} order by id desc";
$rs=mysql_query($sql,$conn);
while($row=mysql_fetch_assoc($rs)){
?>
             <tr>
               <td height="22" align="center"><?php echo $row['name'] ?></td>
               <td align="center"><a href="../uploads/<?php echo getPath($row['pic'],'scheme'); ?>" target="_blank" onclick="javascript:void(0)" class="preview" pic="../uploads/<?php echo getPath($row['pic'],'scheme'); ?>">查看图片</a></td>
               </tr>
             <?php
}
?>
           </table></td>
         </tr>
         <tr>
           <td height="154" align="center" bgcolor="#FFFFFF">附件：</td>
           <td valign="middle" bgcolor="#FFFFFF"><table width="59%" height="60" border="0" cellpadding="0" cellspacing="1" bgcolor="#999999" id="bsinfo3">
             <tr>
               <th width="307" height="23" align="center" background="images/news-title-bg.gif" bgcolor="#FAFCFC"><span class="STYLE2">附件名称</span></th>
               <th width="293" align="center" background="images/news-title-bg.gif" bgcolor="#FAFCFC">文件名</th>
               <th width="410" align="center" background="images/news-title-bg.gif" bgcolor="#FAFCFC">上传时间</th>
               </tr>
             <?php
$sql="select * from hy_product_file where fid= {$_GET["id"]} order by id desc";
$rs=mysql_query($sql,$conn);
while($row=mysql_fetch_assoc($rs)){
?>
             <tr>
               <td height="22" align="center"><?php echo $row['name'] ?></td>
               <td align="center"><a href="../uploads/<?php echo getPath($row['file'],'file'); ?>"><?php echo $row['file'] ?></a></td>
               <td width="410" align="center"><?php echo $row['upload_time'] ?></td>
               </tr>
             <?php
}
?>
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
<script>
var TbRow = document.getElementById("bsinfo");
if (TbRow != null)
{
	for (var i=0;i<TbRow.rows.length ;i++ ){
		if (TbRow.rows[i].rowIndex%2==1){
		TbRow.rows[i].style.backgroundColor="#fff";
		}else{
		TbRow.rows[i].style.backgroundColor="#ccc";
		}
	}
}

var TbRow = document.getElementById("bsinfo2");
if (TbRow != null)
{
	for (var i=0;i<TbRow.rows.length ;i++ ){
		if (TbRow.rows[i].rowIndex%2==1){
		TbRow.rows[i].style.backgroundColor="#fff";
		}else{
		TbRow.rows[i].style.backgroundColor="#ccc";
		}
	}
}

var TbRow = document.getElementById("bsinfo3");
if (TbRow != null)
{
	for (var i=0;i<TbRow.rows.length ;i++ ){
		if (TbRow.rows[i].rowIndex%2==1){
		TbRow.rows[i].style.backgroundColor="#fff";
		}else{
		TbRow.rows[i].style.backgroundColor="#ccc";
		}
	}
}

</script>
<?php
mysql_free_result($rs);
mysql_close($conn);
?>
</body>
</html>