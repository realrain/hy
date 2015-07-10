<?php
function jump($url) {
	echo '<script language="javascript">location.href="'.$url.'";</script>';
	exit();
}
function msg($msg) {
	echo "<script language='javascript'>alert('".$msg."')</script>";
}

function getPath($name,$type) {

	$folder=substr($name,0,6);

	switch($type){
		case 'banner':
			$path="banner/".$folder."/";
			break;
		case 'pic':
			$path="pic/".$folder."/";
			break;
		case 'scheme':
			$path="scheme/".$folder."/";
			break;
		case 'thumb':
			$path="thumb/".$folder."/";
			break;
		case 'file':
			$path="file/".$folder."/";
			break;
	}
	return $path.$name;
}

/*
* @function breadCrumb()
* @declare  生成面包屑菜单
* @param    $id 起源ID，以此向上级查找
* @param    $cid 当前ID，用于判断输出 class='current'
* @param    $link 链接地址
* @return   string
* @example  breadCrumb(1,5,'new.php?fid=');
* @auther   ZouTong<106770950@qq.com>
* @date     2015-05-05 13:42
*/
function breadCrumb($id,$cid,$link) {
    global $conn;
    static $menu='';
    $sql = "select id,name,fid from hy_category where id={$id}";
    $rs = mysql_query($sql, $conn);
    $row= mysql_fetch_assoc($rs);
    if($id==$cid){
      //递归时$id发生变化，无法判断哪个是当前栏目，所以需要$cid
      $menu="<li class='current'><a href='{$link}{$row['id']}' title='{$row['name']}'>{$row['name']}</a></li>".$menu;
    }else{
      $menu="<li><a href='{$link}{$row['id']}' title='{$row['name']}'>{$row['name']}</a></li>".$menu;
    }

    if($row['fid']!=0){
        breadCrumb($row['fid'],$cid);
    }
    return $menu;
}
/*
* @function check_int()
* @declare 	检测值是否为正整数
* @param    $z 一般是POST或GET的数据
* @return   Boolen
* @auther 	ZouTong<106770950@qq.com>
* @date	    2015-05-11 14:55
*/
function check_int($z){
	$reg="/^[1-9]\d*$/";
	$result=preg_match($reg,$z);
	if($result){
		return true;
	}else{
		return false;
	}
}

