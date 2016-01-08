<!DOCTYPE html>
<html>
<head>
<title>模板编辑 - 我的控制台</title>
<?php require_once('./Realize/Admin/View/Public/head.php');?>
<link type="text/css" rel="stylesheet" href="/Static/admin/css/index.css" />
<link type="text/css" rel="stylesheet" href="/Static/admin/css/edit-view.css" />
<link type="text/css" rel="stylesheet" href="/Static/Semantic-UI/css/semantic.min.css" />
<link type="text/css" rel="stylesheet" href="/Static/admin/css/type.css" />
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
      
      

      
           <div class="file-mneu" style="border: 0; margin-top:10px">
                <div class="category-box">
                <div class="category-line category-id-'">
                <div class="category-name">Content</div>
                <div class="category-cap"  id="id-"><i class="angle right icon"></i></div>
                <div class="category-clear"></div></div>
                <?php file_tree($views);?>

                <div class="category-clear"></div></div>
           
           </div>
                
           <div style="width: 100%; height:1px; clear:both"></div>
           
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