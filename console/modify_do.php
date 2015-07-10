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
	$is_newPic=false;

	if($_FILES["pic"]["name"]!=''){
		$rs=uploadPix("pic","banner");
		if($rs['error']>0){
			msg($rs['errorMsg']);
			jump($_SERVER['HTTP_REFERER']);
		}else{
			$is_newPic=true;
		}
	}

    $id=$_POST["id"];

    if($is_newPic){
		$sql="update hy_banner set pic='".$rs["fileName"]."',link='".$_POST["link"]."' where id=".$id;//SQL WITH PIC
	}else{
    	$sql="update hy_banner set link='".$_POST["link"]."' where id=".$id;//ONLY TEXT SQL
    }

	if(mysql_query($sql,$conn)){
		if($is_newPic){
			$file="../uploads/".getPath($_POST["old_pic"],'banner');
			@unlink($file);
		}
		msg("轮播图修改成功");
		mysql_close($conn);
		jump("banner_list.php");
	}else{
		echo '修改失败!错误信息:';	
		exit(mysql_error());
	}
}

if(!empty($_POST["type"])&&$_POST["type"]=="myRemark"){
	$remark=myfilter($_POST["remark"],3);
	$sql="update hy_admin set remark='".$remark."' where id=".$_SESSION["hy_uid"];
	if(mysql_query($sql,$conn)){
		msg("备注已更新！");
		jump("me_view.php");
	}else{
		exit(mysql_error());
	}
}

if(!empty($_POST["type"])&&$_POST["type"]=="myPsw"){

	if(empty($_POST['oldPsw'])||empty($_POST['newPsw'])){
		msg("请将信息填写完整！");
		jump("me_modify_psw.php");
	}

	$oldPsw=md5($_POST['oldPsw']);
	$sql="select * from hy_admin where id=".$_SESSION["hy_uid"]." and psw='".$oldPsw."'";
	$rs=mysql_query($sql,$conn);
	if(mysql_num_rows($rs)==0){
		mysql_free_result($rs);
		mysql_close($conn);
		msg("旧密码错误！");
		jump("me_modify_psw.php");
	}

	$newPsw=md5($_POST['newPsw']);
	$sql="update hy_admin set psw='".$newPsw."' where id=".$_SESSION["hy_uid"];
	if(mysql_query($sql,$conn)){
		msg("密码已修改！");
		jump("me_view.php");
	}else{
		exit(mysql_error());
	}
}

if(!empty($_POST["type"])&&$_POST["type"]=="admin"){//admin
	if(isset($_POST["id"])&&is_int(intval($_POST["id"]))&&!empty($_POST["name"])&&!empty($_POST["atype"])){//ID不为空且为数字

		$sql="select id from hy_admin where name='".$_POST["name"]."' and id!=".$_POST["id"];
		$rs=mysql_query($sql,$conn);
		$row=mysql_fetch_assoc($rs);

		if(mysql_num_rows($rs)>0){
			msg("此用户名已存在，请更换用户名！");
			mysql_free_result($rs);
			mysql_close($conn);
			echo "<script>history.back()</script>";
			exit();
		}

		$name=myfilter($_POST["name"],3);		
		$remark='';
		if(!empty($_POST["remark"])){
			$remark=myfilter($_POST["remark"],3);
		}

		$modify_time=date("Y-m-d H:i:s");
    	$modifier=$_SESSION["hy_uid"];
				
		if(!empty($_POST["psw"])){//改密码与与否
			$query="update hy_admin set name='".$name."',psw='".md5($_POST["psw"])."',type=".$_POST["atype"].",remark='".$remark."',modifier=".$modifier.",modify_time='".$modify_time."' where id=".$_POST["id"];
		}else{
			$query="update hy_admin set name='".$name."',type=".$_POST["atype"].",remark='".$remark."',modifier=".$modifier.",modify_time='".$modify_time."' where id=".$_POST["id"];
		}
				
		if($row['id']==$_SESSION["hy_uid"]){//当前登录用户修改				
			mysql_query($query,$conn);
			mysql_free_result($rs);
			mysql_close($conn);
			msg("修改完毕！此用户为当前登陆用户，即将退出系统重新登陆！");
			jump("logout.php");
		}else{//非当前用户			
			mysql_query($query,$conn);
			mysql_free_result($rs);
			mysql_close($conn);
			msg("修改完毕！");
			jump("admin_list.php");
		}

	}else{
		echo "<script>alert('错误的参数！')</script>"; 
		echo "<script>history.back()</script>";
		exit;
	}
}

