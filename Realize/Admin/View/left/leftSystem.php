<div class="left">
     <ul class="list">
     <div><b>基本设置</b></div>
     <a href="/admin/setting/info"><li <?php if($bj['tb']=='info'){echo 'id="left_list"';}?>>常规设置</li></a>
     <a href="/admin/setting/set"><li <?php if($bj['tb']=='set'){echo 'id="left_list"';}?>>系统设置</li></a>
     <a href="/admin/setting/other"><li <?php if($bj['tb']=='other'){echo 'id="left_list"';}?>>其他设置</li></a>
     </ul>
     <ul class="list">
     <a href="/admin/nav"><li <?php if($bj['tb']=='nav'){echo 'id="left_list"';}?>>导航栏目</li></a>
     <a href="/admin/recycle"><li <?php if($bj['tb']=='rec'){echo 'id="left_list"';}?>>回收站</li></a>
     <a href="/admin/advert"><li <?php if($bj['tb']=='adv'){echo 'id="left_list"';}?>>广告管理</li></a>
     </ul>  
</div>