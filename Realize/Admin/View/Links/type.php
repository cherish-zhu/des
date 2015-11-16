<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>我的控制台</title>
<link type="text/css" rel="stylesheet" href="/Static/admin/css/album2.css" />
<?php require_once('./Realize/Admin/View/public/top.php');?>


<div class="main">

<?php require_once('./Realize/Admin/View/left/leftAppliance.php');?>

<div class="right"  style="background-color:#FFF">

       <div class="menu">
          <ul>
             <li><a href="<?php echo url2("/links")?>">所有链接</a></li>
            <li><a href="<?php echo url2("/links/type")?>">分类设置</a></li>
          </ul>
      </div>
     
     <div class="face">
          <form id="type" name="form1" method="post" action="<?php echo url2("/links/insert")?>"><div class="add-album" style="height:176px">
          
               <div class="add-left">
                   <div class="add-left-line">
                   <label for="select">类型：</label>
                    <select name="type" id="select">
                         <option value="3">顶级分类</option>
                         <?php foreach($option as $k=>$v){?>
                         <option value="<?php echo $v['cid']?>"><?php echo $v['class_name']?></option>
                         <?php }?>
                    </select><label for="select2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;是否在列表中自动显示</label>                
                   <select name="auto" id="select2">
                     <option value="1">是</option>
                     <option value="0">否</option>
                   </select></div>
                   <div class="add-left-line">
                   <label for="textfield">名称：</label><input type="text" name="name" id="name" />
                   <label for="textfield2">别名：</label><input type="text" name="alias" id="alias" />
                   <label for="textfield3">关键字：</label><input name="keyword" type="text" id="keyword" size="26" />
                   </div>
                   <div class="add-left-line">
                   <label for="textfield4">描述：</label><input name="description" type="text" id="description" size="80" />
                   </div>
               </div>
               <div class="add-right">
                    <div class="add-right-line"><input name="ico" id="ico" type="hidden" value="" /><div id="change-ico">选择图标</div></div>
                    <div class="add-left-line"><input name="butt" id="butt" type="submit" value="添加" /></div>
               </div>
            </form>
          </div>
          <div class="type-list">
               <?php foreach($option as $k=>$v){?>
               <div id="<?php echo $v['cid']?>" class="album-list">
                  <div id="<?php echo $v['cid']?>" class="album-list-parent" title="拖拽排序，双击编辑">
                     <span><?php echo $v['class_name']?></span>
                     <p  class="ss" style="float:right; margin-right:10px">&gt;&gt;</span>
                     <p class="del" style="float:right; margin-right:10px">删除</p>
                     <p style="float:right; margin-right:10px"><?php echo $v['alias']?></p>
                     <p style="float:right; margin-right:10px">ID:<?php echo $v['cid']?></p>
                  </div>
                  <?php echo $v['son']?>
                </div>                
              <?php }?>
          </div>
     </div>

</div>
<script type="text/javascript">
$(function(){
	$( ".album-box" ).hide();
	$( ".type-list" ).sortable({containment: 'parent',stop:function(event, ui){
		var id = ui.item.next().attr("id");
		var cid = ui.item.attr("id");
		if($.type(id) == 'undefined'){
			var id = ui.item.prev().attr("id");
			var type = '1';
			$.post(baseURL+"/album/paixu",{id:id,cid:cid,type:type},function(){});
		}else{
			var id = ui.item.next().attr("id");
			var type = '+';
			$.post(baseURL+"/album/paixu",{id:id,cid:cid,type:type},function(){});
		}
	} })
    .disableSelection();
	$( ".album-box" ).sortable({containment: 'parent',stop:function(event, ui){
		var id = ui.item.next().attr("id");
		var cid = ui.item.attr("id");
		if($.type(id) == 'undefined'){
			var id = ui.item.prev().attr("id");
			var type = '+';
			$.post(baseURL+"/album/paixu",{id:id,cid:cid,type:type},function(){});
		}else{
			var id = ui.item.next().attr("id");
			var type = '-';
			$.post(baseURL+"/album/paixu",{id:id,cid:cid,type:type},function(){});
		}
	} })
    .disableSelection();
    $(".type-list-dd,.album-list-parent").dblclick(function(){
	    var id = $(this).attr("id");
		var dialog = art.dialog({
		    title:'编辑',
		    lock:true
	    });
        $.ajax({
            url: baseURL+'/album/edit?id='+id,
            success: function (data) {
                 dialog.content(data);
            },
            cache: false
        });
   });
   $(".ss").toggle(
      function(){
		 var ssID = $(this).attr("id");
		 $(this).parent().next(".album-box").show();
	  },
      function(){
         var ssID = $(this).attr("id");
	     $(this).parent().next(".album-box").hide();
   });
});

