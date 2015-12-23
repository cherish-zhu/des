<!DOCTYPE html>
<html>
<head>
<title>文章内容 - 我的控制台</title>
<?php require_once('./Realize/Admin/View/Public/head.php');?>
<link type="text/css" rel="stylesheet" href="/Static/Semantic-UI/css/semantic.min.css" />
<link type="text/css" rel="stylesheet" href="/Static/admin/css/cont.css" />
<link type="text/css" rel="stylesheet" href="/Static/admin/css/type.css" />
<link rel="stylesheet" href="/Static/Editor/kindeditor/themes/default/default.css" />
<script charset="utf-8" src="/Static/Editor/kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="/Static/Editor/kindeditor/lang/zh_CN.js"></script>
<script>
			var editor;
			KindEditor.ready(function(K) {
				editor = K.create('textarea[name="content"]', {
					allowFileManager : true
				});
			});
</script>
</head>

<body>
    <div id="wrapper">
<?php require_once('./Realize/Admin/View/Public/left.php');?>


        <div id="page-wrapper" class="gray-bg dashbard-1">
            <?php require_once('./Realize/Admin/View/Public/top.php');?>
            <div class="wrapper wrapper-content">
        <div class="face">
          <form id="word" action="" method="post" onsubmit="javascript:return sendfrom()">
          <div class="cont-left">
               <div class="cont-title"><input name="title" type="text" id="title" value="<?php echo $alt['title']?>"/></div>
               <div class="cont-center"><textarea name="content" id="content" cols="92" rows="18" class="xheditor"><?php echo $alt['center']?></textarea></div>
               <div class="cont-mian">
                    <div class="tab-box">
                         <ul class="tab-menu">
                             <li>描述 / 标签</li>
                             <li>浏览设置</li>
                             <li>评论设置</li>
                             <li>模板 / 视图</li>
                             <li>附件</li>
                             <li>属性</li>
                         </ul>
                        <div class="tab-from">
                             <div class="tab-list">
                                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                         <tr>
                                             <td height="36"><label for="textfield2">标签</label> <input type="text" name="tags" id="tags" value="<?php echo $alt['tags']?>" /></td>
                                         </tr>
                                         <tr>
                                             <td height="36"><label for="textarea2">描述</label><textarea name="description" id="description" cols="60" rows="3"><?php echo $alt['description']?></textarea></td>
                                         </tr>
                                   </table>
                              </div>
                              <div class="tab-list">
                                    <div class="cont-check-box"><label>密码</label> <input type="radio" name="passwd" value="passwd" id="RadioGroup1_0" />  <input name="passwd_value" type="password" id="textfield" size="6" maxlength="12" /></div>
                                    <div class="cont-check-box"><label>注册用户</label><input type="radio" name="users" value="users" id="RadioGroup1_1" /></div>
                                    <div class="cont-check-box"><label>会员</label><input type="radio" name="vip" value="vip" id="RadioGroup1_2" /></div>
                                    <div class="cont-check-box"><label>用户组</label><input type="radio" name="group" value="group" id="RadioGroup1_3" /></div>
                                    <div class="cont-check-box"><label>收费</label><input type="radio" name="buy" value="buy" id="RadioGroup1_4" />
                                    <input name="buy_value" type="text" id="textfield3" size="6" maxlength="10" />
                                    <select name="buy_type" id="select2">
                                            <option value="0">元</option>
                                            <option value="1" selected="selected">积分</option>
                                            <option value="2">金币</option>
                                     </select></div>
                               </div>
                               <div class="tab-list">
                                    <div class="cont-check-line"><input type="radio" name="comm" value="1" id="comm"/><label>不显示评论框，不允许评论</label></div>
                                    <div class="cont-check-line"><input type="radio" name="comm" value="2" id="comm" /><label>允许任何人评论，需要审核</label></div>
                                    <div class="cont-check-line"><input type="radio" name="comm" value="3" id="comm" /><label>只允许注册用户评论</label></div>
                               </div>
                                <div class="tab-list">
                                     <p>&nbsp;</p>
                                     <p><label>请填写模版文件： </label><input type="text" name="view" id="view" value="<?php echo $alt['view']?>" /></p>
                                </div>
                                <div class="tab-list">
                                     <p>&nbsp;</p>
                                     <p>&nbsp;</p>
                                </div>
                                <div class="tab-list">
                                  <label for="select">请选择属性： </label>
                                  <select name="type" size="1" id="select">
                                    <option value="1" <?php if($alt['type'] == 1) echo 'selected="selected"'?>>普通</option>
                                    <option value="2" <?php if($alt['type'] == 2) echo 'selected="selected"'?>>头条</option>
                                    <option value="3" <?php if($alt['type'] == 3) echo 'selected="selected"'?>>推荐</option>
                                    <option value="4" <?php if($alt['type'] == 4) echo 'selected="selected"'?>>置顶</option>
                                  </select>
                          </div>
                      </div>
                      </div>
               </div>
          </div>
          
          <div class="cont-right">
                
                <div class="cont-head">
                  <div id="change-ico" class="cont-check">选择图标</div>
                     <div class="cont-img"><img src="<?php if(!empty($alt['thumb'])){echo $alt['thumb'];}else{echo '/Static/icon/wold.jpg';}?>" /></div>
                </div>
                
                <div class="cont-sub">
                     <input type="hidden" name="thumb" id="thumb" value="<?php echo $alt['thumb']?>" />
                     <input type="hidden" name="cateid" id="cateid" value="<?php echo $alt['cate_id']?>" />
                     <input type="submit" name="button" class="ui huge teal button" value="发 &nbsp; 布" />
                     <p style=" font-size:12px; line-height:36px" id="tips">系统自动检测内容完善程度后将自动保存到草稿箱</p>
                </div>
                
                <div class="category-box">
                <div class="category-line category-id-'">
                <div class="category-name">选择分类</div>
                <div class="category-cap"  id="id-"><i class="angle right icon"></i></div>
                <div class="category-clear"></div></div>
                <?php echo $cate_tree;?>

                <div class="category-clear"></div></div>    
          </div>
               
     </form>
     </div>
            <div class="category-clear"></div>
            </div>
            <div class="footer">
                <div class="pull-right">
                    By：<a href="http://www.destroy.net.cn/" target="_blank">destroy.net.cn</a>
                </div>
                <div>
                    <strong>Copyright</strong> Destroy &copy; 2015
                </div>
            </div>
        </div>
    </div>


