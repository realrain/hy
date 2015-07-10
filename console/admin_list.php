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
<title>Admin</title>

<link href="images/skin.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #EEF2FB;
}
-->
</style>
<body>
<?php
if($_SESSION["hy_utype"]!=1){
	msg("你无权查看本页面！");
	jump("main.php");
}
?>
<table width="100%" height="393" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="17" valign="top" background="images/mail_leftbg.gif"><img src="images/left-top-right.gif" width="17" height="29" /></td>
    <td valign="top" background="images/content-bg.gif"><table width="100%" height="31" border="0" cellpadding="0" cellspacing="0" class="left_topbg" id="table2">
      <tr>
        <td height="31"><div class="titlebt">管理员</div></td>
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
          <td width="98%" background="images/news-title-bg.gif" class="left_bt2">管理员列表</td>
        </tr>
        <tr>
          <td height="102" valign="top">&nbsp;</td>
          <td height="102" valign="top"><p>&nbsp;</p>
            <table width="99%" height="52" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#999999" id="bsinfo">
      <tr>
        <th width="4%" height="23" align="center" background="images/news-title-bg.gif" bgcolor="#FAFCFC"><span class="STYLE2">ID</span></th>
        <th width="14%" height="23" align="center" background="images/news-title-bg.gif" bgcolor="#FAFCFC"><span class="STYLE2">用户名</span></th>
        <th width="10%" align="center" background="images/news-title-bg.gif" bgcolor="#FAFCFC">备注</th>
        <th width="9%" align="center" background="images/news-title-bg.gif" bgcolor="#FAFCFC">权限类型</th>
        <th width="16%" height="23" align="center" background="images/news-title-bg.gif" bgcolor="#FAFCFC"><span class="STYLE2">上次登录时间</span></th>
        <th width="11%" align="center" background="images/news-title-bg.gif" bgcolor="#FAFCFC">上次登录IP</th>
        <th width="17%" align="center" background="images/news-title-bg.gif" bgcolor="#FAFCFC">创建时间</th>
        <th width="8%" height="23" align="center" background="images/news-title-bg.gif" bgcolor="#FAFCFC"><span class="STYLE2">修改</span></th>
        <th width="11%" height="23" align="center" background="images/news-title-bg.gif" bgcolor="#FAFCFC"><span class="STYLE2">删除</span></th>
      </tr>
<?php
$sql="select * from hy_admin order by id desc";
$rs=mysql_query($sql,$conn);
while($row=mysql_fetch_assoc($rs)){
?>
      
      <tr>
        <td height="33" align="center"><?php echo $row["id"] ?></td>
        <td height="33" align="center"><?php echo $row["name"] ?></td>
        <td align="center"><?php echo $row["remark"] ?></td>
        <td height="33" align="center">
		<?php
		switch($row["type"]){
			case 1:
			echo "超级管理员";
			break;
			case 2:
			echo "普通管理员";
			break;
		}
		 ?></td>
        <td height="33" align="center"><?php echo $row['last_time']!=""?date("Y-m-d H:i:s",$row['last_time']):"" ?></td>
        <td height="33" align="center"><a href="http://ip138.com/ips138.asp?ip=<?php echo $row["last_ip"] ?>&action=2" target="_blank" style="text-decoration: underline"><?php echo $row["last_ip"] ?></a></td>
        <td height="33" align="center"><?php echo $row['create_time'] ?></td>
        <td height="33" align="center"><a href="admin_modify.php?id=<?php echo $row['id'] ?>"><img src="images/write.png" width="29" height="29" /></a></td>
        <td height="33" align="center"><a href="del.php?id=<?php echo $row['id'] ?>&type=admin" onclick='return really()'><img src="images/del.png" width="23" height="26" /></a></td>
      </tr>
<?php
}
mysql_free_result($rs);
mysql_close($conn);
?>
</table>
          <p>&nbsp;</p></td>
        </tr>
        <tr>
          <td height="5" colspan="2">&nbsp;</td>
        </tr>
      </table>      <p>&nbsp;</p></td>
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
		if (TbRow.rows[i].rowIndex%2==1){
		TbRow.rows[i].style.backgroundColor="#fff";
		}else{
		TbRow.rows[i].style.backgroundColor="#ccc";
		}
	}
}
function really(){
var r=confirm("确定要删除此用户吗？删除后将不可恢复！")
	if (r!=true)
	{
	return false;
	}
}
</script>
</body>
</html>