<?php
require_once("inc/function.php");
if(!(isset($_GET["fid"])&&check_int($_GET["fid"]))){
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
      <table class="table m-table" data-filter="#filter" data-filter-text-only="true">
        <thead>
          <tr>
            <th index="0">Product Name</th>
            <?php
$sql="select * from hy_product_category_parameter where fid={$_GET['fid']} order by sortnum asc";
$rs=mysql_query($sql,$conn);
while($row=mysql_fetch_assoc($rs)){
?>
            <th index="1"><?php echo $row['name'] ?></th>
<?php
}
?>            
          </tr>
        </thead>
        <tbody>
<?php
$pagex=new page_lister_7x($mysqlhost,$mysqlname,$mysqlpsw,$mydata,"select id from hy_product where fid={$_GET['fid']}","select * from hy_product where fid={$_GET['fid']} order by id desc","12","7");
while($row=mysql_fetch_assoc($pagex->rs)){
?>      
        <tr>
            <td align="center"><div class="check"></div>
            <div class="name"><a id="o1_flyout" href="product.php?id=<?php echo $row['id'] ?>&fid=<?php echo $row['fid'] ?>" target="_tiProd"><?php echo $row['name'] ?></a> <?php echo $row['description'] ?></div></td>              
	<?php
    $sqlx="select * from hy_product_parameter as pp left join hy_product_category_parameter as pcp on pp.parameter_id=pcp.id where pp.product_id={$row['id']} order by pcp.sortnum asc";
    $rsx=mysql_query($sqlx,$conn);
    while($rowx=mysql_fetch_assoc($rsx)){
    ?>
            <td align="center"><?php echo $rowx['myvalue'] ?></td>
	<?php
    }
    ?> 
          </tr>
            <?php
}
?>
        </tbody>
      </table>
      <!--Full width--> 
      
      <!--<table class="table m-table" data-filter="#filter" data-filter-text-only="true">
        <thead>
        <tr>
          <th data-toggle="true">
            First Name
          </th>
          <th>
            Last Name
          </th>
          <th>
            Job Title
          </th>
          <th>
            DOB
          </th>
          <th data-hide="phone">
            Status
          </th>
          <th data-hide="phone">
            Status
          </th>
          <th data-hide="phone">
            Status
          </th>
          <th data-hide="phone">
            Status
          </th>
          <th data-hide="phone">
            Status
          </th>
          <th data-hide="phone">
            Status
          </th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td>Isidra</td>
          <td><a href="#">Boudreaux</a></td>
          <td>Traffic Court Referee</td>
          <td data-value="78025368997">22 Jun 1972</td>
          <td data-value="1"><span class="status-metro status-active" title="Active">Active</span></td>
          <td data-value="1"><span class="status-metro status-active" title="Active">Active</span></td>
          <td data-value="1"><span class="status-metro status-active" title="Active">Active</span></td>
          <td data-value="1"><span class="status-metro status-active" title="Active">Active</span></td>
          <td data-value="1"><span class="status-metro status-active" title="Active">Active</span></td>
          <td data-value="1"><span class="status-metro status-active" title="Active">Active</span></td>
        </tr>
        <tr>
          <td>Shona</td>
          <td>Woldt</td>
          <td><a href="#">Airline Transport Pilot</a></td>
          <td data-value="370961043292">3 Oct 1981</td>
          <td data-value="2"><span class="status-metro status-disabled" title="Disabled">Disabled</span></td>
          <td data-value="2"><span class="status-metro status-disabled" title="Disabled">Disabled</span></td>
          <td data-value="2"><span class="status-metro status-disabled" title="Disabled">Disabled</span></td>
          <td data-value="2"><span class="status-metro status-disabled" title="Disabled">Disabled</span></td>
          <td data-value="2"><span class="status-metro status-disabled" title="Disabled">Disabled</span></td>
          <td data-value="2"><span class="status-metro status-disabled" title="Disabled">Disabled</span></td>
        </tr>
        <tr>
          <td>Granville</td>
          <td>Leonardo</td>
          <td>Business Services Sales Representative</td>
          <td data-value="-22133780420">19 Apr 1969</td>
          <td data-value="3"><span class="status-metro status-suspended" title="Suspended">Suspended</span></td>
          <td data-value="3"><span class="status-metro status-suspended" title="Suspended">Suspended</span></td>
          <td data-value="3"><span class="status-metro status-suspended" title="Suspended">Suspended</span></td>
          <td data-value="3"><span class="status-metro status-suspended" title="Suspended">Suspended</span></td>
          <td data-value="3"><span class="status-metro status-suspended" title="Suspended">Suspended</span></td>
          <td data-value="3"><span class="status-metro status-suspended" title="Suspended">Suspended</span></td>
        </tr>
        <tr>
          <td>Easer</td>
          <td>Dragoo</td>
          <td>Drywall Stripper</td>
          <td data-value="250833505574">13 Dec 1977</td>
          <td data-value="1"><span class="status-metro status-active" title="Active">Active</span></td>
          <td data-value="1"><span class="status-metro status-active" title="Active">Active</span></td>
          <td data-value="1"><span class="status-metro status-active" title="Active">Active</span></td>
          <td data-value="1"><span class="status-metro status-active" title="Active">Active</span></td>
          <td data-value="1"><span class="status-metro status-active" title="Active">Active</span></td>
          <td data-value="1"><span class="status-metro status-active" title="Active">Active</span></td>
        </tr>
        <tr>
          <td>Maple</td>
          <td>Halladay</td>
          <td>Aviation Tactical Readiness Officer</td>
          <td data-value="694116650726">30 Dec 1991</td>
          <td data-value="3"><span class="status-metro status-suspended" title="Suspended">Suspended</span></td>
          <td data-value="3"><span class="status-metro status-suspended" title="Suspended">Suspended</span></td>
          <td data-value="3"><span class="status-metro status-suspended" title="Suspended">Suspended</span></td>
          <td data-value="3"><span class="status-metro status-suspended" title="Suspended">Suspended</span></td>
          <td data-value="3"><span class="status-metro status-suspended" title="Suspended">Suspended</span></td>
          <td data-value="3"><span class="status-metro status-suspended" title="Suspended">Suspended</span></td>
        </tr>
        <tr>
          <td>Maxine</td>
          <td><a href="#">Woldt</a></td>
          <td><a href="#">Business Services Sales Representative</a></td>
          <td data-value="561440464855">17 Oct 1987</td>
          <td data-value="2"><span class="status-metro status-disabled" title="Disabled">Disabled</span></td>
          <td data-value="2"><span class="status-metro status-disabled" title="Disabled">Disabled</span></td>
          <td data-value="2"><span class="status-metro status-disabled" title="Disabled">Disabled</span></td>
          <td data-value="2"><span class="status-metro status-disabled" title="Disabled">Disabled</span></td>
          <td data-value="2"><span class="status-metro status-disabled" title="Disabled">Disabled</span></td>
          <td data-value="2"><span class="status-metro status-disabled" title="Disabled">Disabled</span></td>
        </tr>
        <tr>
          <td>Lorraine</td>
          <td>Mcgaughy</td>
          <td>Hemodialysis Technician</td>
          <td data-value="437400551390">11 Nov 1983</td>
          <td data-value="2"><span class="status-metro status-disabled" title="Disabled">Disabled</span></td>
          <td data-value="2"><span class="status-metro status-disabled" title="Disabled">Disabled</span></td>
          <td data-value="2"><span class="status-metro status-disabled" title="Disabled">Disabled</span></td>
          <td data-value="2"><span class="status-metro status-disabled" title="Disabled">Disabled</span></td>
          <td data-value="2"><span class="status-metro status-disabled" title="Disabled">Disabled</span></td>
          <td data-value="2"><span class="status-metro status-disabled" title="Disabled">Disabled</span></td>
        </tr>
        <tr>
          <td>Lizzee</td>
          <td><a href="#">Goodlow</a></td>
          <td>Technical Services Librarian</td>
          <td data-value="-257733999319">1 Nov 1961</td>
          <td data-value="3"><span class="status-metro status-suspended" title="Suspended">Suspended</span></td>
          <td data-value="3"><span class="status-metro status-suspended" title="Suspended">Suspended</span></td>
          <td data-value="3"><span class="status-metro status-suspended" title="Suspended">Suspended</span></td>
          <td data-value="3"><span class="status-metro status-suspended" title="Suspended">Suspended</span></td>
          <td data-value="3"><span class="status-metro status-suspended" title="Suspended">Suspended</span></td>
          <td data-value="3"><span class="status-metro status-suspended" title="Suspended">Suspended</span></td>
        </tr>
        <tr>
          <td>Judi</td>
          <td>Badgett</td>
          <td>Electrical Lineworker</td>
          <td data-value="362134712000">23 Jun 1981</td>
          <td data-value="1"><span class="status-metro status-active" title="Active">Active</span></td>
          <td data-value="1"><span class="status-metro status-active" title="Active">Active</span></td>
          <td data-value="1"><span class="status-metro status-active" title="Active">Active</span></td>
          <td data-value="1"><span class="status-metro status-active" title="Active">Active</span></td>
          <td data-value="1"><span class="status-metro status-active" title="Active">Active</span></td>
          <td data-value="1"><span class="status-metro status-active" title="Active">Active</span></td>
        </tr>
        <tr>
          <td>Lauri</td>
          <td>Hyland</td>
          <td>Blackjack Supervisor</td>
          <td data-value="500874333932">15 Nov 1985</td>
          <td data-value="3"><span class="status-metro status-suspended" title="Suspended">Suspended</span></td>
          <td data-value="3"><span class="status-metro status-suspended" title="Suspended">Suspended</span></td>
          <td data-value="3"><span class="status-metro status-suspended" title="Suspended">Suspended</span></td>
          <td data-value="3"><span class="status-metro status-suspended" title="Suspended">Suspended</span></td>
          <td data-value="3"><span class="status-metro status-suspended" title="Suspended">Suspended</span></td>
          <td data-value="3"><span class="status-metro status-suspended" title="Suspended">Suspended</span></td>
        </tr>
        </tbody>
      </table>--> 
      <!--Porfolio Content--> 
      <!--/Porfolio Content--><!--Pagination-->
      <div class="clear"></div>
      <div class="page-pagination clear fixed-width-wrapper">
      <?php 
$pagex->show("fid=".$_GET["fid"],"");
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
