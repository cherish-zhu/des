<!DOCTYPE html>
<html>
<head>
<title>系统首页 - 我的控制台</title>
<?php require_once('./Realize/Admin/View/Public/head.php');?>
<link type="text/css" rel="stylesheet" href="/Static/admin/css/index.css" />
<link type="text/css" rel="stylesheet" href="/Static/admin/css/edit-view.css" />
<link type="text/css" rel="stylesheet" href="/Static/Semantic-UI/css/semantic.min.css" />
</head>

<body>
    <div id="wrapper">
<?php require_once('./Realize/Admin/View/Public/left.php');?>


        <div id="page-wrapper" class="gray-bg dashbard-1">
            <?php require_once('./Realize/Admin/View/Public/top.php');?>
            <div class="wrapper wrapper-content">
            

 <div class="edit-box">
           <form name="code-form" action="" method="post">
                 <textarea name="code"><?php echo $code?></textarea>
                 
                 <p><div class="ui instagram button">
                 <button style="border:none; background:none" class="instagram icon">保存</button>
                 </div></p>
           </form>
      </div>
      
      <?php foreach($views as $m => $n) {?>
      <div class="file-mneu">
           <ul>
               <li><b><?php echo $m?></b></li>
               <ul>
               <?php foreach($n as $key => $val) {?>
               <li class="indent2"><a href="javascript:viod(0)" class="content-dir" id="content-dir-<?php echo $key?>"><?php echo $val['dir']?></a></li>
               <?php foreach($val['file'] as $k => $v) {?>
               <li class="indent3 file content-dir-<?php echo $key?>"><a href="?file=<?php echo $v['l']?>"><?php echo $v['x']?></a></li>
               <?php }?>
               <?php }?>
               </ul>
           </ul>
      </div>
      <?php }?>

                

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