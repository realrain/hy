<?php
include_once("../inc/session_check.php");
include_once("../inc/function.php");
include_once("../inc/config.php");
include_once("../inc/conn.php");

if(!empty($_GET["type"])&&$_GET["type"]=="admin"){
	if(isset($_GET["id"])&&is_numeric($_GET["id"])){
		$query="select id,name from hy_admin where id=".$_GET["id"];
		$rs=mysql_query($query,$conn);
		$row=mysql_fetch_row($rs);	
		if($row[0]==$_SESSION["hy_uid"]){//当前用户自杀
			$query="delete from hy_admin where id=".$_GET["id"];
			mysql_query($query,$conn);
			mysql_free_result($rs);
			mysql_close($conn);
			echo "<script>alert('用户已删除！此用户为当前登陆用户，删除该用户将退出登陆！')</script>";
			jump("logout.php");
		}		
		$query="delete from hy_admin where id=".$_GET["id"];//正常删除
		mysql_query($query,$conn);
		mysql_free_result($rs);
		mysql_close($conn);
		echo "<script>alert('用户已删除！')</script>";
		jump("admin_list.php");
	}else{
		echo "<script>alert('错误的参数！')</script>";
		echo "<script>history.back()</script>";
		exit();
	}
}

if(!empty($_GET["type"])&&$_GET["type"]=="1"){//article
	if(!empty($_GET["id"])&&is_numeric($_GET["id"])){		
		$sql="delete from hy_article where id=".$_GET["id"];		
		if(mysql_query($sql,$conn)){
			echo '信息删除成功';
			@unlink("../uploads/".$_GET["pic"]);
		}else{
			echo '信息删除失败';
		}		
		
	}else{
		mysql_close($conn);
		msg('参数不正确！');
		jump("article_list.php");
	}
}

if(!empty($_GET["type"])&&$_GET["type"]=="2"){//Single
	if(isset($_GET["id"])&&is_numeric($_GET["id"])&&strpos($_GET["id"],".")==false){
		$sql="delete from `wode_single` where id=".$_GET["id"];
		if(mysql_query($sql,$conn)){
			echo '单页信息删除成功';
		}else{
			echo '单页信息删除失败';
		}		
	}else{
		echo 'ID参数不正确';
	}
}

if(!empty($_GET["type"])&&$_GET["type"]=="3"){//Banner
	if(!empty($_GET["id"])&&is_numeric($_GET["id"])){
		$sql="delete from hy_banner where id=".$_GET["id"];
		$result=mysql_query($sql,$conn);
		if($result){
			msg('轮显图删除成功!');

			$file="../uploads/".getPath($_GET["file"],'banner');
			if(file_exists($file)){				
				@unlink($file);
			}
		}else{
			msg('轮显图删除失败!');
			exit(mysql_error());
		}		
		mysql_close($conn);
		jump("banner_list.php");
	}else{
		mysql_close($conn);
		msg('参数不正确！');
		jump("banner_list.php");
	}
}

if(!empty($_GET["type"])&&$_GET["type"]=="4"){//Category
	if(!empty($_GET["id"])&&is_numeric($_GET["id"])){

		$sql="select id from hy_category where fid=".$_GET["id"];
		$rs=mysql_query($sql,$conn);
		if(mysql_num_rows($rs)>0){
			msg('该栏目下还有子栏目，无法直接删除!');
			mysql_close($conn);
			jump($_SERVER['HTTP_REFERER']);
		}

		$sql="select id from hy_article where fid=".$_GET["id"];
		$rs=mysql_query($sql,$conn);
		if(mysql_num_rows($rs)>0){
			msg('该栏目下还有内容，无法直接删除!');
			mysql_close($conn);
			jump($_SERVER['HTTP_REFERER']);
		}

		$sql="delete from hy_category where id=".$_GET["id"];
		if(mysql_query($sql,$conn)){
			msg('栏目删除成功!');
		}else{
			msg('栏目删除失败!');	
		}		
		mysql_close($conn);
		jump("category.php");
	}else{
		mysql_close($conn);
		msg('参数不正确！');
		jump("category.php");
	}
}



if(!empty($_GET["type"])&&$_GET["type"]==5){//Pic
	if(!empty($_GET["id"])&&is_numeric($_GET["id"])){
		$sql="delete from wode_pic where id=".$_GET["id"];
		$result=mysql_query($sql,$conn);
		if($result){
			msg('删除成功!');
			if(file_exists("../uploads/".$_GET["file"])){
				unlink("../uploads/".$_GET["file"]);//del old one
			}
		}else{
			msg('删除失败!');	
		}
		
		mysql_close($conn);
		jump("pic_list.php");
	}else{
		mysql_close($conn);
		msg('参数不正确！');
		jump("pic_list.php");
	}
}

