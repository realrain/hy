<?php
include_once("../inc/session_check.php");
include_once("../inc/function.php");

if(empty($_POST)&&empty($_GET)){
	msg('Error：Invalid Request!');
	if(!empty($_SERVER['HTTP_REFERER'])){
		jump($_SERVER['HTTP_REFERER']);
	}
	exit;
}

include_once("../inc/config.php");
include_once("../inc/conn.php");

if(!empty($_POST["type"])&&$_POST["type"]=="banner"){//banner
	if($_FILES["pic"]["name"]==''){
		msg('请上传文件!');
		jump($_SERVER['HTTP_REFERER']);
	}

	$rs=uploadPix("pic","banner");

	if($rs['error']>0){
		msg($rs['errorMsg']);
		jump($_SERVER['HTTP_REFERER']);
	}

	$sql="insert into hy_banner(pic,link)values('".$rs["fileName"]."','".$_POST["link"]."')";
	if(mysql_query($sql,$conn)){
		//msg("添加成功");
	}else{
		msg("失败了！");
		exit(mysql_error());
		mysql_close($conn);
	}
	mysql_close($conn);
	jump("banner_list.php");
}

if(!empty($_POST["type"])&&$_POST["type"]=="pic"){//pic
	if(!empty($_FILES["pic"]["tmp_name"])&&!empty($_POST["name"])){
		if($_FILES["pic"]['size']>1000000){
			msg("文件太大了，请控制在1MB内。");
			echo "<script>history.back()</script>";
			exit();
		}
	
		$hi=upload_pic("pic");
		if($hi=="type_error"){
			mysql_close($conn);
			msg("文件类型不正确，只允许jpg,gif,jpeg！");
			jump("pic_add.php");
		}

		if($hi=="upload_error"){
			mysql_close($conn);
			msg("文件上传失败！");
			jump("pic_add.php");
		}

		$pic=$hi;
		$sql="insert into wode_pic(name,pic,link)values('".$_POST["name"]."','".$pic."','".$_POST["link"]."')";
		if(mysql_query($sql,$conn)){
			msg("添加成功");
		}else{
			msg("失败了！");
			mysql_close($conn);
			jump("pic_add.php");
		}

		mysql_close($conn);
		jump("pic_list.php");
	}else{
		msg("请将信息填写完整");
		mysql_close($conn);
		echo "<script>history.back()</script>";
		exit();
	}
}

if(!empty($_POST["type"])&&$_POST["type"]=="single"){//single
	if(isset($_POST["title"])&&isset($_POST["contents"])){
		$title=myfilter($_POST["title"],3);
		$contents=myfilter($_POST["contents"],7);
		if($title==""||$contents==""){
			echo "请将标题和详细内容填写完整";
			mysql_close($conn);
			exit();
		}
		
	$seotitle=myfilter($_POST["seotitle"],3);
    $keywords=myfilter($_POST["keywords"],3);
    $des=myfilter($_POST["des"],3);
	$creation_time=time();
    $creator=$_SESSION["hy_uid"];
	
	$sql="insert into wode_single(title,seotitle,keywords,des,contents,creation_time,creator)values('{$title}','{$seotitle}','{$keywords}','{$des}','{$contents}',{$creation_time},{$creator})";
		if(mysql_query($sql,$conn)){
			echo '单页信息添加成功';
		}else{
			echo '单页信息添加失败';
			exit(mysql_error());
		}		
	}else{
		echo '请将单页信息填写完整';
		mysql_close($conn);
		exit();
	}
}

if(!empty($_POST["type"])&&$_POST["type"]=="category"){//category
	if(isset($_POST["name"])){
		$name=myfilter($_POST["name"],3);
		if($name==""){
			echo "请将一级栏目名称填写完整";
			mysql_close($conn);
			exit();
		}
	$sql="insert into hy_category(name,fid)values('".$name."',0)";
		if(mysql_query($sql,$conn)){
			echo '一级栏目添加成功';
		}else{
			echo '一级栏目添加失败';
			exit(mysql_error());
		}		
	}else{
		echo '请将一级栏目填写完整';
		mysql_close($conn);
		exit();
	}
}

if(!empty($_POST["type"])&&$_POST["type"]=="subcate"){//subcate
	if(isset($_POST["name"])&&isset($_POST["fid"])&&is_numeric($_POST["fid"])){
		$name=myfilter($_POST["name"],3);
		if($name==""){
			echo "请将子栏目名称填写完整";
			mysql_close($conn);
			exit();
		}
	$sql="insert into hy_category(name,fid)values('".$name."',".$_POST["fid"].")";
		if(mysql_query($sql,$conn)){
			echo '子栏目添加成功';
		}else{
			echo '子栏目添加失败';
			exit(mysql_error());
		}		
	}else{
		echo '请将子栏目信息填写完整!';
		mysql_close($conn);
		exit();
	}
}

