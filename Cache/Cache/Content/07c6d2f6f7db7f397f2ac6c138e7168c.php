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
          <div class="show-box">
               <div class="show-box-icon"><img src="/Static/style/destroy/img/yizhanshi.jpg" /></div>
               <div class=" show-box-title">一站式服务</div>
               <div class="show-box-info">文章门户，图片相册，社区论坛，用户中心，开放平台应用充分融合于一体，实现一站式服务。</div>
          </div>
          <div class="show-box">
               <div class="show-box-icon"><img src="/Static/style/destroy/img/kaiyuan.jpg" /></div>
               <div class=" show-box-title">全面开源</div>
               <div class="show-box-info">基于PHP、MySQL技术开发架构，完全开发源代码，让功能定制更容易、更自由</div>
          </div>
          <div class="show-box" style="margin-right:0px !important">
               <div class="show-box-icon"><img src="/Static/style/destroy/img/kuangjia.jpg" /></div>
               <div class=" show-box-title">多种框架整合</div>
               <div class="show-box-info">基于ThinkPHP开源框架，集成Boostrap前端开发，代码符合国际化，标准化，敏捷的二次开发</div>
          </div>
          <div class="show-box">
               <div class="show-box-icon"><img src="/Static/style/destroy/img/yunying.jpg" /></div>
               <div class=" show-box-title">更好的运营</div>
               <div class="show-box-info">灵活的模块组，灵活的商业运营模式 ，完善的会员体系，完整的支付接口</div>
          </div>
          <div class="show-box">
               <div class="show-box-icon"><img src="/Static/style/destroy/img/muban.png" /></div>
               <div class=" show-box-title">海量模板，原生PHP语法支持</div>
               <div class="show-box-info">海量模板，原生PHP语法支持，您无须因学习新的模板语言再付出学习成本，模板标签简单易用</div>
          </div>
          <div class="show-box"  style="margin-right:0px !important">
               <div class="show-box-icon"><img src="/Static/style/destroy/img/tiyan.jpg" /></div>
               <div class=" show-box-title">更优化的用户体验</div>
               <div class="show-box-info">良好的用户体验和网站亲和力</div>
          </div>
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