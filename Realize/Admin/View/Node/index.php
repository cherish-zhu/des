<!DOCTYPE html>
<html>
<head>
<title>系统首页 - 我的控制台</title>
<?php require_once('./Realize/Admin/View/Public/head.php');?>
<link type="text/css" rel="stylesheet" href="/Static/admin/css/index.css" />
<link type="text/css" rel="stylesheet" href="/Static/admin/css/user.css" />
<link type="text/css" rel="stylesheet" href="/Static/Semantic-UI/css/semantic.min.css" />
</head>

<body>
    <div id="wrapper">
<?php require_once('./Realize/Admin/View/Public/left.php');?>


        <div id="page-wrapper" class="gray-bg dashbard-1">
            <?php require_once('./Realize/Admin/View/Public/top.php');?>
            <div class="wrapper wrapper-content">
            


<?php foreach($nodes as $key => $val){?>
     <ul class="node">
         <li class="node-mian"><?php echo $val['title']?> <div class="add-node" id="node-id-<?php echo $val['id']?>">新增</div></li>
         <?php foreach($val['son'] as $k => $v){?>
         <li><?php echo $v['title']?> <div class="add-node"  id="node-id-<?php echo $v['id']?>">新增</div></li>
         <?php }?>
     </ul>
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