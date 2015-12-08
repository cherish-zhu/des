<!DOCTYPE html>
<html>
<head>
<title>回收站 - 我的控制台</title>
<?php require_once('./Realize/Admin/View/Public/head.php');?>
<link type="text/css" rel="stylesheet" href="/Static/Semantic-UI/css/semantic.min.css" />
<link type="text/css" rel="stylesheet" href="/Static/admin/css/recycle.css" />

</head>

<body>
    <div id="wrapper">
<?php require_once('./Realize/Admin/View/Public/left.php');?>


        <div id="page-wrapper" class="gray-bg dashbard-1">
            <?php require_once('./Realize/Admin/View/Public/top.php');?>
            <div class="wrapper wrapper-content">

<ul class="recycle-menu">
           <li><a href="./"><img src="/Static/icon/wold.jpg"  class="circular ui image"></a></li>
           <li><a href="/admin/recycle/albums"><img src="/Static/icon/pic.png" class="circular ui image"></a></li>
           <li><a href="/admin/recycle/comments"><img src="/Static/icon/coment.png" class="circular ui image"></a></li>
           <li><a href="/admin/recycle/links"><img src="/Static/icon/links.png" class="circular ui image"></a></li>
      </ul>
     
     <div class="face">
     <div class="ui horizontal icon divider"><i class="circular heart icon"></i></div>
     <?php foreach ($center as $key => $val){?>
          <div class="rec-list">
               <i class="circular inverted icon rec-id"><?php echo $val['id']?></i>
               <div class="rec-title"><?php echo $val['title']?></div>
               
               <div class="rec-delete"><div class="ui button"><div class="visible content">测底删除</div></div></div>
               
               <div class="rec-hy"><div class="ui button"><div class="visible content">还原</div></div></div>
               
          </div>
     <?php }?>
     <div class="page"><?php echo $page?></div>
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

<script src="/Static/Semantic-UI/javascript/semantic.min.js"></script>
<script src="/Static/admin/js/type.js" type="text/javascript"></script>
</html>