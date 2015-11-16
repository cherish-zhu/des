<include  file="public:header" />

<div class="wrap">

<div class="main">
     <div class="lunbo">     
        <div class="pikachoose">
        <ul id="pikame" class="jcarousel-skin-pika">
        <?php foreach ($hdp as $hdpKey => $hd){?>
        <li><a href="<?php echo $hd['links']?>" target="_blank"><img src="<?php echo $hd['icon']?>"/></a><span><?php echo $hd['name']?></span></li>
        <?php }?>
    </ul>
</div>
<script language="javascript">
$(document).ready(function (){
        $("#pikame").PikaChoose({carousel:true, carouselVertical:true});
});
</script>
     
</div>

<div class="toutiao">
          <div class="toutiao-title">热点推荐</div>
          <?php foreach($tuijian as $tj => $t){?>
          <p><a href="/<?php echo $t['cate_alias']?>/id/<?php echo $t['id']?>" title="<?php echo $t['title']?>"  <?php if($tj == 0)echo 'class="color-red"'?>><?php echo $t['title']?></a></p>
          <div class="toutiao-desc" <?php if($tj != 0)echo 'style="display:none"'?>><?php echo $t['description']?></div>
          <?php }?>
     </div>
</div>

<div class="huazhuang">
     <div class="huazhuang-line">
          <div class="huazhuang-title">化妆</div>
          <div class="huazhuang-more"><a href="/huazhuang">更多..</a></div>
     </div>
     <?php foreach($huazhuang as $hzKey => $hz){?>
     <div class="huazhuang-box" <?php if(($hzKey +1)%3 == 0) echo 'style="margin-right:0px !important; float:right !important"'?>>
          <div class="huazhuang-pic"><a href="/<?php echo $hz['cate_alias']?>/id/<?php echo $hz['id']?>" title="<?php echo $hz['title']?>"><img src="<?php echo thumb($hz['thumb'])?>" /></a></div>
          <div class="huazhuang-info">
               <div class="huazhuang-info-title"><a href="/<?php echo $hz['cate_alias']?>/id/<?php echo $hz['id']?>" title="<?php echo $hz['title']?>"><?php echo $hz['title']?></a></div>
               <div class="huazhuang-info-cont"><?php echo msubstr($hz['description'],0,32,"utf-8",'...')?></div>
               <div class="huazhuang-info-butt"><i class="time icon"></i><?php echo date("Y-m-d",$hz['create_time'])?><i class="thumbs up outline icon"></i> <?php echo $hz['praise']?></div>
          </div>
     </div>
     <?php }?>
</div>

<div class="meifa">
     <div class="mei-title"><a href="/meifa">美发</a></div>
     <?php foreach($meifa as $mfKey => $mf){?>
     <div class="mei-box" <?php if(($mfKey +1)%2 == 0) echo 'style="margin-right:0px !important; float:right !important"'?>>
          <div class="mei-pic"><a href="/<?php echo $mf['cate_alias']?>/id/<?php echo $hz['id']?>" title="<?php echo $mf['title']?>"><img src="<?php echo thumb($mf['thumb'])?>" /></a></div>
          <div class="mei-box-title"><a href="/<?php echo $mf['cate_alias']?>/id/<?php echo $hz['id']?>" title="<?php echo $mf['title']?>"><?php echo $mf['title']?></a></div>
          <div class="mei-box-info"><i class="time icon"></i><?php echo date("Y-m-d",$mf['create_time'])?><i class="thumbs up outline icon"></i> <?php echo $mf['praise']?></div>
     </div>
     <?php }?>
