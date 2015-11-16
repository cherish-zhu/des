<div class="left">
     <ul class="list">
     <a href="/admin/comp"><li <?php if($bj['tb']=='cmp'){echo 'id="left_list"';}?>>插件管理</li></a>
     <a href="/admin/tools"><li <?php if($bj['tb']=='too'){echo 'id="left_list"';}?>>工具箱</li></a>
     </ul> 
     <ul class="list">
     <div><b>游戏管理</b></div>
     <a href="/admin/game"><li <?php if($bj['tb']=='gam'){echo 'id="left_list"';}?>>游戏中心</li></a>
     <a href="/admin/game/myGame"><li <?php if($bj['tb']=='game'){echo 'id="left_list"';}?>>我的游戏</li></a>
     
     </ul> 
     <ul class="list">
     <div>APP管理</b></div>
     <a href="/admin/App/jiguang"><li <?php if($bj['tb']=='jg'){echo 'id="left_list"';}?>>极光推送</li></a>
     <a href="/admin/App/youmeng"><li <?php if($bj['tb']=='ym'){echo 'id="left_list"';}?>>友盟推送</li></a>
     </ul> 
</div>