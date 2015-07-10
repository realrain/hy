<?php
include_once("../inc/session_check.php");
include_once("../inc/function.php");

if(empty($_GET["title"])&&empty($_GET["fid"])){
  header("Content-type: text/html; charset=utf-8"); 
  msg("Invalid Argument!");
  jump("article_list.php");
}

include_once("../inc/config.php");
include_once("../inc/conn.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>List</title>
<link href="images/skin.css" rel="stylesheet" type="text/css" />
<link href="images/boxy.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #EEF2FB;
}
.gridViewItem {
	BORDER-RIGHT: #bad6ec 1px solid; BORDER-TOP: #bad6ec 1px solid; BORDER-LEFT: #bad6ec 1px solid; LINE-HEIGHT: 32px; BORDER-BOTTOM: #bad6ec 1px solid; TEXT-ALIGN: center
}
.STYLE1 {color: #FF0000}
#ctip {
	height: 100px;
	width: 800px;
	text-align:center;
	margin-left: -400px;
	position: absolute;
	left: 50%;
	top: 50%;
	margin-top: -50px;
	background-color: #FFFFFF;
	border: 3px solid #999999;
	display: none;
}
.page {
	letter-spacing: 1px;
	color: #000;
}
.page b{
	color: #000;
}
.page a{
	padding: 3px;
	text-decoration: underline;
}
.page a:link{
	color: #000;
}
.page a:visited{
	color: #000;
}
.page a:hover{
	color: #000;
	background-color: #66CCFF;
	text-decoration: none;
}
.page a:active{
	color: #000;
}
#preview{

	display:none;

	position:absolute;

}
-->
</style>
<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="../js/jquery.boxy.js"></script>
<script type='text/javascript'>
$(function() {
	$("a.del").click(function() {
		var get_url=$(this).attr('href');	
		var get_title=$(this).attr('title');
		Boxy.confirm("确定要删除 <b>"+get_title+"</b> 吗？", function() { 
			$.ajax({
				type: "GET",
				url: get_url,
				success: function(msg){
					if(msg.indexOf('信息删除成功')>-1){
						$("#ctip").html("<img src='images/del_ok.jpg' width='300' height='92' />").fadeIn(1000);
						setTimeout("go()",777);
						window.setTimeout(function(){go()},777);
					}else{			
						$("#ctip").text(msg).fadeIn(1000);
					}
				}
			});
		 }, {title: "提示信息"});
		return false;
	});
});
function go(){
	location.href="article_list.php";
}

