<html xmlns="http://www.w3.org/1999/xhtml">
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