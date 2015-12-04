<include  file="public:header" />

<include  file="public:banner" />

<div class="wrap">
     <div class="wrap-left">
          <div class="line"><span style="font-size:18px">日志</span></div>
          <ul class="list">
              <?php foreach($arr as $lt){?>
              <li><span style="float:left"><a href="#"><?php echo $lt['title']?></a></span><span style="float:right"><?php echo date("Y年m月d日 H:i",$lt['create_time'])?></span></li>
              <?php }?>            
          </ul>
          <div class="page"><?php echo $page?></div>
     </div>
     <include  file="public:right" />
</div>

<include  file="public:footer" />