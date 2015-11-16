<div class="left">
     <ul class="list">
     <a href="/admin/appshop"><li <?php if($bj['tb']=='app'){echo 'id="left_list"';}?>>应用超市</li></a>
     <a href="/admin/comm"><li <?php if($bj['tb']=='com'){echo 'id="left_list"';}?>>留言评论</li></a>
     <a href="/admin/links"><li <?php if($bj['tb']=='lin'){echo 'id="left_list"';}?>>网络链接</li></a>
     </ul> 
     <ul class="list">
     <div><b>内容管理</b></div>
     <a href="/admin/content/read" ><li <?php if($bj['tb']=='list'){echo 'id="left_list"';}?>>内容列表</li></a>
     <a href="/admin/content/type"><li <?php if($bj['tb']=='cat'){echo 'id="left_list"';}?>>内容分类</li></a>
     <a href="/admin/content/write"><li <?php if($bj['tb']=='add'){echo 'id="left_list"';}?>>新增内容</li></a>
     <a href="/admin/content/set"><li <?php if($bj['tb']=='set'){echo 'id="left_list"';}?>>内容设置</li></a>
     </ul>
     <ul class="list">
     <div><b>相册管理</b></div>
     <a href="/admin/album" ><li <?php if($bj['tb']=='alb'){echo 'id="left_list"';}?>>相册列表</li></a>
     <a href="/admin/album/type"><li <?php if($bj['tb']=='type'){echo 'id="left_list"';}?>>相册分类</li></a>
     <a href="/admin/album/set"><li <?php if($bj['tb']=='oth'){echo 'id="left_list"';}?>>其他设置</li></a>
     </ul> 
</div>