<form name="form1" method="post" action="/admin/album/edit_pic?id=<?php echo $val['id']?>"><table width="650" height="133" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="140" rowspan="3"><img src="<?php echo $val['path']?>" width="80" height="80" /></td>
    <td width="510" height="40">
      <label for="select">相册：</label>
      <select id="album" name="album">
      <?php  foreach($option as $k=>$v){?>
             <option value="<?php echo $v['id']?>" <?php if($v['id']==$val['cate_id']){echo 'selected="selected"';}?>><?php echo $v['name']?></option>              <?php  foreach($v['son'] as $key=>$sc){?>
             <option value="<?php echo $sc['id']?>" <?php if($sc['id']==$val['cate_id']){echo 'selected="selected"';}?>>&nbsp;&nbsp;&nbsp;<?php echo $sc['name']?></option>
             <?php }?>
	 <?php }?>
      </select></td>
  </tr>
  <tr>
    <td width="510" height="40">
      <label for="textfield2">名称：</label>
      <input name="name" type="text" id="name" value="<?php echo $val['title']?>"></td>
  </tr>
  <tr>
    <td height="40"><label for="textfield3">标签：</label>
      <input name="keyword" type="text" id="keyword" value="<?php echo $val['keyword']?>"></td>
  </tr>
  <tr>
    <td width="140"><input type="submit" name="button" id="butt" value="保存修改"></td>
    <td><label for="textarea">描述：</label>
      <textarea name="description" id="textarea" cols="45" rows="5"><?php echo $val['description']?></textarea></td>
  </tr>
</table></form>
