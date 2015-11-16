<nav class="navbar-default navbar-static-side" role="navigation">
	<div class="sidebar-collapse">
		<ul class="nav" id="side-menu">
			<li class="nav-header">
				<div class="profile-element">
					<img alt="image" class="logo img-circle" src="/Static/admin/images/atvar.jpg" width="80" height="80" />
					<div class="clear"></div>
					<span class="block m-t-xs"><strong class="font-bold"><a href="#" id="myEdit"><?php echo $_SESSION['loginUserName']?></a></strong></span> <span class="text-muted text-xs block">超级管理员</span> <span class="text-muted text-xs block"><a href="javascript:viod(0)" id="editPW">修改密码</a></span>
				</div>
				<div class="logo-element">Des</div>
			</li>
            <?php foreach($Menu as $key => $vo){
				if(!empty($vo[items])){
			 ?>
				<li><a href="#"><i class="fa <?php echo  $vo['icon']?>"></i> <span class="nav-label"><?php echo $vo['name']?></span> <span class="fa arrow"></span></a>
					<ul class="nav nav-second-level">
                        <?php foreach($vo['items'] as $k => $vo2){?>
						<li>
                        <a href="<?php echo $vo2['url']?>"><?php echo $vo2['name']?><?php if(!empty($vo2['items'])){?><span class="fa arrow"></span><?php }?></a>                     
                        <?php if(!empty($vo2['items'])){?>
                        <ul class="nav nav-third-level collapse">
                        <?php foreach($vo2['items'] as $ke => $vo3){?>
						    <li><a href="<?php echo $vo3['url']?>"><?php echo $vo3['name']?></a></li>
						<?php }?>
                        </li>   
                        </ul>
                  
						<?php }}?>
					</ul></li>
				<li>
			<?php }else{?>
				<li><a href="{$vo.url}"><i class="fa <?php echo  $vo['icon']?>"></i> <span class="nav-label"><?php echo $vo['name']?></span><!--span class="label label-danger pull-right">2.0</span--></a></li>
			<?php }?>
			<?php }?>
		</ul>

	</div>
</nav>