/*
* @function uploadPix()
* @declare 	Upload Pic
* @param    string 	$picform which input's type eq 'file'
* @param    string 	$path Path Type
* @return   Array
* @auther 	ZouTong<106770950@qq.com>
* @date	    2015-04-28 11:19
*/
function uploadPix($picform,$path){
	
	$result=array();
	$result['error']=0;
	$result['errorMsg']='';
	$result['fileName']='';

	//check the dir exists or not
	switch($path){
		case 'banner':
			$file_path="../uploads/banner/".date("Ym")."/";
			break;
		case 'pic':
			$file_path="../uploads/pic/".date("Ym")."/";
			break;
		case 'scheme':
			$file_path="../uploads/scheme/".date("Ym")."/";
			break;
		case 'thumb':
			$file_path="../uploads/thumb/".date("Ym")."/";
			break;
		default:
			$file_path="../uploads/";
	}

	if(!file_exists($file_path)){
		if(!mkdir($file_path,0777,true)){//recursively create dir
			$result['error']=1;
			$result['errorMsg']='创建文件保存目录失败：'.$file_path;
			return $result;
		}
	}

	if($_FILES[$picform]['error'] > 0){
		switch($_FILES[$picform]['error']){
			case 1:
				$result['error']=1;
				$result['errorMsg']='文件大小超过了PHP.ini中的文件限制！';
				return $result;
				break;
			case 2:
				$result['error']=1;
				$result['errorMsg']='文件大小超过了HTML中的限制！';
				return $result;
				break;
			case 3:
				$result['error']=1;
				$result['errorMsg']='文件只有一部分被上传！';
				return $result;
				break;
			case 4:
				$result['error']=1;
				$result['errorMsg']='没有找到要上传的文件！';
				return $result;
				break;
			case 5:
				$result['error']=1;
				$result['errorMsg']='服务器临时文件夹丢失！';
				return $result;
				break;
			case 6:
				$result['error']=1;
				$result['errorMsg']='文件写入到临时文件夹出错！';
				return $result;
				break;
			default:
				$result['error']=1;
				$result['errorMsg']='Unknown upload error！';
				return $result;
		}
	}

	if($_FILES[$picform]['size']>1000000){
		$result['error']=1;
		$result['errorMsg']='文件大小超出限制！';
		return $result;
	}

	if($_FILES[$picform]["type"]=="image/jpeg"||$_FILES[$picform]["type"]=="image/pjpeg"||$_FILES[$picform]["type"]=="image/gif"||$_FILES[$picform]["type"]=="image/x-png"||$_FILES[$picform]["type"]=="image/png"){
			switch($_FILES[$picform]["type"]){
				case "image/pjpeg":
				$photo_type=".jpg";
				break;
				case "image/jpeg":
				$photo_type=".jpg";
				break;
				case "image/gif":
				$photo_type=".gif";
				break;
				case "image/x-png":
  				$photo_type=".png";
  				break;
  				case "image/png":
  				$photo_type=".png";
  				break;
			}

			$filename=date("Ymdhis")."_".rand(0,1000).$photo_type;

			if(is_uploaded_file($_FILES[$picform]['tmp_name'])){// is uploaded via HTTP POST or Not		
				$feedback=move_uploaded_file($_FILES[$picform]['tmp_name'],$file_path.$filename);
				if($feedback){
					$result['fileName']=$filename;
					return $result;//成功
				}else{
					$result['error']=1;
					$result['errorMsg']='move_uploaded_file() Failed';
					return $result;
				}				
			}else{
				$result['error']=1;
				$result['errorMsg']='is_uploaded_file() Failed';
				return $result;
			}
		}else{
			$result['error']=1;
			$result['errorMsg']='文件类型错误！只接受JPG,GIF,PNG类型，当前所传的图片类型是：'.$_FILES[$picform]["type"];
			return $result;
		}
}

/*
* @function uploadFile()
* @declare 	Upload File
* @param    string 	$fileform which input's type eq 'file'
* @return   Array
* @auther 	ZouTong<106770950@qq.com>
* @date	    2015-04-28 15:18
*/
function uploadFile($fileform){
	$file_type=array("rar","zip","doc","pdf","docx","txt");//Allowed File Extension Name
	
	$result=array();
	$result['error']=0;
	$result['errorMsg']='';
	$result['fileName']='';

	$file_path="../uploads/file/".date("Ym")."/";

	if(!file_exists($file_path)){
		if(!mkdir($file_path,0777,true)){//recursively create dir
			$result['error']=1;
			$result['errorMsg']='创建文件保存目录失败：'.$file_path;
			return $result;
		}
	}

	if($_FILES[$fileform]['error'] > 0){
		switch($_FILES[$fileform]['error']){
			case 1:
				$result['error']=1;
				$result['errorMsg']='文件大小超过了PHP.ini中的文件限制！';
				return $result;
				break;
			case 2:
				$result['error']=1;
				$result['errorMsg']='文件大小超过了HTML中的限制！';
				return $result;
				break;
			case 3:
				$result['error']=1;
				$result['errorMsg']='文件只有一部分被上传！';
				return $result;
				break;
			case 4:
				$result['error']=1;
				$result['errorMsg']='没有找到要上传的文件！';
				return $result;
				break;
			case 5:
				$result['error']=1;
				$result['errorMsg']='服务器临时文件夹丢失！';
				return $result;
				break;
			case 6:
				$result['error']=1;
				$result['errorMsg']='文件写入到临时文件夹出错！';
				return $result;
				break;
			default:
				$result['error']=1;
				$result['errorMsg']='Unknown upload error！';
				return $result;
		}
	}

	$ext_name=substr(strrchr($_FILES[$fileform]["name"], '.'), 1);

	 if(in_array(strtolower($ext_name),$file_type)){//扩展名在允许范围内

			$file_new_name=date("YmdHis")."_".rand(0,1000).".".$ext_name;

			if(is_uploaded_file($_FILES[$fileform]['tmp_name'])){// is uploaded via HTTP POST or Not		
				$feedback=move_uploaded_file($_FILES[$fileform]['tmp_name'],$file_path.$file_new_name);
				if($feedback){
					$result['fileName']=$file_new_name;
					return $result;//成功
				}else{
					$result['error']=1;
					$result['errorMsg']='move_uploaded_file() Failed';
					return $result;
				}				
			}else{
				$result['error']=1;
				$result['errorMsg']='is_uploaded_file() Failed';
				return $result;
			}

		}else{
			$result['error']=1;
			$result['errorMsg']='文件类型错误！';
			return $result;
		}
}

