<?php
include_once("inc/function.php");
include_once("inc/config.php");
include_once("inc/conn.php");
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

<script src="js/jquery-1.7.1.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.nivo.slider.js"></script>
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/TitilliumText.font.js"></script>
<script type="text/javascript" src="js/scripts.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<script type="text/javascript" src="js/shortcode.js"></script><!--[if IE 7]><link rel="stylesheet" type="text/css" href="css/ie7.css"><![endif]-->
<script type="text/javascript" src="js/jquery.blockUI.js"></script>
<script type="text/javascript" src="js/zealot.js"></script>

<script type="text/javascript">
$(function(){
	$("#contact-form").submit(function()
	{
		if(checkit_s("name")){
			return false;
		}
		if(checkit_s("email")){
			return false;
		}
		if(checkit_s("title")){
			return false;
		}
		if(checkit_s("contents")){
			return false;
		}
		var reg = /^([a-zA-Z0-9]+[_|\-|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\-|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/; 
		if(!reg.test(document.getElementById("email").value)){
			document.getElementById("email").style.border="1px dashed red";
			document.getElementById("email").focus();
			return false;
		}		
		$.post("gbook_add.php",{name:$('#name').val(),email:$("#email").val(),title:$("#title").val(),contents:$("#contents").val()},function(feedback)
        {

			$.blockUI({
				message:'<img src=images/bar777.gif />',
				css: { 
					border: 'none', 
					padding: '15px',
					backgroundColor: 'none',
					'-webkit-border-radius': '10px',
					'-moz-border-radius': '10px',
					opacity: .5,
					color: '#fff'
				}
			});
			setTimeout($.unblockUI,777); 	  
		  if(feedback=='goal') 
		  {
		  	/*$("#status_de").html('<img src=\"images/ok.gif\" width=\"16\" height=\"16\" align=\"absmiddle\" />');
			setTimeout("go_de()",777);
			window.setTimeout(function(){go_de()},777);*/
			alert('感谢您的留言');
		  }else
			/*$("#status_de").html('<img src=\"images/pic12.gif\" width=\"16\" height=\"16\" align=\"absmiddle\" /> '+feedback);*/
			alert('Error:'+feedback);
        });
 		return false;
	});
})
</script>
</head>
<body class="home">
<!--Header-->
<?php require_once("head.php");?>
<!--/Header--><!--Body content-->
<div class="full-width-wrapper">
  <div class="fixed-width-wrapper" id="body-content"><!--Content-->
    <div id="content" class="float-left content-left">
      <div class="header-text">
        <ul id="breadcrumbs">
          <li><a href="index.php" title="">首页</a></li>
          <li class="current"><a href="#" title="">关于后羿</a></li>
        </ul>
        <h1 class="first-word double-color sp"><span>关于</span>后羿</h1>
      </div>
      <div class="post entry-content">
        <p>随着后羿半导体的不断壮大，公司已先后在无锡、天津、徐州、成都设立了办事处，在深圳指定了专业代理商，以便为客户提供更快更直接的服务。</p>
        <p>工业强则国强，后羿半导体以“为客户创造更高价值”为发展理念，投入更大精力，更多财力，致力于电子行业的纵深研发，为满足客户日新月异发展的需求做好准备，使得后羿与客户之间有更深层更广域的精诚合作，携手共同成长。</p>
        <div class="first one-half address">
          <h3 class="first-word">西安总公司</h3>
          <span class="map-point"></span>
          <p><strong>西安后羿半导体科技有限公司</strong><br>
            地址：西安市雁塔区永松路16号4-501</p>
          <p> 电话：+86-029-88381060 <br>
            传真：+86-029-88381925 <br>
            电子邮箱：hy@hooyi.cc
          </p>
        </div>
        <div class="one-half address">
          <h3 class="first-word">无锡</h3>
          <span class="map-point"></span>
          <p><strong>西安后羿半导体科技有限公司无锡办事处</strong><br>
            <br>
            <br>
          </p>
          <p> 联系人：刘明荣<br>
            电话：15161578002 </p>
        </div>
        <div class="first one-half address">
          <h3 class="first-word">天津</h3>
          <span class="map-point"></span>
          <p><strong>西安后羿半导体科技有限公司天津办事处</strong><br>
            <br>
            <br>
          </p>
          <p> 联系人：贾建国 <br>
            手机：18502268707 </p>
        </div>
        <div class="one-half address">
          <h3 class="first-word">徐州</h3>
          <span class="map-point"></span>
          <p><strong> 西安后羿半导体科技有限公司徐州办事处</strong><br>
            <br>
            <br>
          </p>
          <p> 联系人：王安顺<br>
            手机：15991898063 </p>
        </div>
        <div class="first one-half address">
          <h3 class="first-word">成都</h3>
          <span class="map-point"></span>
          <p><strong> 西安后羿半导体科技有限公司成都办事处 </strong><br>
            <br>
            <br>
          </p>
          <p> 联系人：崔波 <br>
            手机：13558830076   </p>
        </div>
        <div class="one-half address">
          <h3 class="first-word">台州</h3>
          <span class="map-point"></span>
          <p><strong> 西安后羿半导体科技有限公司台州办事处 </strong><br>
            <br>
            <br>
          </p>
          <p> 联系人：司徒峰 <br>
            手机：15988899275   </p>
        </div>
        <div class="first one-half address">
          <h3 class="first-word">总代理</h3>
          <span class="map-point"></span>
          <p><strong>深圳市飞邦微电子科技有限公司</strong><br>
            地址：深圳市宝安区西乡镇三围村三围工业路17号三围工业园2栋2楼 </p>
          <p> 电话：+86-0755-29120211<br>
            传真：+86-0755-29120209 </p>
        </div>
        <div class="clear"></div>
        <h3 class="first-word">请您留言</h3>
        <div class="sp"></div>
        <!--Contact form-->
        <form id="contact-form" class="maxx-form" action="" method="post">
          <div class="form-row">
            <label class="form-row-label">姓 名:<span class="star">*</span></label>
            <input class="input-field required" style="width:400px" type="text" name="name" id="name">
          </div>
          <div class="form-row">
            <label class="form-row-label">电子邮箱:<span class="star">*</span></label>
            <input class="input-field required email" style="width:400px" type="text" name="email" id="email">
          </div>
          <div class="form-row">
            <label class="form-row-label">主 题:<span class="star">*</span></label>
            <input class="input-field required" style="width:400px" type="text" name="title" id="title">
          </div>
          <div class="form-row">
            <label class="form-row-label">消息内容:<span class="star">*</span></label>
            <textarea class="input-field required" style="width:400px" name="contents" rows="5" cols="1" id="contents" ></textarea>
          </div>
          <div class="form-row">
            <label class="form-row-label">　</label>
            <button type="submit" class="black border-radius-3px bold submit" title="">发送留言</button>
          </div>
        </form>
        <!--/Contact form--></div>
    </div>
    <!--/Content--><!--Sidebar-->
    <div id="sidebar" class="float-right"><!--box-->
      <div class="box">
        <h1 class="first-word double-color sp"></h1>
        <ul class="list cat">
          <li><a href="about.php" title="">公司简介</a></li>
          <li><a href="culture.php" title="">企业文化</a></li>
          <li class="current"><a href="contact.php" title="">联系我们</a></li>
        </ul>
      </div>
      <div class="box">
        <h1 class="first-word double-color sp"></h1>
        <ul class="list quote">
          <li>
            <p><img src="images/map.jpg" width="100%" height="auto" alt=""/></p></li>
          <li>
            <p> 西安后羿半导体科技有限公司<br/>
              地址：西安市雁塔区永松路16号4-501<br/>
              电话：+86-029-88381060<br/>
              传真：+86-029-88381925 </p>
          </li>
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
</body>
</html>