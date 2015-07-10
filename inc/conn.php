<?php
$conn=mysql_connect($mysqlhost,$mysqlname,$mysqlpsw) or exit("连接数据库出错:".mysql_error());
mysql_select_db($mydata) or exit("选择数据库出错:".mysql_error());
mysql_query("set names 'utf8'");
?>