function upload_me($picform){
	$file_type=array("rar","zip","doc","pdf","docx");
	$file_name=substr(strrchr($_FILES[$picform]["name"], '.'), 1);
	 if(in_array(strtolower($file_name),$file_type)){
			$file_path="../downloads/";
			$file_new_name=date("YmdHis")."_".rand(0,1000).".".$file_name;
			if(is_uploaded_file($_FILES[$picform]['tmp_name'])){		
				$result=move_uploaded_file($_FILES[$picform]['tmp_name'],$file_path.$file_new_name);
				if($result){
					return $file_new_name;
				}else{
					return "upload_error";
				}
				
			}else{
				return "upload_error";
			}
		}else{
			return "type_error";
		}
}

function check_name($host,$name,$psw,$data,$table,$field,$value) {
	$conn=mysql_connect($host,$name,$psw) or exit("连接数据库失败！");
	mysql_select_db($data);
	$query="select ".$field." from ".$table." where ".$field."='".$value."'";	
	$rs=mysql_query($query,$conn);
		if(mysql_num_rows($rs)!=0){
			return true;
		}else{
			return false;
		}
	mysql_free_result($rs);
	mysql_close($conn);
}

class page_lister{
	public $current_page,$conn,$rs,$total,$page_sql,$per,$pages,$t;
	public function __construct($host,$usr,$psw,$data,$sum_sql,$sql,$per_page){
		
		$this->conn=mysql_connect($host,$usr,$psw);
		mysql_select_db($data);
		mysql_query("set names UTF8");//Connection
		
		$this->per=$per_page;
		
		if(isset($_GET["p"])&&is_numeric($_GET["p"])){
			$this->current_page=intval($_GET["p"]);//Current Page
		}else{
			$this->current_page=1;
		}
		
		$this->rs=mysql_query("select * from ".$sum_sql,$this->conn);// Total Articles Results
		$this->total=mysql_num_rows($this->rs);// Count Total Articles
		
		if($this->total%$this->per==0){
        	$this->pages=intval($this->total/$this->per);
		}else{
        	$this->pages=ceil($this->total/$this->per);//Number of Pages
		}
		
		$this->page_sql=$sql." limit ".($this->current_page-1)*$this->per.",".$this->per;//Limit Showing
		$this->rs=mysql_query($this->page_sql,$this->conn);		

	}
	public function show(){
		echo "<p class='page'>当前第<b>".$this->current_page."</b>页，共有<b>".$this->total."</b>条,每页显示<b>".$this->per."</b>条,总共有<b>".$this->pages."</b>页";
		if($this->current_page!=1){
			echo "<a href='".$_SERVER['PHP_SELF']."?id=".$_GET['id']."&p=1'>首页</a>";
		}
		if($this->current_page>1){
			echo "<a href='".$_SERVER['PHP_SELF']."?id=".$_GET['id']."&p=".($this->current_page-1)."'>上一页</a>";
		}
		if($this->current_page<$this->pages){
			echo "<a href='".$_SERVER['PHP_SELF']."?id=".$_GET['id']."&p=".($this->current_page+1)."'>下一页</a>";
		}
		if($this->current_page!=$this->pages){
			echo "<a href='".$_SERVER['PHP_SELF']."?id=".$_GET['id']."&p=".$this->pages."'>末页</a>";
		}
			echo "<span style='margin-left:10px'>跳转到第";
			echo "<select onChange='javascript:location.href=this.options[selectedIndex].value'>";
		for($t=1;$t<=$this->pages;$t++){
			echo "<option value='".$_SERVER['PHP_SELF']."?id=".$_GET['id']."&p="."$t"."'";
        	if($t==$this->current_page){
        		echo "selected='selected'>".$t."</option>";
        	}else{
        		echo ">".$t."</option>";
        	}
		}
		echo "</select>页</span>";
		echo "</p>";
    }
	
