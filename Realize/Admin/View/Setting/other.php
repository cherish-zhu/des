<!DOCTYPE html>
<html>
<head>
<title>基本设置 - 我的控制台</title>
<?php require_once('./Realize/Admin/View/Public/head.php');?>
<link type="text/css" rel="stylesheet" href="/Static/Semantic-UI/css/semantic.min.css" />
<link type="text/css" rel="stylesheet" href="/Static/admin/css/system.css" />

</head>

<body>
    <div id="wrapper">
<?php require_once('./Realize/Admin/View/Public/left.php');?>

        <div id="page-wrapper" class="gray-bg dashbard-1">
            <?php require_once('./Realize/Admin/View/Public/top.php');?>
            <div class="wrapper wrapper-content">

<ul class="tab-menu">
          <li <?php if($bj['tb']=='info'){echo 'id="this"';}?>><a href="/admin/setting/info">常规设置</a></li>
          <li <?php if($bj['tb']=='set'){echo 'id="this"';}?>><a href="/admin/setting/set">系统设置</a></li>
          <li <?php if($bj['tb']=='other'){echo 'id="this"';}?>><a href="/admin/setting/other">其他设置</a></li>
     </ul>
     
    <div class="appmain">
       <form id="form1" name="form1" method="post" action="">
       
     <div class="from">
          <div class="title">停业提示</div>
          <div class="info"> ( 网站标题前台显示标题 ) </div>
          <div class="input"><input name="beian" type="text" id="beian" value="停业提示" size="113" /></div>
     </div>
     
     <div class="from">
          <div class="title">第三方统计</div>
          <div class="info"> ( 网站标题前台显示标题 ) </div>
          <div class="input"><textarea name="code" id="code" cols="45" rows="3">无</textarea></div>
     </div>
     
       <input type="submit" name="button" class="smile-butt" value="保存并更新" />
       </form>
     </div>
</div>            
            
            <div class="footer">
                <div class="pull-right">
                    By：<a href="http://www.destroy.net.cn/" target="_blank">destroy.net.cn</a>
                </div>
                <div>
                    <strong>Copyright</strong> Destroy &copy; 2015
                </div>
            </div>
        </div>
    </div>


</body>

</html>