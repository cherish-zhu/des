// JavaScript Document

$(function() {
    $( ".sortable" ).sortable({
      placeholder: "ui-state-highlight",
	  stop:function(){
		  //alert(0);
	  }
    }).disableSelection();
    $(".fa-trash-o").click(function(){
		me = $(this);
		id = $(this).attr("id");
		id = id.split("-");
		id = id[1];
		art.dialog.confirm('你确定要删除吗？', function () {
					 
					  $.get('/admin/Category/del?id='+id,function(data){
						  me.closest(".ui-state-default").remove();
						  art.dialog.tips('删除成功');
						  return false;
					  },'json');			  
                      
                 }, function () {
                      art.dialog.tips('执行取消操作');
                 })
	});
	$(".ui-state-default li").hide();
	$(".fa-angle-right").toggle(function(){
	    $(this).removeClass("fa-angle-right");
		$(this).addClass("fa-angle-down");
		show = $(this).attr("id");
		$("."+show+">li").show();		
	},function(){
		$(this).removeClass("fa-angle-down");
		$(this).addClass("fa-angle-right");
		hide = $(this).attr("id");
		$("."+hide+"  li").hide();
	});
	$(".cate,.cate-son").dblclick(function(){
		
		app = $(this).attr("id");
		app = app.split("-");
		app = app[1];
		
		id = $(this).children(".cate-id").text();
		
		var dialog = art.dialog({
			id: 'N3691',
			lock:true,
			title: "分类"
		});
		$.ajax({
            url: '/admin/category/edit?app='+app+'&id='+id,
            success: function (data) {
                dialog.content(data);
            },
            cache: false
        });
	});
	
	$(".action").click(function(){
		
		app = $(this).attr("id");
		app = app.split("-");
		app = app[1];
		
		var dialog = art.dialog({
			id: 'N3690',
			lock:true,
			title: "新增分类"
		});
		$.ajax({
            url: '/admin/category/form?app='+app,
            success: function (data) {
                dialog.content(data);
            },
            cache: false
        });
	});
		$(".add-action").click(function(){
		
		app = $(this).attr("id");
		app = app.split("-");
		app = app[1];
		
		var dialog = art.dialog({
			id: 'N3690',
			lock:true,
			title: "新增分类"
		});
		$.ajax({
            url: '/admin/Nav/form?app='+app,
            success: function (data) {
                dialog.content(data);
            },
            cache: false
        });
	});
	$(".nav,._nav,.nav-son").dblclick(function(){
		
		app = $(this).attr("id");
		app = app.split("-");
		app = app[1];
		
		id = $(this).children(".cate-id").text();
		
		var dialog = art.dialog({
			id: 'N3691',
			lock:true,
			title: "分类"
		});
		$.ajax({
            url: '/admin/nav/edit?app='+app+'&id='+id,
            success: function (data) {
                dialog.content(data);
            },
            cache: false
        });
	});
	
   // $("input").iCheck({
     //  checkboxClass: 'icheckbox_flat-red',
    //   radioClass: 'iradio_flat-red',
	//   increaseArea:'-10'
  //  });	
	
});