	public function bye(){
		mysql_free_result($this->rs);
		mysql_close($this->conn);
	}
}

class lister{
	public $current_page,$conn,$rs,$total,$page_sql,$per,$pages,$t;
	public function __construct($host,$usr,$psw,$data,$sum_sql,$sql,$per_page){
		
		$this->conn=mysql_connect($host,$usr,$psw);
		mysql_select_db($data);
		mysql_query("set names UTF8");//Connection
		
		$this->per=$per_page;
		
		if(isset($_GET["p"])&&is_numeric($_GET["p"])){
			$this->current_page=intval($_GET["p"]);//Current Page
		}else{
			$this->current_page=1;
		}
		
		$this->rs=mysql_query("select * from ".$sum_sql,$this->conn);// Total Articles Results
		$this->total=mysql_num_rows($this->rs);// Count Total Articles
		
		if($this->total%$this->per==0){
        	$this->pages=intval($this->total/$this->per);
		}else{
        	$this->pages=ceil($this->total/$this->per);//Number of Pages
		}
		
		$this->page_sql=$sql." limit ".($this->current_page-1)*$this->per.",".$this->per;//Limit Showing
		$this->rs=mysql_query($this->page_sql,$this->conn);		

	}
	public function show($me,$other){
		echo "<p class='page'>当前第<b>".$this->current_page."</b>页，共有<b>".$this->total."</b>条,每页显示<b>".$this->per."</b>条,总共有<b>".$this->pages."</b>页";
		if($this->current_page!=1){
			echo "<a href='".$me."?p=1".$other."'>首页</a>";
		}
		if($this->current_page>1){
			echo "<a href='".$me."?p=".($this->current_page-1).$other."'>上一页</a>";
		}
		if($this->current_page<$this->pages){
			echo "<a href='".$me."?p=".($this->current_page+1).$other."'>下一页</a>";
		}
		if($this->current_page!=$this->pages){
			echo "<a href='".$me."?p=".$this->pages.$other."'>末页</a>";
		}
			echo "<span style='margin-left:10px;color:#A40000'>跳转到第";
			echo "<select onChange='javascript:location.href=this.options[selectedIndex].value'>";
		for($t=1;$t<=$this->pages;$t++){
			echo "<option value='?p=".$t.$other."'";
        	if($t==$this->current_page){
        		echo "selected='selected'>".$t."</option>";
        	}else{
        		echo ">".$t."</option>";
        	}
		}
		echo "</select>页</span>";
		echo "</p>";
    }
	
	public function bye(){
		mysql_free_result($this->rs);
		mysql_close($this->conn);
	}
}

class page_lister_7{
	private $conn,$total,$i,$pages,$per,$current_page,$p_index,$index_middle,$page_link,$pre,$next,$left,$right,$lr,$page_sql;
	public $rs;
		
	public function __construct($host,$usr,$psw,$data,$sum_sql,$sql,$per_page,$page_index){
		$this->conn=mysql_connect($host,$usr,$psw);
		mysql_select_db($data);
		$this->per=$per_page;
		$this->rs=mysql_query($sum_sql,$this->conn);
		$this->total=mysql_num_rows($this->rs);
		if($this->total%$this->per==0){
			$this->pages=intval($this->total/$this->per);
		}else{	
			$this->pages=ceil($this->total/$this->per);
		}
		if(isset($_GET['p'])&&is_numeric($_GET["p"])&&($_GET["p"]>0)&&($_GET["p"]<=$this->pages)){
			$this->current_page= $_GET['p'];
		}else{
			$this->current_page= 1;
		}
		$this->p_index=$page_index;
		$this->index_middle=ceil($this->p_index/2);
		$this->page_link="";
		$this->page_sql=$sql." limit ".($this->current_page-1)*$this->per.",".$this->per;
		$this->rs=mysql_query($this->page_sql,$this->conn);	
	}
	
