<div class="wrap-right">
          <div class="new-list">
               <div class="new-title"><span style="font-size:18px">最近更新</span></div>
               <ul>
                   <?php foreach(getList(0,9) as $new => $ne){?>
                 <li><a href="#"><?php echo $ne['title']?></a></li>
                   <?php }?>
               </ul>
          </div>
          <div class="pos"><img src="/Static/style/destroy/img/ad.jpg" width="250" height="230"></div>        
     </div>