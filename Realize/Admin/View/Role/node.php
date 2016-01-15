<!DOCTYPE html>
<html>
<head>
<title>分类管理 - 我的控制台</title>
<?php require_once('./Realize/Admin/View/Public/head2.php');?>
<link type="text/css" rel="stylesheet" href="/Static/Semantic-UI/css/semantic.min.css" />
<link type="text/css" rel="stylesheet" href="/Static/admin/css/index.css" />
<link type="text/css" rel="stylesheet" href="/Static/admin/css/type.css" />
<style type="text/css">
.back-color-yellow{background-color:#DADCA9 !important}
</style>
</head>

<body>
    <div id="wrapper">
<?php require_once('./Realize/Admin/View/Public/left.php');?>


        <div id="page-wrapper" class="gray-bg dashbard-1">
            <?php require_once('./Realize/Admin/View/Public/top.php');?>
            <div class="wrapper wrapper-content">
                <form action="/admin/Role/roleNode?id=<?php echo $_GET['id']?>" method="POST">
                <p><br/><input type="submit" name="button" class="ant-btn ant-btn-primary" id="button" value="更新权限"><br/></p>
                <p><br/></p>
                <div class="category-box">
                <div class="category-line category-id-0" level="2"><div class="category-name" style="width:160px !important">&nbsp;&nbsp;<b>节点名称</b></div>
                <div class="category-cap" style="margin-right:20px"><b>授权</b></div><div class="category-clear"></div></div>                               
                <?php echo $content?>                
                <div class="category-clear"></div></div>
                </form>
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
<script type="text/javascript" src="/Static/bootstrap/js/bootstrap.min.js"></script>
<script src="/Static/admin/js/type.js" type="text/javascript"></script>

<script type="text/javascript" src="/Static/JQuery-UI/jquery-ui-1.10.4.custom.min.js"></script>
<script>

     $(".checkbox").click(function(){
         $id = $(this).attr("remark");
         $id = $id.split("-");
         $id = $id[1];
         //$("#checkbox-id-"+$id).attr("checked","checked");
         $("#checkbox-id-"+$id).prop("checked","checked");
         var remark = true;
         $(".checkbox-"+$id).each(function(i,n){
            // alert(n.checked);
                if($(this).is(':checked')) remark = false;
         })
         if(remark == true) $("#checkbox-id-"+$id).removeAttr("checked");
     });
     
     $(".pra").click(function(){
         $id = $(this).attr("id");
         $id = $id.split("-");
         $id = $id[2];
        // alert($id);
        if($(this).is(':checked')) {
            $(".checkbox-"+$id).each(function(i,n){
                $(this).prop("checked","checked");;
                //n.checked = true; 
            });
        }else{
            $(".checkbox-"+$id).each(function(i,n){
                 $(this).removeAttr("checked");
                //n.checked = false; 
            });
        }
     });

 
</script>
</html>