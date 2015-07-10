<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>后羿科技</title>
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
<?php
require_once("inc/config.php");
require_once("inc/conn.php");
require_once("inc/function.php");
?>
<!--Header-->
<?php require_once("head.php");?>
<!--/Header--><!--Slider-->
<div class="clear" id="slider-bg">
  <div class="full-width-wrapper" id="slider-frame">
    <div class="fixed-width-wrapper maxx-theme" id="slider-wrapper">
      <div id="slider" class="nivoSlider">
<?php
$sql="select pic,link from hy_banner order by id desc";
$rs=mysql_query($sql,$conn);
while($row=mysql_fetch_assoc($rs)){
?>
        <a href="<?php echo $row["link"]==""?"javascript:void(0)":$row["link"];?>"><img src="uploads/<?php echo getPath($row['pic'],'banner'); ?>" alt=""></a>
<?php
}
?>
      </div>
    </div>
  </div>
</div>
<!--/Slider--><!--Body content-->
<div class="full-width-wrapper">
  <div class="fixed-width-wrapper body-divider " id="body-content"><!--Entry-->
    <div class="entry three-column fixed-width-wrapper"><!--block-->
      <div class="block type1">
        <h1 class="first-word double-color"><span>专业</span>领域</h1>
        <div class="content"><a href="#" title="" class="preloading-light img-border align-none"><img src="images/pix/slide1.jpg" width="280" alt=""></a>
          <div class="clear"></div>
          <p>西安后羿半导体科技有限公司，成立于2008年，公司以高新技术为核心，致力于电子元器件国产化的设计研发和生产。</p>
          <p>经过五年的不懈努力，现已成为从事中高压大功率场效应管（MOSFET）及电源管理IC等功率器件和模拟集成电路的设计研发、生产和销售为一体的高新技术企业。 </p>
        </div>
        <a class="read-more-cn" href="about.php" title="Read more">了解更多</a></div>
      <!--/block--><!--block-->
      <div class="block type2">
        <h1 class="first-word double-color"><span>我们</span>的实力</h1>
        <div class="content">
          <ul class="zigzag list">
            <li><img src="images/icons/clipboard_48.png" alt="" class="align-right"><strong>研发与设计团队</strong><span>公司拥有强大的研发与设计团队，研发人员占员工总数的46%，产品技术和工艺目前处于国内同行业领先水平。</span></li>
            <li><img src="images/icons/bug_48.png" alt="" class="align-left"><strong>生产设备与能力</strong><span>公司拥有先进的产线设备，完整的检测中心，严格的专人专项管理，保障了产品的高一致性和高可靠性。</span></li>
            <li><img src="images/icons/help_48.png" alt="" class="align-right"><strong>经营理念&优良的品质&高效的服务</strong><span>公司秉承“民族为本，诚信至上”的核心理念，技术不断创新，以满足国内客户的批量订单。</span></li>
          </ul>
        </div>
        <a class="read-more-cn" href="services.php" title="Read more">了解更多</a></div>
      <!--/block--><!--block-->
      <div class="block type3">
        <h1 class="first-word double-color"><span>您的</span>选择</h1>
        <div class="content">
          <p>随着后羿半导体的不断壮大，公司已先后在无锡、天津、徐州、成都设立了办事处，在深圳指定了专业代理商，以便为客户提供更快更直接的服务。</p>
          <ul class="list point">
            <li><a href="#" title=""><em>1.</em>西安后羿半导体科技有限公司</a></li>
            <li><a href="#" title=""><em>2.</em>西安后羿半导体科技有限公司无锡办事处</a></li>
            <li><a href="#" title=""><em>3.</em>西安后羿半导体科技有限公司天津办事处</a></li>
            <li><a href="#" title=""><em>4.</em>西安后羿半导体科技有限公司徐州办事处</a></li>
            <li><a href="#" title=""><em>5.</em>西安后羿半导体科技有限公司成都办事处</a></li>
          </ul>
        </div>
        <a class="read-more-cn" href="contact.php" title="Read more">了解更多</a></div>
      <!--/block--></div>
    <!--/Entry--><!--Get in touch-->
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
<!--/Body content--><!--Footer content-->
<div class="full-width-wrapper" id="footer-wrapper">
  <div class="fixed-width-wrapper" id="footer-content">
    <div class="three-column">
      <div class="block">
        <h3 class="first-word"><span>业内</span>新闻</h3>
        <div class="content">
          <ul class="list tweet">
<?php
$sql="select * from hy_article where fid=3 order by id desc limit 3";
$rs=mysql_query($sql,$conn);
while($row=mysql_fetch_assoc($rs)){
?>   
            <li>
              <p><a href="article.php?id=<?php echo $row['id']; ?>&fid=<?php echo $row['fid']; ?>" title="<?php echo $row['title']; ?>"><?php echo $row['title']; ?></a></p>
              <em><?php echo $row['create_time'] ?></em>
            </li>
<?php
}
?>
          </ul>
        </div>
      </div>
      <div class="block">
        <h3 class="first-word"><span>最新</span>产品</h3>
        <div class="content">
          <ul class="flick-gallery overflow-hidden">
<?php
$sql="select * from hy_product order by id desc limit 0,6";
$rs=mysql_query($sql,$conn);
while($row=mysql_fetch_assoc($rs)){
?>
            <li><a class="preloading-dark" title="<?php echo $row['name']; ?>"><img src="uploads/<?php echo getPath($row['thumb'],'thumb'); ?>" alt="<?php echo $row['name']; ?>" ></a></li>
<?php
}
?>
          </ul>
        </div>
      </div>
      <div class="block">
        <h3 class="first-word"><span>公司</span>新闻</h3>
        <div class="content">
          <ul class="latest-news list">
<?php
$sql="select * from hy_article where fid=2 order by id desc limit 2";
$rs=mysql_query($sql,$conn);
while($row=mysql_fetch_assoc($rs)){
?>  
            <li>
              <div class="calendar black">
                <h1><?php echo date("d",strtotime($row['create_time'])); ?></h1>
                <span><?php $month=date("m",strtotime($row['create_time']));echo intval($month); ?>月</span>
              </div>              
              <a href="article.php?id=<?php echo $row['id']; ?>&fid=<?php echo $row['fid']; ?>" title=""><strong><?php echo $row['title']; ?></strong></a>
              <p><?php echo mb_substr(myfilter($row['contents'],3),0,50,'utf-8'); ?>......</p>
            </li>
<?php
}
?>
          </ul>
          <a href="articlelist.php?fid=2" class="link view-all" title="">查看所有新闻</a></div>
      </div>
    </div>
  </div>
</div>
<!--/Footer content--><!--Footer Extra-->
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