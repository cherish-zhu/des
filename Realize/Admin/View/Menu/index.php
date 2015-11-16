<!DOCTYPE html>
<html>
<head>
<title>菜单管理 - 我的控制台</title>
<?php require_once('./Realize/Admin/View/Public/head.php');?>
</head>

<body>
	<div id="wrapper">
		<?php require_once('./Realize/Admin/View/Public/left.php');?>
		<div id="page-wrapper" class="gray-bg dashbard-1">
			<?php require_once('./Realize/Admin/View/Public/top.php');?>
			<div class="wrapper wrapper-content">
				<a href="/admin/menu/addFrom" class="btn btn-primary" id="button"> 添加菜单 </a>
                <p><br/></p>
				<div class="table-responsive">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>菜单名称</th>
								<th>应用</th>
								<th>控制器</th>
								<th>方法</th>
								<th width="150" style="float:right">操作</th>
							</tr>
						</thead>
						<tbody class="menu-list">
                        <?php foreach($menu as $key => $k){?>
							<tr>
								<td><a href="/admin/menu/index/menuid/<?php echo $k['id'] ?>.html"><?php echo $k['name'] ?></a></td>
								<td><span class="pie"><?php echo $k['app'] ?></span></td>
								<td><?php echo $k['controller'] ?></td>
								<td><?php echo $k['action'] ?></td>
								<td  width="150" style="float:right"><a href="/admin/menu/edit?id=<?php echo $k['id'] ?>">编辑</a>&nbsp;&nbsp;<a href="/admin/menu/menuStatus/status/<?php echo $k['status'] ?>?id=<?php echo $k['id'] ?>" class="menuStatus" id="<?php echo $k['status'] ?>-<?php echo $k['id'] ?>"><if  condition="$k.status eq 1">禁用<else />启用</if></a>&nbsp;&nbsp;<a href="/admin/menu/addFrom?id=<?php echo $k['id'] ?>">添加子菜单</a></td>
							</tr>
							<?php }?>                     
						</tbody>
					</table>

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
</html>