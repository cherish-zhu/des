<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
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
            


 <div class="user-list">
             <form id="form1" name="form1" method="post" action="">
             <ul>
              <li class="user-mian">
                   <div class="user-check">
                       <input type="checkbox" name="checkbox" id="checkbox" />
                   </div>
                   <div class="user-id">用户ID</div>
                   <div class="user-name">角色名称</div>
                   <div class="user-action">操作</div>
                   <div class="user-time">创建时间</div> 
                   <div class="user-node">权限设置</div>          
               </li>
                <?php foreach($roles as $k => $u){?>
                <li>    
                   <div class="user-check">
                       <input type="checkbox" name="checkbox" id="checkbox" />
                   </div>
                   <div class="user-id"><?php echo $u['id']?></div>
                   <div class="user-name"><?php echo $u['name']?></div>
                   <div class="user-action"><i class="fa fa-pencil" title="编辑角色"></i><i class="fa fa-times" title="删除角色"></i></div>
                   <div class="user-time"><?php echo date("Y-m-d H:i:m",$u['create_time'])?></div>
                   <div class="user-from"><?php echo $u['last_login_ip']?></div>
                   <div class="user-node"><a href="#">权限设置</a></div>              
                </li>
				<?php }?>
             </ul>
             </form>
        </div>
        
        <div class="add-role">新增角色</div>
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