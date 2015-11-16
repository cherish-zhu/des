<include  file="public:header" />
<link rel="stylesheet" href="/Static/style/meizhuang/css/categroy2.css" />

<div class="wrap">
<div class="clear"></div>

<div class="mian">
     <?php foreach ($pse as $pseKey => $ps){?>
     <div class="list"> 
          <div class="list-word">
               <div class="list-title"><a href="/<?php echo $cate['alias']?>/id/<?php echo $ps['id']?>" title="<?php echo $ps['title']?>"><?php echo $ps['title']?></a></div>
               <div class="list-info"><?php echo msubstr($ps['description'],0,80,"utf-8",'...')?></div>
               <div class="list-line"><i class="time icon"></i><?php echo date("Y-m-d",$ps['create_time'])?><i class="thumbs up outline icon"></i> <?php echo $ps['praise']?></div>
          </div>
     </div>
     <?php }?> 
     
     <div class="hr"></div>
     
     <?php foreach ($arr as $key => $val){?>
     <div class="list"> 
          <div class="list-word">
               <div class="list-title"><a href="/<?php echo $val['cate_alias']?>/id/<?php echo $val['id']?>" title="<?php echo $val['title']?>"><?php echo $val['title']?></a></div>
               <div class="list-info"><?php echo msubstr($val['description'],0,80,"utf-8",'...')?></div>
               <div class="list-line"><i class="time icon"></i><?php echo date("Y-m-d",$val['create_time'])?><i class="thumbs up outline icon"></i> <?php echo $val['praise']?></div>
          </div>
     </div>
     <?php }?>   
     <div class="page"><?php echo $page ?> </div>
</div>
<div class="toutiao">
          <div class="toutiao-title">热点排行</div>
          <?php foreach ($hot as $hotKey => $ht){?>
          <p><a href="/<?php echo $ht['cate_alias']?>/id/<?php echo $ht['id']?>"><?php echo $ht['title']?></a></p>
          <?php }?>
</div>


<include  file="public:left" />

<div class="clear"></div>
</div>

<include file="public:footer" />
