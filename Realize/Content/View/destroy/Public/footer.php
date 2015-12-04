<div class="links">
     <div class="links-line"><span style="font-size:24px">友情链接</span><span style="float:right"><a href="javascript:viod(0)">申请加入</a></span></div>
     <div class="link-list">
          <?php foreach(getLinks() as $link => $s){?>
          <a href="<?php echo $s['link']?>"><?php echo $s['name']?></a>
          <?php }?>
     </div>
</div>

<div class="footer">
     <div class="foot">Copyright © 2015 Destory. All Rights Reserved <span style="float:right"><a href="javascript:viod(0)">湘ICP备12007941号-2</a></span></div>
</div>
</body>
</html>
