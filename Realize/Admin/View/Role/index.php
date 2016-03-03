<!DOCTYPE html>
<html>
<head>
<title>用户角色 - 我的控制台</title>
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
                   <div class="user-check">&nbsp</div>
                   <div class="user-id">角色ID</div>
                   <div class="user-name">角色名称</div>
                   <div class="user-action">操作</div>
                   <div class="user-time">创建时间</div> 
                   <div class="user-node">权限设置</div>          
               </li>
                <?php foreach($roles as $k => $u){?>
                <li id="role-<?php echo $u['id']?>">    
                   <div class="user-check">&nbsp</div>
                   <div class="user-id"><?php echo $u['id']?></div>
                   <div class="user-name"><?php echo $u['name']?></div>
                   <div class="user-action"><a href="/admin/Role/edit?id=<?php echo $u['id']?>"><i class="fa fa-pencil" title="编辑角色"></i></a><i role-id="<?php echo $u['id']?>" class="fa fa-times delete_role" title="删除角色"></i></div>
                   <div class="user-time"><?php echo date("Y-m-d H:i:m",$u['create_time'])?></div>
                   <div class="user-from"><?php echo $u['last_login_ip']?></div>
                   <div class="user-node"><a href="/admin/Role/node?id=<?php echo $u['id']?>">权限设置</a></div>              
                </li>
				<?php }?>
             </ul>
             </form>
        </div>
        
        <div class="add-role"><a href="/admin/Role/add" style="color:#FFF">新增角色</a></div>
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
<script type="text/javascript">
$(function(){
	$(".delete_role").click(function(){
		$id = $(this).attr("role-id");
		art.dialog.confirm('您确定要删除吗？', function () {
			$.get("/admin/Role/delete?id="+$id,function(data){
				if(data.status == 1){
					art.dialog.tips('删除成功');
					$("#role-"+$id).remove();
				}else{
					art.dialog.tips('删除失败');
				}
		    },"json");
        }, function () {
               art.dialog.tips('执行取消删除');
        });
	});
});
</script>
</html>