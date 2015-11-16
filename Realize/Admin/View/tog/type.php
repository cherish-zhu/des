<form id="form1" name="form1" method="post" action="/admin/Category/insert?id=<?php echo $x['id']?>">
<div class="type-box">
  <div class="type-left"><div id="change-ico" class="cont-check cont-img"><?php if(!empty($x['icon'])){echo '<img src="'.$x['icon'].'" />';}else{ echo  '选择图片';} ?></div><input type="hidden" name="thumb" id="thumb" value="<?php echo $x['icon']?>" /></div>
    <div class="type-right">
      <div class="type-line">          
          <label for="textfield">选择分类 </label>
          <select name="category" id="category">
               <option value="1">顶级分类</option>
               <?php  echo $options;?>
          </select>
        </div>
        <div class="type-line">
        <label for="textfield">是否在列表中自动显示&nbsp;&nbsp;&nbsp;&nbsp;</label>
          <select name="status" id="select">
               <?php if($x['status'] == 1){?> <option value="1">是</option><?php }else{?>
                <option value="0">否</option>
                <?php }?>
          </select>
      </div>
          <div class="type-line">
            <label for="textfield2">名&nbsp;&nbsp;&nbsp;&nbsp;称&nbsp;&nbsp; </label>
            <input name="name" type="text" id="textfield2" value="<?php echo $x['name']?>" />
          </div>
          <div class="type-line">
            <label for="textfield2">别&nbsp;&nbsp;&nbsp;&nbsp;名&nbsp;&nbsp; </label>
            <input type="text" name="alias" id="textfield2"  value="<?php echo $x['alias']?>" />
      </div>
          <div class="type-line">
            <label for="textfield2">关键词&nbsp;&nbsp;&nbsp; </label>
            <input type="text" name="keyword" id="textfield2"  value="<?php echo $x['keyword']?>" />
      </div>
      <div class="type-line"> <label for="textarea">描述</label></div> 
          <textarea name="description" id="textarea" cols="45" rows="5"> <?php echo $x['description']?></textarea>
     </div>
          <div class="type-line">
          
            <input type="submit" name="button" class="smile-butt" id="button" value="修改" />
          </div>
</div>
</form>