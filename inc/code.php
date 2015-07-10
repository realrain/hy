<?php
session_start();
header("content-type:image/png");
$image_width=80;
$image_height=20;
$num="";
for($i=0;$i<4;$i++){
	$num.=dechex(rand(0,15));//HEX,16=10
}
$_SESSION["codepicx"]=$num;
$num_pic=imagecreate($image_width,$image_height);//WIDTH HEIGHT
imagecolorallocate($num_pic,rand(170,220),rand(170,220),rand(170,220));//BGCOLOR
$color=imagecolorallocate($num_pic,rand(0,200),rand(0,200),rand(0,200));
imagestring($num_pic,5,20,3,$num,$color);
imagepng($num_pic);//IMAGE RESOURCE
imagedestroy($num_pic);//realse
?>