if(!empty($_POST["type"])&&$_POST["type"]=="single"){//Single
	if(isset($_POST["title"])&&isset($_POST["contents"])&&isset($_POST["id"])&&is_numeric($_POST["id"])&&strpos($_POST["id"],".")==false){	
		$title=myfilter($_POST["title"],3);
		$contents=myfilter($_POST["contents"],7);
		if($title==""||$contents==""){
			echo "请将单页信息填写完整";
			mysql_close($conn);
			exit();
		}
		$seotitle=myfilter($_POST["seotitle"],3);
    $keywords=myfilter($_POST["keywords"],3);
    $des=myfilter($_POST["des"],3);
	$modification_time=time();
    $modifer=$_SESSION["hy_uid"];
	
	$sql="update wode_single set title='{$title}',contents='{$contents}',seotitle='{$seotitle}',keywords='{$keywords}',des='{$des}',modification_time={$modification_time},modifer={$modifer} where id={$_POST["id"]}";
		if(mysql_query($sql,$conn)){
			echo('单页信息更新成功');
		}else{
			echo('单页信息更新失败!');
			exit(mysql_error());
		}
	}else{
		echo '请将单页信息填写完整!!!';
		mysql_close($conn);
		exit();
	}
}

if(!empty($_POST["type"])&&$_POST["type"]=="category"){//category
	if(isset($_POST["name"])&&isset($_POST["id"])&&is_numeric($_POST["id"])){
		$name=myfilter($_POST["name"],3);
		if($name==""){
			echo "请将栏目名称填写完整";
			mysql_close($conn);
			exit();
		}
		$sql="update hy_category set name='".$name."' where id=".$_POST["id"];
		if(mysql_query($sql,$conn)){
			echo '栏目修改成功';
		}else{
			echo '栏目修改失败';
			exit(mysql_error());
		}
	}else{
		exit('信息不完整');
	}
}

if(!empty($_POST["type"])&&$_POST["type"]=="article"){//article
	$title=myfilter($_POST["title"],3);
	$poster=myfilter($_POST["poster"],3);
    $contents=myfilter($_POST["contents"],7);
    $modify_time=date("Y-m-d H:i:s");
    $modifier=$_SESSION["hy_uid"];
    $fid=$_POST["fid"];

    $query="update hy_article set title='{$title}',poster='{$poster}',contents='{$contents}',fid={$fid},modify_time='{$modify_time}',modifier={$modifier} where id=".$_POST["id"];
    if(mysql_query($query,$conn)){
		msg('修改成功!');
	}else{
		echo '文章修改失败!错误信息:';	
		exit(mysql_error());
	}	
	mysql_close($conn);
	jump("article_list.php");
}


if(!empty($_POST["type"])&&$_POST["type"]=="product_category"){//product_category
	if(isset($_POST["name"])&&isset($_POST["id"])&&is_numeric($_POST["id"])){
		$name=myfilter($_POST["name"],3);
		if($name==""){
			echo "请将栏目名称填写完整";
			mysql_close($conn);
			exit();
		}
		$sql="update hy_product_category set name='".$name."' where id=".$_POST["id"];
		if(mysql_query($sql,$conn)){
			echo '栏目修改成功';
		}else{
			echo '栏目修改失败';
			exit(mysql_error());
		}
	}else{
		exit('信息不完整');
	}
}