if(!empty($_POST["type"])&&$_POST["type"]=="article"){//article
	$title=myfilter($_POST["title"],3);
	$poster=myfilter($_POST["poster"],3);
    $contents=myfilter($_POST["contents"],7);
    $create_time=date("Y-m-d H:i:s");
    $creator=$_SESSION["hy_uid"];
    $fid=$_POST["fid"];  
	
	$sql="insert into hy_article(title,poster,contents,fid,create_time,creator)values('{$title}','{$poster}','{$contents}',{$fid},'{$create_time}',{$creator})";

	if(mysql_query($sql,$conn)){
		jump('article_succeed.php?fid='.$fid."&depth=".$_POST["depth"]);
	}else{
		echo '文章添加失败!错误信息:';	
		exit(mysql_error());
	}
	mysql_close($conn);
	jump("article_list.php");
}

if(!empty($_POST["type"])&&$_POST["type"]=="admin"){//admin
	if($_SESSION["hy_utype"]!=1){
		msg("你无权添加管理员！");
		jump("main.php");
	}
	$remark='';
	$creator=0;
	$is_del=0;
	if(!empty($_POST["name"])&&!empty($_POST["psw"])&&!empty($_POST["atype"])){
		if(check_name($mysqlhost,$mysqlname,$mysqlpsw,$mydata,"hy_admin","name",$_POST["name"])){
			mysql_close($conn);
			exit("该管理员已存在，请更换名称！");
		}

		if(!empty($_POST["remark"])){
			$remark=myfilter($_POST["remark"],3);
		}

		if(!empty($_POST["creator"])){
			$creator=myfilter($_POST["creator"],3);
		}

		$name=myfilter($_POST["name"],3);
		
		$sql="insert into hy_admin(name,psw,type,creator,is_del,remark,create_time)values('".$_POST["name"]."','".md5($_POST["psw"])."',".$_POST["atype"].",".$_SESSION["hy_uid"].",".$is_del.",'".$remark."','".date("Y-m-d H:i:s")."')";

		if(mysql_query($sql,$conn)){
			echo "管理员添加成功";
		}else{
			echo "管理员添加失败";
			exit(mysql_error());
		}
	}else{
		echo "请将用户名、密码、类型 填写完整！";
	}
}

if(!empty($_POST["type"])&&$_POST["type"]=="product_category"){//product_category
	if(isset($_POST["name"])){
		$name=myfilter($_POST["name"],3);
		if($name==""){
			echo "请将名称填写完整";
			mysql_close($conn);
			exit();
		}
	$sql="insert into hy_product_category(name,fid)values('".$name."',0)";
		if(mysql_query($sql,$conn)){
			echo '一级栏目添加成功';
		}else{
			echo '一级栏目添加失败';
			exit(mysql_error());
		}		
	}else{
		echo '请将一级栏目填写完整';
		mysql_close($conn);
		exit();
	}
}

if(!empty($_POST["type"])&&$_POST["type"]=="product_subcate"){//product_subcate
	if(isset($_POST["name"])&&isset($_POST["fid"])&&is_numeric($_POST["fid"])){
		$name=myfilter($_POST["name"],3);
		if($name==""){
			echo "请将子栏目名称填写完整";
			mysql_close($conn);
			exit();
		}
	$sql="insert into hy_product_category(name,fid)values('".$name."',".$_POST["fid"].")";
		if(mysql_query($sql,$conn)){
			echo '子栏目添加成功';
		}else{
			echo '子栏目添加失败';
			exit(mysql_error());
		}		
	}else{
		echo '请将子栏目信息填写完整!';
		mysql_close($conn);
		exit();
	}
}

if(!empty($_POST["type"])&&$_POST["type"]=="product"){//product

	if($_FILES["pic"]["name"]==''){
		msg('请上传缩略图!');
		jump($_SERVER['HTTP_REFERER']);
	}

	$rs=uploadPix("pic","thumb");

	if($rs['error']>0){
		msg($rs['errorMsg']);
		jump($_SERVER['HTTP_REFERER']);
	}

	$name=myfilter($_POST["name"],3);
    $description=myfilter($_POST["description"],7);
    $feature=myfilter($_POST["feature"],7);
    $create_time=date("Y-m-d H:i:s");
    $creator=$_SESSION["hy_uid"];
    $fid=$_POST["fid"];

	
	$sql="insert into hy_product(name,thumb,description,feature,fid,create_time,creator)values('{$name}','{$rs["fileName"]}','{$description}','{$feature}',{$fid},'{$create_time}',{$creator})";


	if(mysql_query($sql,$conn)){

		$productId=mysql_insert_id();

		$sql="select id from hy_product_category_parameter where fid=".$fid;
		$rs=mysql_query($sql,$conn);
		
		if(mysql_num_rows($rs)<1){
			mysql_close($conn);
			jump("product_list.php?fid=".$fid);
		}

		$batchSql='insert into hy_product_parameter(product_id,parameter_id)values(';//开头		
		while($row=mysql_fetch_assoc($rs)){
			$batchSql.="{$productId},{$row["id"]}),(";
		}

		$batchSql=rtrim($batchSql,',(');//驱除末尾

		if(mysql_query($batchSql,$conn)){
			//jump("product_list.php?fid=".$fid);
			//jump("product_list.php?fid=".$fid);
		}else{
			msg('为产品添加参数失败!错误信息:');	
			exit(mysql_error());
		}		
		jump('product_succeed.php?fid='.$fid."&depth=".$_POST["depth"]);
	}else{
		echo '产品添加失败!错误信息:';	
		exit(mysql_error());
	}
	mysql_close($conn);
	jump("product_list.php?fid=".$fid);
}


