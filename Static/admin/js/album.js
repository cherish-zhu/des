// JavaScript Document
//$(function() {
			
		$('#accordion-style').on('click', function(ev){
					var target = $('input', ev.target);
					var which = parseInt(target.val());
					if(which == 2) $('#accordion').addClass('accordion-style2');
					 else $('#accordion').removeClass('accordion-style2');
		});
					
		var oldie = /msie\s*(8|7|6)/.test(navigator.userAgent.toLowerCase());
		$('.easy-pie-chart.percentage').each(function(){
					$(this).easyPieChart({
						barColor: $(this).data('color'),
						trackColor: '#EEEEEE',
						scaleColor: false,
						lineCap: 'butt',
						lineWidth: 8,
						animate: oldie ? false : 1000,
						size:75
					}).css('color', $(this).data('color'));
		});
			
		//$('[data-rel=tooltip]').tooltip();
		//$('[data-rel=popover]').popover({html:true});
			
			
		
						
		$('#spinner-opts small').css({display:'inline-block', width:'60px'})
			
				var slide_styles = ['', 'green','red','purple','orange', 'dark'];
				var ii = 0;
				$("#spinner-opts input[type=text]").each(function() {
					var $this = $(this);
					$this.hide().after('<span />');
					$this.next().addClass('ui-slider-small').
					addClass("inline ui-slider-"+slide_styles[ii++ % slide_styles.length]).
					css({'width':'125px'}).slider({
						value:parseInt($this.val()),
						range: "min",
						animate:true,
						min: parseInt($this.data('min')),
						max: parseInt($this.data('max')),
						step: parseFloat($this.data('step')),
						slide: function( event, ui ) {
							$this.attr('value', ui.value);
							spinner_update();
						}
					});
		});
						
		$.fn.spin = function(opts) {
					this.each(function() {
					  var $this = $(this),
						  data = $this.data();
			
					  if (data.spinner) {
						data.spinner.stop();
						delete data.spinner;
					  }
					  if (opts !== false) {
						data.spinner = new Spinner($.extend({color: $this.css('color')}, opts)).spin(this);
					  }
					});
					return this;
		};
			
		function spinner_update() {
					var opts = {};
					$('#spinner-opts input[type=text]').each(function() {
						opts[this.name] = parseFloat(this.value);
					});
					$('#spinner-preview').spin(opts);
		}
						
		$('#id-pills-stacked').removeAttr('checked').on('click', function(){
					$('.nav-pills').toggleClass('nav-stacked');
		});
			
			
	//	});
					
//========================遍历相册============================================
var cid = $(".cid").attr("id");
var aid = $(".aid").attr("id");
	
$("#select option").each(function(i,e){
	if(i==0){
		cid = $(this).val();
		$.get("/admin/album/lib/?cid="+cid,function(r){
		
		    var str = '<span style="float:left; line-height:50px; margin-right:30px"><<</span>';
	     	$.each(r,function(i,e){
			    str+='<p><a href="javascript:album('+e.cid+')">'+e.class_name+'</a></p>';
		    });
		    str+='<span style="line-height:50px;">>></span>';
		    $(".img-right").html(str);
	    },'json');		
	}
});
$("#select").change(function(){
	cid = $(this).val();
	$.get("/admin/album/lib/?cid="+cid,function(r){
		
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
function album(i){
	
	if($.type(i)!='undefined')aid = i;


    $("#image").removeClass()
	.addClass(" "+aid);
}

album();
//编辑图片
$(".fa-pencil").on("click",function(){
	var id = $(this).parent().attr("id");
	id = id.split("-");
	id = id[1];
	var cid = $(this).attr("id");
	cid = cid.split("-");
	cid = cid[1];
	var dialog = art.dialog({title:'编辑相册',lock:true});
	$.get("/admin/album/edit_pic/?fid="+cid+"&id="+id,function(r){
		dialog.content(r);
	});
});
//删除图片
$(".fa-remove").on("click",function(){
	
	var id = $(this).parent().attr("id");
	id = id.split("-");
	id = id[1];
	var pa = $(this).parents(".pic_box");
	art.dialog.confirm('你确定要删除吗？', function () {
					  $.get("/admin/album/del_pic/?id="+id,function(r){
						  if(r.code == 1){
							  pa.remove();
							  art.dialog.tips('删除成功');
						  }else{
							  art.dialog.tips('删除失败');
						  }
					  },'json');
                      
                 }, function () {
                 art.dialog.tips('执行取消操作');
    });

});