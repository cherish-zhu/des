<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="stylesheet" href="/Static/Semantic-UI/css/semantic.min.css" />
<link type="text/css" rel="stylesheet" href="/Static/admin/css/recycle.css" />
<title>我的控制台</title>
<?php require_once('./Realize/Admin/View/Public/top.php');?>


<div class="main">

<?php require_once('./Realize/Admin/View/left/leftSystem.php');?>

<div class="right"  style="background-color:#FFF">

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
               <i class="circular inverted icon rec-id"><?php echo $val['lid']?></i>
               <div class="rec-title"><?php echo $val['name']?></div>
               
               <div class="rec-delete"><div class="ui button"><div class="visible content">测底删除</div></div></div>
               
               <div class="rec-hy"><div class="ui button"><div class="visible content">还原</div></div></div>
               
          </div>
     <?php }?>
     <div class="page"><?php echo $page?></div>
     </div>

</div>
</div>
<script src="/Static/Semantic-UI/javascript/semantic.min.js"></script>
<?php require_once('./Realize/Admin/View/Public/footer.php');?>
