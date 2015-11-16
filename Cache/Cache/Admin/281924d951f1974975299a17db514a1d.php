<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html>
<head>
<title>系统首页 - 我的控制台</title>
<?php require_once('./Realize/Admin/View/Public/head.php');?>

<link type="text/css" rel="stylesheet" href="/Static/admin/css/type.css" />
<link type="text/css" rel="stylesheet" href="/Static/admin/css/album.css" />


</head>

<body>
    <div id="wrapper">
<?php require_once('./Realize/Admin/View/Public/left.php');?>


        <div id="page-wrapper" class="gray-bg dashbard-1">
            <?php require_once('./Realize/Admin/View/Public/top.php');?>
            <div class="wrapper wrapper-content">


<ul class="sortable">
<?php echo $type?>
</ul>

<div class="page">
	       <div class="pageLeft">
	         <table width="427" border="0" align="left">
	           <tr>
	             <td width="36"><div class="action checkAll">全选</div></td>
	             <td width="36"><div class="action" id="checkBack">反选</div></td>
	             <td width="230">
	                 <div style="float:left" class="action">删除</div> <div  style="float:left; width:100px" id="app-2" class="add-action">新增分类</div>    
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
<script src="/Static/artdialog/artDialog.js?skin=default"></script>
<script src="/Static/artdialog/plugins/iframeTools.js"></script>

<script src="/Static/JQuery-UI/jquery-ui-1.10.4.custom.min.js" type="text/javascript"></script>

<script src="/Static/admin/js/type.js" type="text/javascript"></script>
</html>