if(!empty($_POST["type"])&&$_POST["type"]=="product"){//product

	$is_newPic=false;

	if($_FILES["pic"]["name"]!=''){
		$rs=uploadPix("pic","thumb");
		if($rs['error']>0){
			msg($rs['errorMsg']);
			jump($_SERVER['HTTP_REFERER']);
		}else{
			$is_newPic=true;
		}
	}
	$name=myfilter($_POST["name"],3);
    $description=myfilter($_POST["description"],7);
    $feature=myfilter($_POST["feature"],7);
    $modify_time=date("Y-m-d H:i:s");
    $modifier=$_SESSION["hy_uid"];
    $fid=$_POST["fid"];
    $id=$_POST["id"];
    $old_fid=$_POST["old_fid"];

    if($is_newPic){
    	$sql="update hy_product set name='{$name}',thumb='{$rs["fileName"]}',description='{$description}',feature='{$feature}',fid={$fid},modify_time='{$modify_time}',modifier='{$modifier}' where id ={$id}";
    }else{
    	$sql="update hy_product set name='{$name}',description='{$description}',feature='{$feature}',fid={$fid},modify_time='{$modify_time}',modifier='{$modifier}' where id ={$id}";
    }

	if(mysql_query($sql,$conn)){
		if($is_newPic){
			$file="../uploads/".getPath($_POST["old_pic"],'thumb');
			@unlink($file);
		}

		if($old_fid!=$fid){//Category changed
			$clearSql="delete from hy_product_parameter where product_id=".$id;
			if(!mysql_query($clearSql,$conn)){
				echo '产品栏目发生改变，清理旧参数失败:';
				exit(mysql_error());
			}

			$sql="select id from hy_product_category_parameter where fid=".$fid;
			$rs=mysql_query($sql,$conn);
			if(mysql_num_rows($rs)>0){
				$batchSql='insert into hy_product_parameter(product_id,parameter_id)values(';//开头
				while($row=mysql_fetch_assoc($rs)){
					$batchSql.="{$id},{$row["id"]}),(";
				}
				$batchSql=rtrim($batchSql,',(');//驱除末尾
				if(!mysql_query($batchSql,$conn)){				
					echo '为产品添加参数失败!错误信息:';
					exit(mysql_error());
				}
			}			
		}

	}else{
		echo '产品修改失败!错误信息:';	
		exit(mysql_error());
	}
	if($old_fid!=$fid){
		msg("产品修改成功，由于更改了产品栏目，产品参数已经发生改变");
	}else{
		msg("产品修改成功");
	}
	mysql_close($conn);
	//jump("product_list.php");
	jump("product_detail.php?id=".$id);
}

if(!empty($_POST["type"])&&$_POST["type"]=="parameter"){//parameter
	$name=myfilter($_POST["name"],3);
	$id=$_POST['id'];
	$fid=$_POST['fid'];

	$sql="update hy_product_category_parameter set name='{$name}' where id={$id}";
	if(mysql_query($sql,$conn)){
		echo '参数修改成功';
	}else{
		echo '参数修改失败';
		exit(mysql_error());
	}
}

if(!empty($_POST["type"])&&$_POST["type"]=="myValue"){//my value
	$myvalue=myfilter($_POST["myvalue"],3);
	$id=intval($_POST['id']);
	$fid=intval($_POST['fid']);

	$sql="update hy_product_parameter set myvalue='{$myvalue}' where id={$id}";
	if(mysql_query($sql,$conn)){
		echo '参数修改成功';
	}else{
		echo '参数修改失败';
		exit(mysql_error());
	}
}

if(!empty($_POST["type"])&&$_POST["type"]=="parameter_sorting"){//parameter_sorting
	$fid=intval($_POST['fid']);

	$ids=array();
	$ids=$_POST["id"];

	$sortnums=array();
	$sortnums=$_POST["sortnum"];

	$err=0;

	foreach($ids as $k=>$v){
		$sn=myfilter($sortnums[$k],3);
		$sn=intval($sn);
		if(!empty($sn)){
			$sql="update hy_product_category_parameter set sortnum={$sn} where id={$ids[$k]}";
			if(!mysql_query($sql,$conn)){
				$err++;
			}
		}
	}
	if($err){
		msg('参数排序完毕，发生错误：'.$err.'个');
	}else{
		msg("排序完成");
	}
	jump('parameter_sorting.php?fid='.$fid);
}

