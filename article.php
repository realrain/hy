<?php
require_once("inc/function.php");
if(!(isset($_GET["id"])&&check_int($_GET["id"]))||!(isset($_GET["fid"])&&check_int($_GET["fid"]))){
	header("Content-type: text/html; charset=utf-8"); 
	msg("Invalid Argument!");
	jump("index.php");
}
require_once("inc/config.php");
require_once("inc/conn.php");

$sql="select * from hy_article where id=".$_GET["id"];
$rs=mysql_query($sql,$conn);
$row=mysql_fetch_assoc($rs);

$topid=intval($_GET["fid"]);

$sql="select * from hy_category where id=".$_GET["fid"];
$rs=mysql_query($sql,$conn);
$crow=mysql_fetch_assoc($rs);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $row['title']; ?> --- <?php echo $crow['name']; ?> --- 后羿科技</title>
<link rel="stylesheet" type="text/css" href="css/reset.css">
<link rel="stylesheet" type="text/css" href="css/base.css">
<link rel="stylesheet" type="text/css" href="css/tipTip.css">
<link rel="stylesheet" type="text/css" href="css/short-code.css">
<link rel="stylesheet" type="text/css" href="css/prettyPhoto.css">
<link rel="stylesheet" type="text/css" href="css/css3.css">
<link rel="stylesheet" type="text/css" href="css/slider.css">
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">

<script type="text/javascript" src="js/jquery-1.6.4.min.js"></script>
<script type="text/javascript" src="js/jquery.nivo.slider.js"></script>
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/TitilliumText.font.js"></script>
<script type="text/javascript" src="js/scripts.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<script type="text/javascript" src="js/shortcode.js"></script><!--[if IE 7]><link rel="stylesheet" type="text/css" href="css/ie7.css"><![endif]-->
</head>
<body class="home">
<!--Header-->
<?php require_once("head.php");?>
<!--/Header--><!--Body content-->
<?php
if($crow['fid']!=0){
  $sql="select * from hy_category where id=".$crow['fid'];;
  $rs=mysql_query($sql,$conn);
  $toprow=mysql_fetch_assoc($rs);
  $topid=$toprow['id'];
}else{
  $topid=$crow['id'];
}
?>
<div class="full-width-wrapper">
  <div class="fixed-width-wrapper" id="body-content"><!--Content-->
    <div id="content" class="float-left content-left">
      <div class="header-text">
        <ul id="breadcrumbs">
          <?php
          if($topid==1){
          ?>
          <li><a href="index.php" title="">首页</a></li>
          <li><a href="#" title="">新闻中心</a></li>
          <li class="current"><a href="articlelist.php?fid=<?php echo $_GET["fid"] ?>" title=""><?php echo $crow['name']; ?></a></li>
          <?php
          }
          ?>
          <?php
          if($topid==4){
          ?>
          <li><a href="index.php" title="">首页</a></li>
          <li><a href="services.php" title="">服务中心</a></li>
          <li class="current"><a href="articlelist.php?fid=<?php echo $_GET["fid"] ?>" title=""><?php echo $crow['name']; ?></a></li>
          <?php
          }
          ?>
        </ul>
        <h1 class="first-word double-color sp"></h1>
      </div>
      <div class="entry-heading">
        <div class="calendar white">
          <h1><?php echo date("d",strtotime($row['create_time'])); ?></h1>
          <span><?php $month=date("m",strtotime($row['create_time']));echo intval($month); ?>月</span></div>
        <h2 class="first-word"><?php echo $row['title']; ?></h2>
        <div class="posts-info"><span class="date" title=""><?php echo $row['create_time']; ?></span><span class="user"><a href="#"><?php echo $row['poster']; ?></a></span><span class="category"><a href="#"><?php echo $crow['name']; ?></a></span></div>
      </div>
      <div class="post entry-content sp">
        <?php echo $row['contents']; ?>
      </div>
    </div>
    <!--/Content--><!--Sidebar-->
    <div id="sidebar" class="float-right"><!--box-->
      <div class="box">
        <?php
          if($topid==1){
          ?>
        <h1 class="first-word double-color sp">新闻中心</h1>
        <ul class="list cat">
          <li<?php echo $_GET["fid"]==2?' class="current"':'' ?>><a href="articlelist.php?fid=2" title="">公司新闻</a></li>
          <li<?php echo $_GET["fid"]==3?' class="current"':'' ?>><a href="articlelist.php?fid=3" title="">业内新闻</a></li>
        </ul>
        <?php
          }
          ?>

        <?php
          if($topid==4){
          ?>
        <h1 class="first-word double-color sp">服务中心</h1>
        <ul class="list cat">
          <li<?php echo $_GET["fid"]==5?' class="current"':'' ?>><a href="articlelist.php?fid=5" title="">技术支持</a></li>
          <li<?php echo $_GET["fid"]==6?' class="current"':'' ?>><a href="articlelist.php?fid=6" title="">质量报告</a></li>
          <li<?php echo $_GET["fid"]==7?' class="current"':'' ?>><a href="articlelist.php?fid=7" title="">SGS报告</a></li>
        </ul>
        <?php
          }
          ?>
      </div>
      <div class="box">
        <h3 class="first-word double-color sp">联系我们</h3>
        <ul class="list quote">
          <li>
            <p> 西安后羿半导体科技有限公司<br/>
地址：西安市电子城电子西街3号西京国际电气中心712-713室<br/>
电话：+86-029-88381060<br/>
传真：+86-029-88381925 </p>
            </li>
          <li>
            <p><img src="images/map.jpg" width="100%" height="auto" alt=""/></p>
            <a href="#"><i class="fa fa-location-arrow fa-fw"></i> <b> 更多联系方式</b></a></li>
        </ul>
      </div><!--/box-->
      </div>
    <!--/Sidebar--><!--Get in touch-->
    <div id="get-in-touch" class="fixed-width-wrapper">
      <div class="via-phone-number float-left"><a class="icon sprite float-left" title="联系我们">专业的技术解答与服务。请拨打热线</a>
        <h4>专业的技术解答与服务。请拨打热线<strong>+86-029-88381060</strong></h4>
        <span><a href="#">点击这里</a>，您将在线给我们的技术客服留下信息，我们会及时的给您回复。</span></div>
      <div class="via-email float-right">
        <?php require_once("subscribe.php");?>
      </div>
    </div>
    <!--/Get in touch--></div>
</div>

<!--/Body content--><!--Footer Extra-->
<?php
require_once("footer.php");
?>
<!--/Footer Extra-->
<?php
mysql_free_result($rs);
mysql_close($conn);
?>
</body>
</html>