	public function show($other){
		if($this->pages<$this->p_index){
			for($this->i = 1; $this->i <= $this->pages; $this->i++){
				if($this->current_page == $this->i){
					$this->page_link .="<b>".$this->i."</b>";
				}else{
					$this->page_link .="<a href='".$_SERVER['PHP_SELF']."?p=".$this->i.$other."'>".$this->i."</a>";
				}
			}			
			
			if($this->current_page > 1){
				$this->pre = $this->current_page-1;
				$this->page_link = "<a href='{$_SERVER['PHP_SELF']}?p={$this->pre}&{$other}'>上一页</a>".$this->page_link;
			}
			if($this->current_page < $this->pages){
				$this->next = $this->current_page+1;
				$this->page_link .= "<a href='{$_SERVER['PHP_SELF']}?p={$this->next}&{$other}'>下一页</a>";
			}
		}elseif($this->current_page <= $this->index_middle){
			for($this->i = 1; $this->i <= $this->p_index; $this->i++){
				if($this->current_page == $this->i){
					$this->page_link .="<b>".$this->i."</b>";
				}else{
					$this->page_link .="<a href='{$_SERVER['PHP_SELF']}?p=$this->i&{$other}'>$this->i</a>";
				}
			}
			$this->pre = $this->current_page-1;
			$this->next = $this->current_page+1;
			if($this->current_page != 1){
				$this->page_link = "<a href='{$_SERVER['PHP_SELF']}?p={$this->pre}&{$other}'>上一页</a>".$this->page_link;
			}
			$this->page_link .= "<a href='{$_SERVER['PHP_SELF']}?p={$this->next}&{$other}'>下一页</a><a href='{$_SERVER['PHP_SELF']}?p=$this->pages&{$other}'>末页</a>";
			
		}elseif($this->current_page > $this->index_middle && ($this->current_page <= ($this->pages-$this->index_middle))){
			if(($this->p_index % 2) == 0){
				$this->left = $this->index_middle-1;
				$this->right = $this->index_middle;
			}else{
				$this->left = $this->right = $this->index_middle-1;
			}
			
			$this->pre = $this->current_page-1;
			$this->next = $this->current_page+1;
			$this->page_link .= "<a href='{$_SERVER['PHP_SELF']}?p=1&{$other}'>首页</a><a href='{$_SERVER['PHP_SELF']}?p={$this->pre}&{$other}'>上一页</a>";
			
			for($this->i = $this->left ; $this->i >=1 ;$this->i--){
					$this->lr = $this->current_page-$this->i;
					$this->page_link .="<a href='{$_SERVER['PHP_SELF']}?p=$this->lr&{$other}'>$this->lr</a>";	
			}
			$this->page_link .=  "<b>".$this->current_page."</b>";
			
			for($this->i = 1; $this->i <= $this->right; $this->i++){
				$this->lr = $this->current_page+$this->i;
				$this->page_link .="<a href='{$_SERVER['PHP_SELF']}?p=$this->lr&{$other}'>$this->lr</a>";	
			}
					
			$this->page_link .= "<a href='{$_SERVER['PHP_SELF']}?p={$this->next}&{$other}'>下一页</a><a href='{$_SERVER['PHP_SELF']}?p=$this->pages&{$other}'>末页</a>";
			
		}else{
			for($this->i = $this->p_index-1; $this->i >= 0; $this->i--){
				$this->lr = $this->pages-$this->i;
				if($this->current_page == $this->lr){
					$this->page_link .="<b>".$this->lr."</b>";
				}else{
					$this->page_link .="<a href='{$_SERVER['PHP_SELF']}?p=$this->lr&{$other}'>$this->lr</a>";
				}
			}
			$this->next = $this->current_page+1;
			$this->pre = $this->current_page-1;
			$this->page_link = "<a href='{$_SERVER['PHP_SELF']}?p=1&{$other}'>首页</a><a href='{$_SERVER['PHP_SELF']}?p={$this->pre}&{$other}'>上一页</a>".$this->page_link;
			if($this->current_page < $this->pages){
				$this->page_link .= "<a href='{$_SERVER['PHP_SELF']}?p={$this->next}&{$other}'>下一页</a>";
			}
			
		}
		echo "总{$this->total}条，每页显示{$this->per}条信息,共计{$this->pages}页".$this->page_link;
	}
	public function bye(){
		mysql_free_result($this->rs);
		mysql_close($this->conn);
	}
}

