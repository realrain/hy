<script>
function checkit(wow){
	str=document.getElementById(wow).value;
	str=str.replace(/'/g,""); 
	str=str.replace(/"/g,"");
	str=str.replace(/`/g,"");
	str=str.replace(/\\/g,"");
	str=str.replace(/ /g,"");
	str=str.replace(/	/g,"");
	if(str==""){
		alert('请输入搜索内容');
		document.getElementById(wow).focus();
		document.getElementById(wow).style.border="1px dashed red";
		return true;
	}
}
function chk(){
	if(checkit("q")){
		return false;
	}
	return true;
}

function chk_email(){
  var reg = /^([a-zA-Z0-9]+[_|\-|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\-|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,5}$/; 
  if(!reg.test(document.getElementById("email").value)){
    alert("请输入正确的电子邮件地址");
    document.getElementById("email").style.border="1px dashed red";
    document.getElementById("email").focus();
    return false;
  }
  return true;
}
</script>
<div class="full-width-wrapper" id="header">
  <div class="full-width-wrapper" id="abstract-bg"><!--Banner-->
    <div class="fixed-width-wrapper" id="banner"><a href="index.php" title="" class="logo"><img src="images/logo.png" alt=""></a>
      <ul class="social-network">
        <li><a href="building.php" target="_blank" title="办公登录"><img src="images/icons/Computer.png" alt=""></a></li>
        <li><a href="building.php" target="_blank" title="会员登录"><img src="images/icons/User_male.png" alt=""></a></li>
        <li><a href="http://www.hooyi.cc:81/mail/" target="_blank" title="邮箱登录"><img src="images/icons/Mail 2.png" alt=""></a></li>
      </ul>
    </div>
    <!--/Banner--><!--Navigation + Search-->
    <div class="fixed-width-wrapper border-radius-5px" id="navigation-bar">
      <div id="g-navigation">
        <ul class="simple-drop-down-menu">
          <li class="home-page current border-radius-left-5px"><a href="index.php">首页</a></li>
          <li><a href="about.php" title="">关于后羿</a>
            <ul>
              <li><a href="about.php" title="">公司简介</a></li>
              <li><a href="culture.php" title="">企业文化</a></li>
              <li><a href="contact.php" title="">联系我们</a></li>
            </ul>
          </li>

          <li><a href="products.php?fid=2" title="">产品中心</a>
            <ul>
              <?php
$sql4="select id,name,fid from hy_product_category where fid=0 order by id asc";
$rs4=mysql_query($sql4,$conn);
while($row4=mysql_fetch_assoc($rs4)){
?>
          <li><a href="products.php?fid=<?php echo $row4['id'] ?>" title=""><?php echo $row4['name'] ?></a>
  <?php
  $sql5="select id,name,fid from hy_product_category where fid={$row4['id']} order by id asc";
  $rs5=mysql_query($sql5,$conn);
  if(mysql_num_rows($rs5)>0){
  ?>
            <ul>
  <?php
  while($row5=mysql_fetch_assoc($rs5)){
  ?>
              <li><a href="products.php?fid=<?php echo $row5['id'] ?>" title=""><?php echo $row5['name'] ?></a>
                             <?php
  $sql6="select id,name,fid from hy_product_category where fid={$row5['id']} order by id asc";
  $rs6=mysql_query($sql6,$conn);
  if(mysql_num_rows($rs6)>0){
  ?>
                <ul>
                  <?php
  while($row6=mysql_fetch_assoc($rs6)){
  ?>
                <li><a href="products.php?fid=<?php echo $row6['id'] ?>" title=""><?php echo $row6['name'] ?></a>
  <?php
  }//$row6 while
  ?>
                </ul>
  <?php
  }//mysql_num_rows($rs6)
  ?>         
              </li>
  <?php
  }//$row5 while
  ?>
            </ul>
    <?php
  }//mysql_num_rows($rs5) if
  ?>  
          </li>
<?php
}
?>
            </ul>
          </li>
<?php
$sql1="select id,name,fid from hy_category where fid=0 order by id asc";
$rs1=mysql_query($sql1,$conn);
while($row1=mysql_fetch_assoc($rs1)){
?>
          <li><a href="articlelist.php?fid=<?php echo $row1['id'] ?>" title=""><?php echo $row1['name'] ?></a>
  <?php
  $sql2="select id,name,fid from hy_category where fid={$row1['id']} order by id asc";
  $rs2=mysql_query($sql2,$conn);
  if(mysql_num_rows($rs2)>0){
  ?>
            <ul>
  <?php
  while($row2=mysql_fetch_assoc($rs2)){
  ?>
              <li><a href="articlelist.php?fid=<?php echo $row2['id'] ?>" title=""><?php echo $row2['name'] ?></a>
                             <?php
  $sql3="select id,name,fid from hy_category where fid={$row2['id']} order by id asc";
  $rs3=mysql_query($sql3,$conn);
  if(mysql_num_rows($rs3)>0){
  ?>
                <ul>
                  <?php
  while($row3=mysql_fetch_assoc($rs3)){
  ?>
                <li><a href="articlelist.php?fid=<?php echo $row3['id'] ?>" title=""><?php echo $row3['name'] ?></a>
  <?php
  }//$row3 while
  ?>
                </ul>
  <?php
  }//mysql_num_rows($rs3)
  ?>         
              </li>
  <?php
  }//$row2 while
  ?>
            </ul>
    <?php
  }//mysql_num_rows($rs2) if
  ?>  
          </li>
<?php
}
?>

        </ul>
      </div>
      <div id="g-search">
        <form action="search.php" method="get" target="_blank" onsubmit="return chk()">
          <div>
            <input name="q" id="q" type="text" class="input-field border-radius-left-3px reset-text" value="">
          </div>
          <div>
            <button type="submit" title="搜索" class="sprite"><em>搜索</em></button>
          </div>
        </form>
      </div>
    </div>
    <!--/Navigation + Search--></div>
</div>