if(!empty($_POST["type"])&&$_POST["type"]=="myvalue_batch_modify"){//myvalue_batch_modify
	$fid=intval($_POST['fid']);

	$ids=array();
	$ids=$_POST["id"];

	$myValues=array();
	$myValues=$_POST["myvalue"];
	
	$oVs=array();
	$oVs=$_POST["originalValue"];

	$err=0;

	foreach($ids as $k=>$v){
		if($myValues[$k]!=$oVs[$k]){
			$mv=myfilter($myValues[$k],3);
			$sql="update hy_product_parameter set myvalue='{$mv}' where id={$ids[$k]}";
			if(!mysql_query($sql,$conn)){
				$err++;
			}
		}
	}
	if($err){
		msg('批量更新完毕，发生错误：'.$err.'个');
	}else{
		msg('批量更新完毕');
	}
	jump('my_parameter_list.php?fid='.$fid);
}

if(!empty($_POST["type"])&&$_POST["type"]=="scheme"){//scheme

	$is_newPic=false;

	if($_FILES["pic"]["name"]!=''){
		$rs=uploadPix("pic","scheme");
		if($rs['error']>0){
			msg($rs['errorMsg']);
			jump($_SERVER['HTTP_REFERER']);
		}else{
			$is_newPic=true;
		}
	}
	$name=myfilter($_POST["name"],3);
    $fid=$_POST["fid"];
    $id=$_POST["id"];

    if($is_newPic){
    	$sql="update hy_product_scheme set name='{$name}',pic='{$rs["fileName"]}' where id ={$id}";
    }else{
    	$sql="update hy_product_scheme set name='{$name}' where id ={$id}";
    }

	if(mysql_query($sql,$conn)){
		if($is_newPic){
			$file="../uploads/".getPath($_POST["old_pic"],'scheme');
			@unlink($file);
		}
		msg("方框图修改成功");
		mysql_close($conn);
		jump("scheme_list.php?fid=".$fid);
	}else{
		echo '方框图修改失败!错误信息:';	
		exit(mysql_error());
	}
}

if(!empty($_POST["type"])&&$_POST["type"]=="file"){//file

	$is_newFile=false;

	if($_FILES["file"]["name"]!=''){
		$rs=uploadFile("file");
		if($rs['error']>0){
			msg($rs['errorMsg']);
			jump($_SERVER['HTTP_REFERER']);
		}else{
			$is_newFile=true;
		}
	}
	$name=myfilter($_POST["name"],3);
    $fid=$_POST["fid"];
    $id=$_POST["id"];
    $upload_time=date("Y-m-d H:i:s");


    if($is_newFile){
    	$sql="update hy_product_file set name='{$name}',file='{$rs["fileName"]}',upload_time='{$upload_time}' where id ={$id}";
    }else{
    	$sql="update hy_product_file set name='{$name}' where id ={$id}";
    }

	if(mysql_query($sql,$conn)){
		if($is_newFile){
			$file="../uploads/".getPath($_POST["old_file"],'file');
			@unlink($file);
		}
		msg("附件修改成功");
		mysql_close($conn);
		jump("file_list.php?fid=".$fid);
	}else{
		echo '附件修改失败!错误信息:';	
		exit(mysql_error());
	}
}

if(!empty($_POST["type"])&&$_POST["type"]=="gbook"){//guest book

	$reply_content=myfilter($_POST["reply_content"],3);
	$is_show=$_POST["is_show"];
	$id=$_POST['id'];
	$replier='';

	$reply_time='';

	if(!empty($reply_content)){
		$replier=$_SESSION["hy_uid"];
		$reply_time=date("Y-m-d H:i:s");
	}

	$sql="update hy_guestbook set reply_content='{$reply_content}',is_show='{$is_show}',reply_time='{$reply_time}',replier={$replier} where id={$id}";
	if(mysql_query($sql,$conn)){
		jump("gbook_detail.php?id=".$id);
	}else{		
		exit(mysql_error());
	}
}
?>