function myfilter($x,$ZealoT){
	if(trim($x)==""){
		$s="";
		return $s;
	}
	if($ZealoT==7){
		$s=$x;		
	}else{
		$s=strip_tags($x);//剥去 HTML、XML 以及 PHP 的标签
	}
	if($ZealoT==7){
		$s=$x;		
	}else{
		$s=htmlspecialchars($s,ENT_QUOTES);//把一些预定义的字符转换为 HTML 实体,单、双引号、和号、大于、小于，默认仅转换双引号，所以要设置ENT_QUOTES
	}
	if(!get_magic_quotes_gpc()){
		//$s=mysql_escape_string($s);//转义 SQL 语句中使用的字符串中的特殊字符
		//Deprecated: mysql_escape_string(): This function is deprecated; use mysql_real_escape_string() instead. 
		$s=mysql_real_escape_string($s);
	}	
	return $s;
}

class page_lister_7x{
	public $conn,$total,$i,$pages,$per,$current_page,$p_index,$index_middle,$page_link,$pre,$next,$left,$right,$lr,$page_sql;
	public $rs;
		
	public function __construct($host,$usr,$psw,$data,$sum_sql,$sql,$per_page,$page_index){
		$this->conn=mysql_connect($host,$usr,$psw);
		mysql_select_db($data);
		$this->per=$per_page;
		$this->rs=mysql_query($sum_sql,$this->conn);
		$this->total=mysql_num_rows($this->rs);
		if($this->total%$this->per==0){
			$this->pages=intval($this->total/$this->per);
		}else{	
			$this->pages=ceil($this->total/$this->per);
		}
		if(isset($_GET['p'])&&is_numeric($_GET["p"])&&($_GET["p"]>0)&&($_GET["p"]<=$this->pages)){
			$this->current_page= $_GET['p'];
		}else{
			$this->current_page= 1;
		}
		$this->p_index=$page_index;
		$this->index_middle=ceil($this->p_index/2);
		$this->page_link="";
		$this->page_sql=$sql." limit ".($this->current_page-1)*$this->per.",".$this->per;
		$this->rs=mysql_query($this->page_sql,$this->conn);	
	}
	