if(!empty($_GET["type"])&&$_GET["type"]==6){//GBOOK
	if(isset($_GET["id"])&&is_numeric($_GET["id"])&&strpos($_GET["id"],".")==false){
		$sql="delete from `hy_guestbook` where id=".$_GET["id"];
		if(mysql_query($sql,$conn)){
			echo '留言删除成功';
		}else{
			echo '留言删除失败';
		}		
	}else{
		echo 'ID参数不正确';
	}
}

if(!empty($_GET["type"])&&$_GET["type"]=="8"){//Product Category
	if(!empty($_GET["id"])&&is_numeric($_GET["id"])){

		$sql="select id from hy_product_category where fid=".$_GET["id"];
		$rs=mysql_query($sql,$conn);
		if(mysql_num_rows($rs)>0){
			msg('该栏目下还有子栏目，无法直接删除!');
			mysql_close($conn);
			jump($_SERVER['HTTP_REFERER']);
		}

		$sql="select id from hy_product where fid=".$_GET["id"];
		$rs=mysql_query($sql,$conn);
		if(mysql_num_rows($rs)>0){
			msg('该栏目下还有产品，无法直接删除!');
			mysql_close($conn);
			jump($_SERVER['HTTP_REFERER']);
		}

		$sql="delete from hy_product_category where id=".$_GET["id"];
		if(mysql_query($sql,$conn)){
			msg('栏目删除成功!');
		}else{
			msg('栏目删除失败!');	
		}		
		mysql_close($conn);
		jump($_SERVER['HTTP_REFERER']);
	}else{
		mysql_close($conn);
		msg('参数不正确！');
		jump($_SERVER['HTTP_REFERER']);
	}
}

if(!empty($_GET["type"])&&$_GET["type"]==9){//product
	if(!empty($_GET["id"])&&is_numeric($_GET["id"])){		
		$sql="delete from hy_product where id=".$_GET["id"];		
		if(mysql_query($sql,$conn)){
			$file="../uploads/".getPath($_GET["file"],'scheme');
			@unlink($file);
			mysql_close($conn);
			exit('产品删除成功');
		}else{
			echo '删除失败';
			exit(mysql_error());
		}		
	}else{
		mysql_close($conn);
		msg('参数不正确！');
		jump($_SERVER['HTTP_REFERER']);
	}
}

if(!empty($_GET["type"])&&$_GET["type"]==10){//scheme
	if(!empty($_GET["id"])&&is_numeric($_GET["id"])){		
		$sql="delete from hy_product_scheme where id=".$_GET["id"];		
		if(mysql_query($sql,$conn)){			
			$file="../uploads/".getPath($_GET["file"],'scheme');
			@unlink($file);
			mysql_close($conn);
			jump($_SERVER['HTTP_REFERER']);
		}else{
			echo '删除失败';
			exit(mysql_error());
		}		
	}else{
		mysql_close($conn);
		msg('参数不正确！');
		jump($_SERVER['HTTP_REFERER']);
	}
}

if(!empty($_GET["type"])&&$_GET["type"]==11){//参数
	if(empty($_GET["id"])||empty($_GET["fid"])){
		exit('Require Parameter:Id & Fid');
	}
	if(!check_int($_GET["id"])||!check_int($_GET["fid"])){
		exit('Invalid Parameter');
	}
	$delParameterSelf=false;
	$delParameterMatch=false;

	$sql="delete from hy_product_parameter where parameter_id=".$_GET["id"];
	if(mysql_query($sql,$conn)){
		$delParameterMatch=true;
	}else{
		exit(mysql_error());
	}

	$sql="delete from hy_product_category_parameter where id=".$_GET["id"];
	if(mysql_query($sql,$conn)){
		$delParameterSelf=true;
	}else{
		exit(mysql_error());
	}
	
	if($delParameterMatch&&$delParameterSelf){
		exit('参数删除成功');
	}
}

if(!empty($_GET["type"])&&$_GET["type"]==12){//File
	if(!empty($_GET["id"])&&is_numeric($_GET["id"])&&!empty($_GET["fid"])&&is_numeric($_GET["fid"])){
		$sql="delete from hy_product_file where id=".$_GET["id"];
		if(mysql_query($sql,$conn)){
			$file="../uploads/".getPath($_GET["file"],'file');
			@unlink($file);
			msg('附件删除成功');
			jump($_SERVER['HTTP_REFERER']);
		}else{
			msg('附件删除失败');
			exit(mysql_error());
		}		
	}else{
		msg('ID参数不正确');
		jump($_SERVER['HTTP_REFERER']);
	}
}

if(!empty($_GET["type"])&&$_GET["type"]==13){//EMail
	if(isset($_GET["id"])&&is_numeric($_GET["id"])&&strpos($_GET["id"],".")==false){
		$sql="delete from `hy_email` where id=".intval($_GET["id"]);
		if(mysql_query($sql,$conn)){
			echo 'EMail Deleted';
		}else{
			echo 'Failed to Delete EMailm,Error:'.mysql_error();
		}		
	}else{
		echo 'ID参数不正确';
	}
}
?>