</div>
<div class="meijia">
     <div class="mei-title"><a href="/meijia">美甲</a></div>
     <?php foreach($meijia as $mjKey => $mj){?>
     <div class="mei-box" <?php if(($mjKey +1)%2 == 0) echo 'style="margin-right:0px !important; float:right !important"'?>>
          <div class="mei-pic"><a href="/<?php echo $mj['cate_alias']?>/id/<?php echo $mj['id']?>" title="<?php echo $mj['title']?>"><img src="<?php echo thumb($mj['thumb'])?>" /></a></div>
          <div class="mei-box-title"><a href="/<?php echo $mj['cate_alias']?>/id/<?php echo $mj['id']?>" title="<?php echo $mj['title']?>"><?php echo $mj['title']?></a></div>
          <div class="mei-box-info"><i class="time icon"></i><?php echo date("Y-m-d",$mj['create_time'])?><i class="thumbs up outline icon"></i> <?php echo $mj['praise']?></div>
     </div>
     <?php }?>
</div>

<div class="meizhuang">
     <div class="meizhuang-line">
          <div class="meizhuang-title">穿衣打扮</div>
          <div class="meizhuang-more"><a href="/chuanyidaban">更多..</a></div>
     </div>
     <?php foreach($meizhuang as $mzKey => $mz){?>
     <div class="meizhuang-box"  <?php if(($mzKey +1)%2 == 0) echo 'style="margin-right:0px !important; float:right !important"'?>>
          <div class="meizhuang-pic"><a href="/<?php echo $mz['cate_alias']?>/id/<?php echo $mz['id']?>" title="<?php echo $mj['title']?>"><img src="<?php echo thumb($mz['thumb'])?>" /></a></div>
          <div class="meizhuang-info">
               <div class="meizhuang-info-title"><a href="/<?php echo $mz['cate_alias']?>/id/<?php echo $mz['id']?>" title="<?php echo $mz['title']?>"><?php echo $mz['title']?></a></div>
               <div class="meizhuang-info-cont"><?php echo msubstr($mz['description'],0,32,"utf-8",'...')?></div>
               <div class="meizhuang-info-butt"><i class="time icon"></i><?php echo date("Y-m-d",$mz['create_time'])?><i class="thumbs up outline icon"></i> <?php echo $mz['praise']?></div>
          </div>
     </div>
     <?php }?>
</div>

<include  file="public:left" />

<div class="meizhuang">
     <div class="meizhuang-line">
          <div class="meizhuang-title">护肤</div>
          <div class="meizhuang-more"><a href="/hfu">更多..</a></div>
     </div>
     <?php foreach($hufu as $mzKey => $hf){?>
     <div class="meizhuang-box"  <?php if(($hfKey +1)%2 == 0) echo 'style="margin-right:0px !important; float:right !important"'?>>
          <div class="meizhuang-pic"><a href="/<?php echo $hf['cate_alias']?>/id/<?php echo $hf['id']?>" title="<?php echo $hf['title']?>"><img src="<?php echo thumb($hf['thumb'])?>" /></a></div>
          <div class="meizhuang-info">
               <div class="meizhuang-info-title"><a href="/<?php echo $hf['cate_alias']?>/id/<?php echo $hf['id']?>" title="<?php echo $hf['title']?>"><?php echo $hf['title']?></a></div>
               <div class="meizhuang-info-cont"><?php echo msubstr($hf['description'],0,32,"utf-8",'...')?></div>
               <div class="meizhuang-info-butt"><i class="time icon"></i><?php echo date("Y-m-d",$hf['create_time'])?><i class="thumbs up outline icon"></i> <?php echo $hf['praise']?></div>
          </div>
     </div>
     <?php }?>
</div>

<div class="clear"></div>
</div>
<div class="clear"></div>
<div class="clear"></div>
<div class="links">
     <div class="links-line">友情链接</div>
     <ul>
         <?php foreach($links as $link => $lk){?>
         <li><a href="<?php echo $lk['links']?>" target='_blank'><?php echo $lk['name']?></a></li>
         <?php }?>
         <li><a href="#" target='_blank'>友情链接邀您加入</a></li>
         <li><a href="#" target='_blank'>友情链接邀您加入</a></li>
         <li><a href="#" target='_blank'>友情链接邀您加入</a></li>
         <li><a href="#" target='_blank'>友情链接邀您加入</a></li>
     </ul>
</div>

</div>

<include file="public:footer" />