	public function show($other,$to){
		if($this->pages<$this->p_index){
			for($this->i = 1; $this->i <= $this->pages; $this->i++){
				if($this->current_page == $this->i){
					$this->page_link .="<a class='current'>".$this->i."</a>";
				}else{
					$this->page_link .="<a href='".$_SERVER['PHP_SELF']."?p=".$this->i."&".$other."'>".$this->i."</a>";
				}
			}
			//上、下 页.begin
			if($this->current_page > 1){
				$this->pre = $this->current_page-1;
				$this->page_link = "<a href='{$_SERVER['PHP_SELF']}?p={$this->pre}&{$other}'>上一页</a>".$this->page_link;
			}
			if($this->current_page < $this->pages){
				$this->next = $this->current_page+1;
				$this->page_link .= "<a href='{$_SERVER['PHP_SELF']}?p={$this->next}&{$other}'>下一页</a>";
			}
			//上、下 页.end
			
		}elseif($this->current_page <= $this->index_middle){
			for($this->i = 1; $this->i <= $this->p_index; $this->i++){
				if($this->current_page == $this->i){
					$this->page_link .="<a class='current'>".$this->i."</a>";
				}else{
					$this->page_link .="<a href='{$_SERVER['PHP_SELF']}?p={$this->i}&{$other}'>{$this->i}</a>";
				}
			}

			//上、下 页.begin
			$this->pre = $this->current_page-1;
			$this->next = $this->current_page+1;
			if($this->current_page != 1){
				$this->page_link = "<a href='{$_SERVER['PHP_SELF']}?p={$this->pre}&{$other}'>上一页</a>".$this->page_link;
			}
			$this->page_link .= "...<a href='{$_SERVER['PHP_SELF']}?p=$this->pages&{$other}'>{$this->pages}</a><a href='{$_SERVER['PHP_SELF']}?p={$this->next}&{$other}'>下一页</a>";
			//上、下 页.end
		
		}elseif($this->current_page > $this->index_middle && ($this->current_page <= ($this->pages-$this->index_middle))){
			if(($this->p_index % 2) == 0){
				$this->left = $this->index_middle-1;
				$this->right = $this->index_middle;
			}else{
				$this->left = $this->right = $this->index_middle-1;
			}

			$this->pre = $this->current_page-1;
			$this->next = $this->current_page+1;
			$this->page_link .= "<a href='{$_SERVER['PHP_SELF']}?p=1&{$other}'>首页</a><a href='{$_SERVER['PHP_SELF']}?p={$this->pre}&{$other}'>上一页</a>";	
	
			for($this->i = $this->left ; $this->i >=1 ;$this->i--){
					$this->lr = $this->current_page-$this->i;
					$this->page_link .="<a href='{$_SERVER['PHP_SELF']}?p={$this->lr}&{$other}'>{$this->lr}</a>";	
			}
			$this->page_link .=  "<a class='current'>".$this->current_page."</a>";
			
			for($this->i = 1; $this->i <= $this->right; $this->i++){
				$this->lr = $this->current_page+$this->i;
				$this->page_link .="<a href='{$_SERVER['PHP_SELF']}?p={$this->lr}&{$other}'>{$this->lr}</a>";	
			}

			$this->page_link .= "...<a href='{$_SERVER['PHP_SELF']}?p=$this->pages&{$other}'>{$this->pages}</a><a href='{$_SERVER['PHP_SELF']}?p={$this->next}&{$other}'>下一页</a>";
			
		}else{
			for($this->i = $this->p_index-1; $this->i >= 0; $this->i--){
				$this->lr = $this->pages-$this->i;
				if($this->current_page == $this->lr){
					$this->page_link .="<a class='current'>".$this->lr."</a>";
				}else{
					$this->page_link .="<a href='{$_SERVER['PHP_SELF']}?p={$this->lr}&{$other}'>{$this->lr}</a>";
				}
			}

			$this->next = $this->current_page+1;
			$this->pre = $this->current_page-1;
			$this->page_link = "<a href='{$_SERVER['PHP_SELF']}?p=1&{$other}'>首页</a><a href='{$_SERVER['PHP_SELF']}?p={$this->pre}&{$other}'>上一页</a>".$this->page_link;
			if($this->current_page < $this->pages){
				$this->page_link .= "<a href='{$_SERVER['PHP_SELF']}?p={$this->next}&{$other}'>下一页</a>";
			}
		
		}
		//echo "总{$this->total}条，每页显示{$this->per}条信息,共计{$this->pages}页".$this->page_link;
		echo $this->page_link;
		/*
		echo "<span class=\"Goto\">";
		echo $to;
		echo "<select onChange='javascript:location.href=this.options[selectedIndex].value' class='PageInput'>";
		for($t=1;$t<=$this->pages;$t++){
			echo "<option value='?p=".$t."&".$other."'";
        	if($t==$this->current_page){
        		echo "selected='selected'>".$t."</option>";
        	}else{
        		echo ">".$t."</option>";
        	}
		}
		echo "</select></span>";
		*/
	}
	public function bye(){
		mysql_free_result($this->rs);
		mysql_close($this->conn);
	}
}
?>