function checkit(wow){
  str=document.getElementById(wow).value;
  str=str.replace(/'/g,""); 
  str=str.replace(/"/g,"");
  str=str.replace(/`/g,"");
  str=str.replace(/\\/g,"");
  str=str.replace(/ /g,"");
  str=str.replace(/ /g,"");
  if(str==""){
    alert('请输入搜索内容');
    document.getElementById(wow).focus();
    document.getElementById(wow).style.border="1px dashed red";
    return true;
  }
}
function chk(){
  if(checkit("title")){
    return false;
  }
  return true;
}
</script>
</head>
<body>
<?php
$sql="select * from hy_category";
$rs=mysql_query($sql,$conn);
while($row=mysql_fetch_assoc($rs)){
	$cate_array[$row['id']]=$row['name'];//set cate id(article fid) as cate name
}

$title='';//为了分页方便
$fid=0;
$p=1;

if(!empty($_GET["title"])){
	$title=myfilter($_GET["title"],3);
}

if(!empty($_GET["fid"])){
	$fid=intval($_GET["fid"]);
}

if(!empty($_GET["p"])){
	$p=intval($_GET["p"]);
}

if(!empty($_GET["title"])&&empty($fid)){	
	$cSql="select id from hy_article where title like '%{$title}%'";
	$pSql="select * from hy_article where title like '%{$title}%'";
	$condition="标题中含有'{$title}'";
}

if(empty($_GET["title"])&&!empty($fid)){	
	$cSql="select id from hy_article where fid={$fid}";
	$pSql="select * from hy_article where fid={$fid}";
	$condition="栏目为 {$cate_array[$fid]}";
}

if(!empty($_GET["title"])&&!empty($fid)&&intval($fid)>0){
	$cSql="select id from hy_article where title like '%{$title}%' and fid={$fid}";
	$pSql="select * from hy_article where title like '%{$title}%' and fid={$fid}";
	$condition="标题中含有'{$title}' 且 栏目为 {$cate_array[$fid]}";
}

$pagex=new page_lister_7x($mysqlhost,$mysqlname,$mysqlpsw,$mydata,$cSql,$pSql,"12","7");
?>
<table width="99%" height="393" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="17" valign="top" background="images/mail_leftbg.gif"><img src="images/left-top-right.gif" width="17" height="29" /></td>
    <td valign="top" background="images/content-bg.gif"><table width="100%" height="31" border="0" cellpadding="0" cellspacing="0" class="left_topbg" id="table2">
      <tr>
        <td height="31"><div class="titlebt">管理文章</div></td>
      </tr>
    </table></td>
    <td width="16" valign="top" background="images/mail_rightbg.gif"><img src="images/nav-right-bg.gif" width="16" height="29" /></td>
  </tr>
  <tr>
    <td height="345" valign="middle" background="images/mail_leftbg.gif">&nbsp;</td>
    <td valign="top" bgcolor="#F7F8F9">
      
      <table width="97%" height="119" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC" id="bsinfo">
      <tr>
          <th height="23" align="center" bgcolor="#FFFFFF">搜索条件：</th>
          <th height="23" colspan="6" align="left" bgcolor="#FFCC99"><?php echo $condition ?></th>
        </tr>
      <?php
	  if(isset($_GET["fid"])&&is_numeric($_GET["fid"])&&intval($_GET["fid"])>0){
	  ?>        
        <tr>
          <th height="23" align="center" bgcolor="#FFFFFF"><img src="images/down.gif" width="32" height="32" /></th>
          <th height="23" colspan="6" bgcolor="#FFCC99"><div align="left">当前显示的是 <font color="#FF0000"><?php echo $cate_array[$_GET["fid"]] ?></font> 下的全部文章，<a href="category.php">返回栏目总列表</a> <a href="article_list.php">返回文章总列表</a></div></th>
        </tr>
      <?php
	  }
	  ?>  
        <tr>
          <th width="4%" height="23" align="center" background="images/news-title-bg.gif" bgcolor="#FAFCFC"><span class="STYLE2">ID</span></th>
          <th width="29%" height="23" align="center" background="images/news-title-bg.gif" bgcolor="#FAFCFC"><span class="STYLE2">标题</span></th>
          <th width="11%" height="23" align="center" background="images/news-title-bg.gif" bgcolor="#FAFCFC">所属栏目</th>
          <th width="12%" align="center" background="images/news-title-bg.gif" bgcolor="#FAFCFC"><span class="STYLE2">创建时间</span></th>
          <th width="7%" align="center" background="images/news-title-bg.gif" bgcolor="#FAFCFC">查看</th>
          <th width="5%" height="23" align="center" background="images/news-title-bg.gif" bgcolor="#FAFCFC"><span class="STYLE2">编辑</span></th>
          <th width="11%" height="23" align="center" background="images/news-title-bg.gif" bgcolor="#FAFCFC"><span class="STYLE2">删除</span></th>
        </tr>
        <form method="get" action="article_search.php" target="_blank" onsubmit="return chk()">
        <tr onMouseOver="this.style.backgroundColor='#E4EEF8'" onMouseOut="this.style.backgroundColor='#F7F8F9'">
          <td height="22" align="center">&nbsp;</td>
          <td height="22" style="padding-left:7px"><input type="text" name="title" id="title" /></td>          
          <td height="22" align="center">
          <select name="fid" id="fid" onchange="javascript:location.href=this.options[selectedIndex].getAttribute('url')">
          <option value="0" url="?title=<?php echo $title ?>&fid=0">请选择栏目</option>
<?php
$sql1="select * from hy_category where fid=0 order by id desc";
$rs1=mysql_query($sql1,$conn);
while($row1=mysql_fetch_assoc($rs1)){
	if($fid==$row1["id"]){
		echo "<option value={$row1['id']} url='?title={$title}&fid=".$row1["id"]."' selected='selected'>".$row1["name"]."</option>";
	}else{
		echo "<option value={$row1['id']} url='?title={$title}&fid=".$row1["id"]."'>".$row1["name"]."</option>";
	}
	$sql2="select * from hy_category where fid=".$row1["id"]." order by id desc";
    $rs2=mysql_query($sql2,$conn);
    while($row2=mysql_fetch_assoc($rs2)){
		if($fid==$row2["id"]){
		echo "<option value={$row2['id']} url='?title={$title}&fid=".$row2["id"]."' selected='selected'>﹂".$row2["name"]."</option>";
		}else{
		echo "<option value={$row2['id']} url='?title={$title}&fid=".$row2["id"]."'>﹂".$row2["name"]."</option>";
		}
		$sql3="select * from hy_category where fid=".$row2["id"]." order by id desc";
        $rs3=mysql_query($sql3,$conn);
        while($row3=mysql_fetch_assoc($rs3)){
			if($fid==$row3["id"]){
			echo "<option value={$row3['id']} url='?title={$title}&fid=".$row3["id"]."' selected='selected'>﹂﹂".$row3["name"]."</option>";
			}else{
			echo "<option value={$row3['id']} url='?title={$title}&fid=".$row3["id"]."'>﹂﹂".$row3["name"]."</option>";
			}
		}
		mysql_free_result($rs3);
	}
	mysql_free_result($rs2);
}
mysql_free_result($rs1);
?>
</select>
          </td>
          
          <td align="center">&nbsp;</td>
          <td align="center">&nbsp;</td>
          <td height="22" align="center">&nbsp;</td>
          <td height="22" align="center">&nbsp;</td>
        </tr>
        </form>
                
        
<?php
while($row=mysql_fetch_assoc($pagex->rs)){
?>        
        <tr onMouseOver="this.style.backgroundColor='#E4EEF8'" onMouseOut="this.style.backgroundColor='#F7F8F9'">
          <td height="22" align="center"><?php echo $row['id'] ?></td>
          <td height="22" style="padding-left:7px"><?php echo $row['title'] ?></td>
          <td height="22" align="center"><a href="article_list.php?fid=<?php echo $row['fid'] ?>"><?php echo $cate_array[$row['fid']] ?></a></td>
          <td align="center"><?php echo $row['create_time'] ?></td>
          <td align="center"><a href="article_detail.php?id=<?php echo $row["id"] ?>" target="_blank">查看详细信息</a></td>
          <td height="22" align="center"><a href="article_modify.php?id=<?php echo $row['id'] ?>"><img src="images/write.png" width="29" height="29" /></a></td>
          <td height="22" align="center"><a href="del.php?id=<?php echo $row['id'] ?>&type=1" title="<?php echo $row['title'] ?>" class="del"><img src="images/del.png" width="23" height="26" /></a></td>
        </tr>
<?php
}
$pagex->bye();
?>
      </table>
      <table width="97%" height="26" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td align="center">
<?php
$pagex->show("fid=".$fid."&title=".$title," 跳转到");
?></td>
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
<script language="javascript" type="text/javascript">
var TbRow = document.getElementById("bsinfo");
if (TbRow != null)
{
	for (var i=0;i<TbRow.rows.length ;i++ ){
		TbRow.rows[i].style.backgroundColor="#F7F8F9";
	}
}
</script>
<div id="ctip"></div>
<div id='preview'></div>
<?php
mysql_free_result($rs);
mysql_close($conn);
?>
</body>
</html>