<?php
require_once("inc/function.php");
if(!(isset($_GET["id"])&&check_int($_GET["id"]))||!(isset($_GET["fid"])&&check_int($_GET["fid"]))){
	header("Content-type: text/html; charset=utf-8"); 
	msg("Invalid Argument!");
	jump("index.php");
}
require_once("inc/config.php");
require_once("inc/conn.php");
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

    <script type="text/javascript" src="js/jquery-1.6.4.min.js"></script>
    <script type="text/javascript" src="js/jquery.nivo.slider.js"></script>
    <script type="text/javascript" src="js/cufon-yui.js"></script>
    <script type="text/javascript" src="js/TitilliumText.font.js"></script>
    <script type="text/javascript" src="js/scripts.js"></script>
    <script type="text/javascript" src="js/custom.js"></script>
    <script type="text/javascript" src="js/shortcode.js"></script>
    <!--[if IE 7]>
    <link rel="stylesheet" type="text/css" href="css/ie7.css"><![endif]-->
</head>
<body class="home">
<!--Header-->
<?php require_once("head.php");?>
<!--/Header--><!--Body content-->
<?php
$sql="select * from hy_product where id=".$_GET["id"];
$rs=mysql_query($sql,$conn);
$row=mysql_fetch_assoc($rs);

$sql="select * from hy_product_category where id=".$_GET["fid"];
$rs=mysql_query($sql,$conn);
$pcrow=mysql_fetch_assoc($rs);
?>
<div class="full-width-wrapper">
    <div class="fixed-width-wrapper" id="body-content"><!--Content-->
        <div id="content" class="float-left content-left">
            <div class="header-text">
                <ul id="breadcrumbs">
                    <li><a href="index.php" title="">首页</a></li>
                    <li><a href="#" title="">产品中心</a></li>
                    <li class="current"><a href="products.php?fid=<?php echo $pcrow['id'] ?>" title=""><?php echo $pcrow['name'] ?></a></li>
              </ul>
              <h1 class="first-word double-color sp"><span><?php echo $row['name'] ?></span></h1>

            </div>
            <div class="entry-content">
                <div class=""><p>

                    <h3>描述</h3><?php echo $row['description'] ?></p></div>
                <div class="hr clear sp"></div>
                <div class=""><p>

                    <h3>特性</h3>
                    <?php echo $row['feature'] ?>
                    </p></div>
                <div class="hr clear sp"></div>

                <div class="">
                    <p>
                    <h3>参数</h3>
                    <table width="100%" class="m-table">
                        <tbody>
<?php
$sql="select pcp.name,pp.myvalue,pcp.sortnum from hy_product_parameter as pp left join hy_product_category_parameter as pcp on pp.parameter_id=pcp.id where pp.product_id={$_GET['id']} order by pcp.sortnum asc";
$rs=mysql_query($sql,$conn);
while($row=mysql_fetch_assoc($rs)){
?>
                        <tr class="alternate">
                            <th class="first-child"><?php echo $row['name'] ?></th>
                            <td><?php echo $row['myvalue'] ?></td>
                        </tr>
 	<?php
    }
    ?>                        
                        </tbody>
                    </table>
                  </p>
                </div>
                <div class="hr clear sp"></div>
                <div class="">
                    <p>
                    <h3>附件下载</h3>
                    <?php
    $sql="select * from hy_product_file where fid={$_GET['id']} order by id desc";
    $rs=mysql_query($sql,$conn);
    while($row=mysql_fetch_assoc($rs)){
    ?>
                    <a href="uploads/<?php echo getPath($row['file'],'file'); ?>"><?php echo $row['name'] ?></a>
     	<?php
    }
    ?>                        
          
                    </p>
                </div>
                <div class="hr clear sp"></div>
                <div class="">
                    <p>
                    <h3>方框图</h3>
                    <div class="diagram">
                                   <?php
	$sql="select * from hy_product_scheme where fid={$_GET['id']} order by id desc";
    $rs=mysql_query($sql,$conn);
    while($row=mysql_fetch_assoc($rs)){
    ?> 
                        <h6><?php echo $row['name'] ?></h6>
                        <img src="uploads/<?php echo getPath($row['pic'],'scheme'); ?>">
 	<?php
    }
    ?>
                    </div>
                    </p>
                </div>
            </div>
        </div>
        <!--/Content--><!--Sidebar-->
        <div id="sidebar" class="float-right"><!--box-->
            <div class="box">
                <h1 class="first-word double-color sp">产品中心</h1>
                <ul class="list cat">
                    <li><a href="products.html#01" title="">POWER MOSFET</a></li>
                    <li class="current"><a href="products.html#02" title="">电源管理类</a>
                        <ul class="list cat">
                            <li><a href="products.html#02/01" title="">DC-DC Converter</a></li>
                            <li><a href="products.html#02/02" title="">PWM Controller</a></li>
                        </ul>
                    </li>
                    <li><a href="products.html#03" title="">集成运算放大器</a></li>
                    <li><a href="products.html#04" title="">FBM系列产品</a></li>
                </ul>
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
            </div>
            <!--/box-->
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