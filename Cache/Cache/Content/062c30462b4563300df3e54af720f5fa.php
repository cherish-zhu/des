<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Destroy - Powered By Destory</title>
<link rel="stylesheet" href="/Static/style/destroy/css/style.css" />
</head>

<body>

<div class="top-back">
     <div class="top">
          <div class="name-float">
          <h1><a href="#">Destory</a></h1>
          </div>
          <ul style="float:right">
              <li><a href="/">首页</a></li>
              <?php foreach($nav as $ke => $va){?>
              <li><a href="<?php echo $va['link']?>"><?php echo $va['name']?></a></li>
              <?php }?>         
          </ul>
     </div>
</div>

<div class="banner">
     <div class="banner-left"><img src="/Static/style/destroy/img/banner.jpg" /></div>
     <div class="banner-right">
          <div class="about">Destroy是一套基于PHP，MySQL基础开发的内容管理系统，顺应移动互联网大势，致力于快速WEB系统项目架构部署&nbsp;&nbsp;<a href="#">更多..</a></div>
          <div class="download"><a style="color:#FFF" href="https://codeload.github.com/cherish-zhu/des/zip/master" target="_blank">下载最新版本</a></div>
     </div>
</div>

<div class="wrap">
     <div class="wrap-left">
          <div class="line"><span style="font-size:18px">日志</span></div>
          <ul class="list">
              <?php foreach($arr as $lt){?>
              <li><span style="float:left"><a href="#"><?php echo $lt['title']?></a></span><span style="float:right"><?php echo date("Y年m月d日 H:i",$lt['create_time'])?></span></li>
              <?php }?>            
          </ul>
          <div class="page"><?php echo $page?></div>
     </div>
     <div class="wrap-right">
          <div class="new-list">
               <div class="new-title"><span style="font-size:18px">最近更新</span></div>
               <ul>
                   <?php foreach(getList(0,9) as $new => $ne){?>
                 <li><a href="#"><?php echo $ne['title']?></a></li>
                   <?php }?>
               </ul>
          </div>
          <div class="pos"><img src="/Static/style/destroy/img/ad.jpg" width="250" height="230"></div>        
     </div>
</div>

<div class="links">
     <div class="links-line"><span style="font-size:24px">友情链接</span><span style="float:right"><a href="javascript:viod(0)">申请加入</a></span></div>
     <div class="link-list">
          <?php foreach(getLinks() as $link => $s){?>
          <a href="<?php echo $s['link']?>"><?php echo $s['name']?></a>
          <?php }?>
     </div>
</div>

<div class="footer">
     <div class="foot">Copyright © 2015 Destory. All Rights Reserved <span style="float:right"><a href="javascript:viod(0)">湘ICP备12007941号-2</a></span></div>
</div>
</body>
</html>