</body>
<script type="text/javascript">


$(".category-line[level != '1']").not(":first").hide();

var num=0; 
$('.category-cap').click(function(e){ 
    $id = $(this).attr("id");
    $id = $id.split("-");
    $id = $id[1];
    if(num++ %2 == 0){ 
//doSomething 
    $(this).children("i").removeClass("right").addClass("down"); 
    
    $(".category-id-"+$id).show(); 
    }else{ 
//doOtherSomething
    $(this).children("i").removeClass("down").addClass("right");
    $(".category-id-"+$id).hide(); 
    } 

    e.preventDefault(); //阻止元素的默认动作（如果存在） 
});

$(".ed").click(function(){
	$id = $(this).attr("id");
	$id = $id.split("-");
	$id = $id[2];
	$("#cateid").val($id);
});

function sendfrom(){
	 title = $("#title").val();
	 cate  = $("#cateid").val();
	 cont  = $("#content").val();
	 if(cate.length <= 0){
		art.dialog.tips("请选择分类");
		 return false;
	 }
	 if(title.length <= 0){
		 art.dialog.tips("标题不能为空");
		 return false;
	 }
	 if(cont.length < 6){
		 art.dialog.tips("内容不少于6个字符");
		 return false;
	 }	 
}
center_id = $("#cateid").val();
$("#cate-id-"+center_id).parent().show();
</script>
<script src="/Static/Semantic-UI/javascript/semantic.min.js"></script>
<script src="/Static/admin/js/cont.js" type="text/javascript"></script>
