<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
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
            
                       
           
<?php echo $content?>


<div class="page">
	       <div class="pageLeft">
	         <table width="427" border="0" align="left">
	           <tr>
	             <td width="36"><div class="action checkAll">全选</div></td>
	             <td width="36"><div class="action" id="checkBack">反选</div></td>
	             <td width="230">
	                 <div style="float:left" class="action">删除</div> <div  style="float:left; width:100px" id="app-1" class="action">新增分类</div>    
                  </td>
	             <td width="107">&nbsp;</td>
               </tr>
             </table>
	       </div>
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
<script type="text/javascript" src="/Static/bootstrap/js/bootstrap.min.js"></script>
<script src="/Static/admin/js/type.js" type="text/javascript"></script>

<script type="text/javascript" src="/Static/JQuery-UI/jquery-ui-1.10.4.custom.min.js"></script>
<script type="text/javascript">
$(".category-line").hide();

var num=0; 
$('.category-cap').click(function(e){ 
    $id = $(this).attr("id");
	$id = $id.split("-");
	$id = $id[1];
    if(num++ %2 == 0){ 
//doSomething 
    $(this).children("i").removeClass("right").addClass("down"); 
    
	$(".category-id-"+$id).show(); 
    }else{ 
//doOtherSomething
    $(this).children("i").removeClass("down").addClass("right");
	$(".category-id-"+$id).hide(); 
    } 

    e.preventDefault(); //阻止元素的默认动作（如果存在） 
}); 
$(".category-line").mousemove(function(){
	$(this).addClass("back-color-yellow");
	$(this).parents(".category-line").removeClass("back-color-yellow");
});
$(".category-line").mouseout(function(){
	$(this).removeClass("back-color-yellow");
});
$(".delete-category").click(function(){
	$id = $(this).attr("id").split("-");
	$id = $id[3];
	$.get('/admin/category/del?id='+$id,function(data){
		if(data == 1){
			alert('已经成功删除');
		}else{
			alert('意外错误');
		}
	},"json");
});
</script>
</html>