<?php if (!defined('THINK_PATH')) exit();?><form id="form1" name="form1" method="post" action="/admin/Nav/insert?id=<?php echo $x['id']?>">
<div class="type-box">
  <div class="type-left"><div id="change-ico" class="cont-check cont-img"><?php if(!empty($x['icon'])){echo '<img src="'.$x['icon'].'" />';}else{ echo '选择图片';} ?></div><input type="hidden" name="thumb" id="thumb" value="<?php echo $x['icon']?>" /></div>
    <div class="type-right">
      <div class="type-line">          
          <label for="textfield">选择分类 </label>
          <select name="category" id="category">
               <option value="0">顶级分类</option>
               <?php  echo $options;?>
          </select>
        </div>
        <div class="type-line">
        <label for="textfield">是否在列表中自动显示&nbsp;&nbsp;&nbsp;&nbsp;</label>
          <select name="status" id="select">
                <option value="1" <?php if($x['status'] == 1){?>selected="selected"<?php }?>>是</option>
                <option value="0" <?php if($x['status'] == 0){?>selected="selected"<?php }?>>否</option>
                
          </select>
      </div>
          <div class="type-line">
            <label for="textfield2">名&nbsp;&nbsp;&nbsp;&nbsp;称&nbsp;&nbsp; </label>
            <input name="name" type="text" id="textfield2" value="<?php echo $x['name']?>" />
          </div>
          <div class="type-line">
            <label for="textfield2">链&nbsp;&nbsp;&nbsp;&nbsp;接&nbsp;&nbsp; </label>
            <input type="text" name="links" id="textfield2"  value="<?php echo $x['links']?>" />
      </div>

          <div class="type-line">
          
            <input type="submit" name="button" class="smile-butt" id="button" value="修改" />
          </div>
</div>
</form>