if(!empty($_POST["type"])&&$_POST["type"]=="parameter"){//parameter
	if(!empty($_POST["name"])&&!empty($_POST['fid'])&&is_numeric($_POST["fid"])){
		$name=myfilter($_POST["name"],3);
		$fid=$_POST['fid'];
		if($name==""||$fid==""){
			echo "请填写完整";
			mysql_close($conn);
			exit();
		}
		$sql="insert into hy_product_category_parameter(name,fid)values('{$name}',{$fid})";

		if(mysql_query($sql,$conn)){
			$pid=mysql_insert_id();		
			$sql="select * from hy_product where fid=".$fid;
			$rs=mysql_query($sql,$conn);			
			while($row=mysql_fetch_assoc($rs)){
				$sql="select id from hy_product_parameter where product_id=".$row['id']." and parameter_id=".$pid;
				$rs=mysql_query($sql,$conn);
				if(mysql_num_rows($rs)<1){
					$inSql="insert into hy_product_parameter(product_id,parameter_id)values({$row['id']},{$pid})";
					//mysql_query($inSql,$conn);
					if(mysql_query($inSql,$conn)){
						//echo $inSql;
						//echo "<hr />";
					}else{
						echo $inSql;
						echo "<hr />";
						exit(mysql_error());
					}
				}
			}
			echo '参数添加成功';
		}else{
			echo '参数添加失败';
			exit(mysql_error());
		}		
	}else{
		echo '提交的信息有误';
		mysql_close($conn);
		exit();
	}
}

if(!empty($_POST["type"])&&$_POST["type"]=="scheme"){//scheme

	if($_FILES["pic"]["name"]==''){
		msg('请上传文件!');
		jump($_SERVER['HTTP_REFERER']);
	}

	if(empty($_POST["name"])||empty($_POST['fid'])||!is_numeric($_POST["fid"])){
		msg('请将信息填写完整');
		jump($_SERVER['HTTP_REFERER']);
	}

	$name=myfilter($_POST["name"],3);
	$fid=$_POST['fid'];

	$rs=uploadPix("pic","scheme");
	
	if($rs['error']==0){
		$sql="insert into hy_product_scheme(name,pic,fid)values('{$name}','{$rs["fileName"]}',{$fid})";

		if(mysql_query($sql,$conn)){
			mysql_close($conn);
			msg("添加成功！");
			jump("scheme_list.php?fid=".$fid);
			//jump('product_succeed.php?fid='.$fid);
		}else{
			msg("失败了！");
			exit(mysql_error());
			mysql_close($conn);			
		}

		
		jump("scheme_list.php");

	}else{
		msg($rs['errorMsg']);
		jump($_SERVER['HTTP_REFERER']);
	}
}

if(!empty($_POST["type"])&&$_POST["type"]=="file"){//file

	if($_FILES["file"]["name"]==''){
		msg('请上传文件!');
		jump($_SERVER['HTTP_REFERER']);
	}

	if(empty($_POST["name"])||empty($_POST['fid'])||!is_numeric($_POST["fid"])){
		msg('请将信息填写完整');
		jump($_SERVER['HTTP_REFERER']);
	}

	$name=myfilter($_POST["name"],3);
	$fid=$_POST['fid'];
	$upload_time=date("Y-m-d H:i:s");

	$rs=uploadFile("file");

	if($rs['error']==0){
		$sql="insert into hy_product_file(name,file,fid,upload_time)values('{$name}','{$rs["fileName"]}',{$fid},'{$upload_time}')";

		if(mysql_query($sql,$conn)){
			mysql_close($conn);
			msg("添加成功！");
			jump("file_list.php?fid=".$fid);
			//jump('product_succeed.php?fid='.$fid);
		}else{
			msg("失败了！");
			exit(mysql_error());
			mysql_close($conn);			
		}

		
		jump("scheme_list.php");

	}else{
		msg($rs['errorMsg']);
		jump($_SERVER['HTTP_REFERER']);
	}
}
mysql_close($conn);
?>