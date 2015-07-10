//2012/3/6 17:13 Created by ZealoT

function zt(zealot){
	return document.getElementById(zealot);	
}

function checkit(wow,msg){
	str=document.getElementById(wow).value;
	str=str.replace(/'/g,""); 
	str=str.replace(/"/g,"");
	str=str.replace(/`/g,"");
	str=str.replace(/\\/g,"");
	str=str.replace(/ /g,"");
	str=str.replace(/	/g,"");
	if(str==""){
		window.alert(msg);
		document.getElementById(wow).focus();
		document.getElementById(wow).style.border="1px dashed red";
		return true;
	}	
}
function checkit_s(wow){
	str=document.getElementById(wow).value;
	str=str.replace(/'/g,""); 
	str=str.replace(/"/g,"");
	str=str.replace(/`/g,"");
	str=str.replace(/\\/g,"");
	str=str.replace(/ /g,"");
	str=str.replace(/	/g,"");
	if(str==""){
		document.getElementById(wow).focus();
		document.getElementById(wow).style.border="1px dashed red";
		return true;
	}
}

function check_select(wow,msg){
	str=document.getElementById(wow).value;
	if(str==0||str==""){
		window.alert(msg);
		document.getElementById(wow).focus();
		document.getElementById(wow).style.border="1px dashed red";
		return true;
	}
}

var TbRow = document.getElementById("bsinfo");
if (TbRow != null)
{
	for (var i=0;i<TbRow.rows.length ;i++ ){
		TbRow.rows[i].style.backgroundColor="#F7F8F9";
	}
}

function really(){
	var r=confirm("È·¶¨ÒªÉ¾³ýÂð£¿")
	if (r!=true){	
		return false;	
	}
}