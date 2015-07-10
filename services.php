<?php
require_once("inc/config.php");
require_once("inc/conn.php");
require_once("inc/function.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>服务中心 --- 后羿科技</title>
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
<div class="full-width-wrapper">
  <div class="fixed-width-wrapper" id="body-content"><!--Content-->
    <div id="content" class="fixed-width-wrapper">
      <div class="header-text">
        <ul id="breadcrumbs">
          <li><a href="index.php" title="">首页</a></li>
          <li class="current"><a href="#" title="">服务中心</a></li>
        </ul>
        <h1 class="first-word double-color sp"><span>服务</span>中心</h1>
      </div>
      <div class="post entry-content"><img src="images/pix/mock.png" alt="" class="align-left" >
        <p>新技术正致力于提高芯片在从太空到人体的各种环境中的性能。这些复杂的系统需要一个专为此使命而设计的可靠且经济高效的封装。后羿将封装技术与设计、材料、装配工艺、成本效益、质量和容量相结合，使我们的客户可以从他们的创新中获得最多价值</p>
        <p>新技术正致力于提高芯片在从太空到人体的各种环境中的性能。这些复杂的系统需要一个专为此使命而设计的可靠且经济高效的封装。后羿将封装技术与设计、材料、装配工艺、成本效益、质量和容量相结合，使我们的客户可以从他们的创新中获得最多价值</p>
      </div>
      <!--services-->
      <div class="three-column fixed-width-wrapper services"><!--block-->
        <div class="block">
          <div class="service-heading"><img src="images/icons/pencil_48.png" alt="" >
            <h3 class="first-word">技术支持</h3>
            <span>技术资源及技术文章...</span></div>
          <div class="content">
            <ul class="unordered-list">
            <?php
$sql="select * from hy_article where fid=5 order by id desc limit 6";
$rs=mysql_query($sql,$conn);
while($row=mysql_fetch_assoc($rs)){
?>  
            <li><a href="article.php?fid=<?php echo $row["fid"] ?>&id=<?php echo $row["id"] ?>" target="_blank"><?php echo $row['title']; ?></a></li>
<?php
}
?>
        	  </ul>
          </div>
          <a class="read-more-cn" href="articlelist.php?fid=5" title="Read more">Read more</a></div>
        <!--/block--><!--block-->
        <div class="block">
          <div class="service-heading"><img src="images/icons/statistics_48.png" alt="" >
            <h3 class="first-word">质量管理</h3>
            <span>质量、可靠性、封装及环保信息....</span></div>
          <div class="content">
            <ul class="unordered-list">
            <?php
$sql="select * from hy_article where fid=6 order by id desc limit 6";
$rs=mysql_query($sql,$conn);
while($row=mysql_fetch_assoc($rs)){
?>  
            <li><a href="article.php?fid=<?php echo $row["fid"] ?>&id=<?php echo $row["id"] ?>" target="_blank"><?php echo $row['title']; ?></a></li>
<?php
}
?>
        	  </ul>
          </div>
          <a class="read-more-cn" href="articlelist.php?fid=6" title="Read more">Read more</a></div>
        <!--/block--><!--block-->
        <div class="block">
          <div class="service-heading"><img src="images/icons/briefcase_48.png" alt="" >
            <h3 class="first-word">SGS报告</h3>
            <span>检验、检测、鉴定报告或认证证书....</span></div>
          <div class="content">
            <ul class="unordered-list">
                        <?php
$sql="select * from hy_article where fid=7 order by id desc limit 6";
$rs=mysql_query($sql,$conn);
while($row=mysql_fetch_assoc($rs)){
?>  
            <li><a href="article.php?fid=<?php echo $row["fid"] ?>&id=<?php echo $row["id"] ?>" target="_blank"><?php echo $row['title']; ?></a></li>
<?php
}
?>
        	  </ul>
          </div>
          <a class="read-more-cn" href="articlelist.php?fid=7" title="Read more">Read more</a></div>
        <!--/block--></div>
      <!--/services--></div>
    <!--/Content--><!--Get in touch-->
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
//mysql_free_result($rs);
//mysql_close($conn);
?>
</body>
</html>