$("#type").live("submit",function(){
	if($("#name").val() == ''){
		art.dialog({
			content:'请填写分类名称',
			time:3
		 });
		return false;
	}
	var alias = /[\w]/;
	if(!alias.test($("#alias").val())){
		art.dialog({
			content:'分类别名中只能是数组或者字母',
			time:3
		 });
		 return false;
	}
});

function album(i){
	
	if($.type(i)!='undefined')aid = i;
	$.page({
	    group:7,//每组条数 必须
	    sum:200,//总数   必须
	    tag:'p',//包裹标签
	    pianyi:21,//每页显示多少条  必须
		starStr:'首页',//第一条
	    endStr:'尾页',//最后一条
	    data:{URL:hostURL},//预定义数
	    templete:'#tpl',//模板ID,模板中需要替换的数据用{}包括，里面的值将与数据的键值对应，比如{title}将被数据中的title内容替换，data中预定义的数据格式用{data.xxx}
		pageID:'#ajaxPage',//填充内容 必须
	    contentID:'#image',
	    url:baseURL+"/album/pic?aid="+aid //url 必须
    })

    $("#image").removeClass()
	.addClass(" "+aid);
}

$("#change-ico").click(function(){
	var dialog = art.dialog({
		id:'ND1539',
		width:'80%',
		title:'选择图片',
		lock:true
	});
		
	
	$.get(baseURL+"/public/pic_list",function(v){
		 dialog.content(v);
	     var cid = $(".cid").attr("id");
         var aid = $(".aid").attr("id");
         $("#select option").each(function(i,e){
	         if(i==0){
		          cid = $(this).val();
		          $.get(baseURL+"/album/lib?cid="+cid,function(r){

		              var str = '<span style="float:left; line-height:50px; margin-right:30px"><<</span>';
	     	          $.each(r,function(i,e){
			               str+='<p><a href="javascript:album('+e.cid+')">'+e.class_name+'</a></p>';
		              });
		              str+='<span style="line-height:50px;">>></span>';
		              $(".img-right").html(str);
	              },'json');		
	         }
        });
        album();

	

	});
});

$("#select").live("change",function(){

	cid = $(this).val();
	$.get(baseURL+"/album/lib?cid="+cid,function(r){
		
		var str = '<span style="float:left; line-height:50px; margin-right:30px"><<</span>';
		$.each(r,function(i,e){
			if(i==0){
				$(".aid").attr("id",e.cid);//选择分类时设置第个相册为默认操作
			}
			str+='<p><a href="javascript:album('+e.cid+')">'+e.class_name+'</a></p>';
		});
		str+='<span style="line-height:50px;">>></span>';
		$(".img-right").html(str);
	},'json');
});


$(".img").live("click",function(){
	$(".img").each(function(){
		if($(this).attr("class")=="img img-border"){
			$(this).removeClass("img-border");
		}
	});
	$(this).addClass("img-border");		
});

$(".check-img").live("click",function(){
	$(".img").each(function(){
		if($(this).attr("class")=="img img-border"){
			var imgSRC = $(this).children("img").attr("src");
			$("#change-ico").html('<img src="'+imgSRC+'" />');
			$("#ico").val(imgSRC);
		}
	});
	art.dialog.through({id: 'ND1539'}).close();
});

$(".del").live("click",function(){
	var id = $(this).parent().attr("id");
	var del = $(this).parent();
	art.dialog({
    content: '您确定要删除吗？',
    ok: function () {
		$.get(baseURL+"/album/del?id="+id,function(x){
		if(x.code == 1){
			art.dialog({
			    title:'提示',
				content:x.msg,
				time:2
			});
	
			del.remove();
		}else{
			art.dialog({
			    title:'提示',
				content:x.msg,
				time:2
			});
		}
	    },'json');
    	this.close();
        return false;
    },
	lock:true,
    cancelVal: '关闭',
    cancel: true //为true等价于function(){}
});
	
	
});
</script>
<?php require_once('../Realize/Admin/View/Public/footer.php');?>