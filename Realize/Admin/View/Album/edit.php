<form id="type" name="form1" method="post" action="<?php echo url2("/album/edit")?>?id=<?php echo $val['cid']?>"><div class="add-album" style="height:176px">
          
               <div class="add-left">
                   <div class="add-left-line">
                   <label for="select">类型：</label>
                       <select name="type" id="select">
                         <option value="2">顶级分类</option>
                         <?php foreach($option as $k=>$v){?>
                         <option value="<?php echo $v['cid']?>" <?php if($val['fid']==$v['cid']) echo 'selected'?>><?php echo $v['class_name']?></option>
                         <?php }?>
                    </select><label for="select2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;是否在列表中自动显示</label>                
                   <select name="auto" id="select2">
                     <option value="1"  <?php if($val['status']==1) echo 'selected'?>>是</option>
                     <option value="0" <?php if($val['status']==0) echo 'selected'?>>否</option>
                   </select></div>
                   <div class="add-left-line">
                   <label for="textfield">名称：</label><input type="text" name="name" id="name" value="<?php echo $val['name']?>" />
                   <label for="textfield2">别名：</label><input type="text" name="alias" id="alias" value="<?php echo $val['alias']?>"/>
                   <label for="textfield3">关键字：</label><input name="keyword" type="text" id="keyword" size="26" value="<?php echo $val['class_keyword']?>" />
                   </div>
                   <div class="add-left-line">
                   <label for="textfield4">描述：</label><input name="description" type="text" id="description" size="80" value="<?php echo $val['class_description']?>" />
                   </div>
               </div>
               <div class="add-right">
                    <div class="add-right-line"><div id="change-ico">选择图标</div></div>
                    <div class="add-left-line"><input name="butt" id="butt" type="submit" value="添加" /></div>
               </div>
            </form>