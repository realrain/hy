<?php
require_once("inc/function.php");
if(empty($_GET["q"])){
  header("Content-type: text/html; charset=utf-8"); 
  msg("Invalid Argument!");
  jump("index.php");
}
require_once("inc/config.php");
require_once("inc/conn.php");
$q=myfilter($_GET["q"],3);
?>
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
<link rel="stylesheet" type="text/css" href="css/footable.core.css?v=2-0-1"/>
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/jquery.nivo.slider.js"></script>
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/TitilliumText.font.js"></script>
<script type="text/javascript" src="js/scripts.js"></script>
<script type="text/javascript" src="js/shortcode.js"></script>

<script type="text/javascript" src="js/footable.js?v=2-0-1"></script>
<!--<script type="text/javascript" src="js/custom.js"></script>-->

</head>
<body class="home">
<?php require_once("head.php");?>
<div class="full-width-wrapper">
  <div class="fixed-width-wrapper" id="body-content"><!--Content-->
    <div id="content" class="fixed-width-wrapper">
      <div class="header-text">
        <ul id="breadcrumbs">
          <li><a href="#" title="">首页</a></li>
          <li class="current"><a href="#" title="">产品中心</a></li>
        </ul>
        <h1 class="first-word double-color sp">产品中心</h1>
      </div>      
      <?php
$pagex=new page_lister_7x($mysqlhost,$mysqlname,$mysqlpsw,$mydata,"select id from hy_product where name like '%{$q}%' or description like '%{$q}%' or feature like '%{$q}%'","select * from hy_product where name like '%{$q}%' or description like '%{$q}%' or feature like '%{$q}%'","12","7");
while($row=mysql_fetch_assoc($pagex->rs)){
?>   
      <table width="978" border="1" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
        <tr>
          <td valign="middle" bgcolor="#FFFFFF"><?php echo $row['id'] ?></td>
          <td valign="middle" bgcolor="#FFFFFF"><?php echo $row['name'] ?></td>
          <td valign="middle" bgcolor="#FFFFFF"><img src="uploads/<?php echo getPath($row['thumb'],'thumb'); ?>" alt="<?php echo $row['name']; ?>" ></td>
          <td valign="middle" bgcolor="#FFFFFF"><?php echo $row['description'] ?></td>
          <td valign="middle" bgcolor="#FFFFFF"><?php echo $row['feature'] ?></td>
        </tr>
      </table>
                  <?php
}
?>
      <div class="clear"></div>
      <div class="page-pagination clear fixed-width-wrapper">
      <?php 
$pagex->show("q=".$q,"");
?>
      </div>
      <!--/Pagination--> 
      
      <!--/Full width--></div>
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
<div class="full-width-wrapper" id="footer-extra-wrapper">
  <div class="fixed-width-wrapper">
    <div id="copyright"><a href="#" class="logo float-left" title=""><img src="images/logo-footer.png" alt=""></a>
      <ul>
        <li>© 2015 HOOYI Semiconductor Co.,Ltd. ALLRIGHT RESERVRED</li>
        <li><a href="#" title="">首页</a></li>
        <li><a href="#" title="">联络我们</a></li>
        <li><a href="http://www.cssmoban.com" title="">网站使用条例</a></li>
      </ul>
      <a href="#" class="back-to-top sprite" title="Back to top">返回顶部</a></div>
  </div>
</div>
<p> Search:
  <input id="filter" type="text"/>
  Status:
  <select class="filter-status">
    <option></option>
    <option value="active">Active</option>
    <option value="disabled">Disabled</option>
    <option value="suspended">Suspended</option>
  </select>
  <a href="#clear" class="clear-filter" title="clear filter">[clear]</a> <a href="#api" class="filter-api" title="Filter using the Filter API">[filter API]</a> </p>

    <script type="text/javascript">
        $(function () {
			$('table').footable();
			
        });
    </script>
</body>
</html>
