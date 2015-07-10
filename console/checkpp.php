<?php
header("Content-type: text/html; charset=utf-8"); 
include_once("../inc/session_check.php");
include_once("../inc/function.php");
include_once("../inc/config.php");
include_once("../inc/conn.php");

$sql="select id from hy_product_parameter where product_id=0 or parameter_id=0";
$rs=mysql_query($sql,$conn);
echo "Error Data Detected: ".mysql_num_rows($rs);
echo "<hr />";

$sql="delete from hy_product_parameter where product_id=0 or parameter_id=0";
if(mysql_query($sql,$conn)){
	echo "Error Data Have been Deleted！";
	echo "<hr />";
}else{
	msg("Failure to Del Error Data:");
	mysql_close($conn);
	exit(mysql_error());	
}

echo "Repairing Data: ";
echo "<br />";
echo "<br />";

$c=0;
$myParameters='';

$sql="select id,fid from hy_product where fid>0";
$rs=mysql_query($sql,$conn);
while($prow=mysql_fetch_assoc($rs)){
	$pcrow=mysql_fetch_assoc(mysql_query('select id from hy_product_category where id='.$prow['fid']));//取得产品栏目ID product_category=PC
	$pcprs=mysql_query('select * from hy_product_category_parameter where fid='.$pcrow['id']);//栏目下全部参数 product_category_parameter=PCP
	$pcpNum=mysql_num_rows($pcprs);

	while($pcprow=mysql_fetch_assoc($pcprs)){
		//查询产品与参数对应关系，product_parameter=PP
		$ppSql='select id from hy_product_parameter where product_id='.$prow['id']." and parameter_id=".$pcprow['id'];
		$pprs=mysql_query($ppSql,$conn);
		if(mysql_num_rows($pprs)<1){
			$fixSql="insert into hy_product_parameter(product_id,parameter_id)values(".$prow['id'].",".$pcprow['id'].")";
			if(mysql_query($fixSql,$conn)){
				echo $ppSql;
				echo "<br /><br />";
				echo $fixSql;
				echo "<br /><br />";
				echo "<hr />";
				$c++;
			}else{
				echo "Failure to Fix:".$fixSql;
				mysql_close($conn);
				exit(mysql_error());
			}
		}
	}

	//修复后检测该产品的旗下数值
	$myValueNum=mysql_num_rows(mysql_query('select id from hy_product_parameter where product_id='.$prow['id']));
	if($pcpNum!=$myValueNum){
		echo "<p>+++++++++++++++++++++++++++++++</p>";
		echo "产品ID：".$prow['id']."（".$myValueNum."），栏目ID:".$prow['fid']."(".$pcpNum.") 参数数量不符！";
		echo "<p>+++++++++++++++++++++++++++++++</p>";
	}
}
echo "<hr />";
echo "Repaired:".$c;
echo "<hr />";
?>